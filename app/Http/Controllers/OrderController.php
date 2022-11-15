<?php

namespace App\Http\Controllers;

use DB;
use Throwable;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Package;
use App\Models\Visitor;
use App\Models\LogAdmin;
use App\Models\LogLimit;
use App\Models\LogCoupon;
use App\Models\ReportLimit;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Arr;
use App\Models\ReportCoupon;
use Illuminate\Http\Request;
use App\Models\ReportDeposit;
use App\Models\LogTransaction;
use Illuminate\Support\Carbon;
use App\Jobs\SendEmailResetJob;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailPaymentsuccess4;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendMailPaymentsuccess4Job;
use function PHPUnit\Framework\returnSelf;

class OrderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $status;
    private $message;
    private $data;

    public function __construct() {
        $this->status = "INVALID";
        $this->message = "Ada sesuatu yang salah!";
        $this->data = [];
    }

    public function index(Request $request) {
        $data['products'] = Package::orderBy('id', 'desc')->where('status', '0')->get();
        if ($request->ajax()) {
            return datatables()->of($data['products'])->editColumn('price_weekdays', function ($data) {
                    return formatrupiah($data->price_weekdays);
                })->editColumn('price_weekend', function ($data) {
                    return formatrupiah($data->price_weekend);
                })->addIndexColumn()->make(true);
        }
        if (!$request->hasValidSignature()) {
            return \redirect('/analisis-tamu');
        }
        $data['today'] = Carbon::now()->isoFormat('dddd');
        $data['date_now'] = Carbon::now()->translatedFormat('d F Y');
        $data['get_visitor'] = Visitor::find(request()->segment(2));
        $data['url_checkout'] = URL::temporarySignedRoute('checkout', now()->addMinutes(7), ['id' => request()->segment(2)]);
        $data['default'] = Package::where('category', 'default')->where('status', 0)->get();
        $data['additional'] = Package::where('category', 'additional')->where('status', 0)->get();
        $data['others'] = Package::where('category', 'others')->where('status', 0)->get();
        $items = \Cart::session(request()->segment(2))->getContent();
        
        if (\Cart::isEmpty()) {
            $data['cart_data'] = [];
        } else {
            foreach ($items as $row) {
                $id_package[] = $row->id;
                $package = Package::find($row->id);
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                    'created_at' => $row->attributes['created_at'],
                    'category' => $package->category
                ];
            }
            $data['cart_data'] = collect($cart)->sortBy('created_at');
            $data['count_default'] = Package::whereIn('id', $id_package)->where('category', 'default')->get();
        }
        $sub_total = \Cart::session(request()->segment(2))->getSubTotal();
        $total = \Cart::session(request()->segment(2))->getTotal();
        $data['counted'] = ucwords(counted($total) . ' Rupiah');

        $data['data_total'] = [
            'sub_total' => $sub_total,
            'total' => $total,
        ];
        return view('membership.cart', $data);
    }

    public function add(Request $request) {
        $package = Package::find($request->get('package'));
        $visitor = Visitor::find($request->get('member'));
        $cart = \Cart::session($request->get('member'))->getContent();
        $cek_itemId = $cart->whereIn('id', $request->get('package'));
        $today = Carbon::now()->isoFormat('dddd');
        $price = $today === 'Sabtu' || $today === 'Minggu' ? $package->price_weekend : $package->price_weekdays;
        $get_total = \Cart::session($request->get('member'))->getTotal();
        $counted = ucwords(counted($get_total) . ' Rupiah');
        try {
            if ($cek_itemId->isNotEmpty()) {
                if ($package->quantity == $cek_itemId[$request->get('package')]->quantity) {
                    return redirect()->back()->with('error', 'jumlah item kurang');
                } else {
                    // \Cart::session($request->get('member'))->update($request->get('package'), array(
                    //     'quantity' => 1
                    // ));
                    if ($cek_itemId[$request->get('package')]->quantity >= 1) {
                        $this->setResponse('INVALID', "Sudah ditambahkan");
                        return response()->json($this->getResponse());
                    }
                    return response()->json([
                        'id' => $request->get('package'),
                        'total' => $get_total,
                        'counted' => $counted,
                        'cart' => $cart,
                        'qty' => $cek_itemId[$request->get('package')]->quantity,
                        'price' => $cek_itemId[$request->get('package')]->price
                    ], 200);
                }
            } else {
                if($visitor->expired_date <= Carbon::now()) {
                    $this->setResponse('INVALID', "Masa berlaku member habis");
                    return response()->json($this->getResponse());
                } else if($visitor->status == 'inactive') {
                    $this->setResponse('INVALID', "Member tidak aktif");
                    return response()->json($this->getResponse());
                } else {
                    \Cart::session($request->get('member'))->add(array(
                        'id' => $request->get('package'),
                        'name' => $package->name,
                        'price' => $price,
                        'quantity' => 1,
                        'category' => $package->category,
                        'attributes' => array(
                            'created_at' => date('Y-m-d H:i:s')
                        ),
                    ));
                    $id_package = [];
                    foreach (\Cart::session($request->get('member'))->getContent() as $sd) {
                        $id_package[] = $sd['id'];
                    }
                    $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
                    $package_additional = Package::whereIn('id', $id_package)->where('category', 'additional')->get();
                    
                    if (count($package_additional) == 0) {
                        $cart = \Cart::session($request->get('member'))->getContent();
                        $cek_itemId = $cart->whereIn('id', $request->get('package'));
                        if (\Cart::isEmpty()) {
                            $cart_data = [];
                        } else {
                            foreach ($cart as $row) {
                                $package = Package::find($row->id);
                                $cart[] = [
                                    'rowId' => $row->id,
                                    'name' => $row->name,
                                    'qty' => $row->quantity,
                                    'pricesingle' => $row->price,
                                    'price' => $row->getPriceSum(),
                                    'created_at' => $row->attributes['created_at'],
                                    'category' => $package->category,
                                ];
                            }
                            $cart_data = collect($cart)->sortBy('created_at');
                        }
                        $get_total = \Cart::session($request->get('member'))->getTotal();
                        $counted = ucwords(counted($get_total) . ' Rupiah');
                        return response()->json([
                            'id' => $request->get('package'),
                            'total' => $get_total,
                            'counted' => $counted,
                            'cart' => $cart_data,
                            'qty' => $cek_itemId[$request->get('package')]->quantity,
                            'name' => $cek_itemId[$request->get('package')]->name,
                            'price' => $cek_itemId[$request->get('package')]->price,
                            'category' => $cek_itemId[$request->get('package')]->category
                        ], 200);
                    } else if(count($package_default) == 0) {
                        \Cart::session($request->get('member'))->clear();
                        $this->setResponse('INVALID', "Setidaknya pilih satu jenis permainan");
                        return response()->json($this->getResponse());
                    } else {
                        $cart = \Cart::session($request->get('member'))->getContent();
                        $cek_itemId = $cart->whereIn('id', $request->get('package'));
                        if (\Cart::isEmpty()) {
                            $cart_data = [];
                        } else {
                            foreach ($cart as $row) {
                                $package = Package::find($row->id);
                                $cart[] = [
                                    'rowId' => $row->id,
                                    'name' => $row->name,
                                    'qty' => $row->quantity,
                                    'pricesingle' => $row->price,
                                    'price' => $row->getPriceSum(),
                                    'created_at' => $row->attributes['created_at'],
                                    'category' => $package->category
                                ];
                            }
                            $cart_data = collect($cart)->sortBy('created_at');
                        }
                        $get_total = \Cart::session($request->get('member'))->getTotal();
                        $counted = ucwords(counted($get_total) . ' Rupiah');
                        return response()->json([
                            'id' => $request->get('package'),
                            'total' => $get_total,
                            'counted' => $counted,
                            'cart' => $cart_data,
                            'qty' => $cek_itemId[$request->get('package')]->quantity,
                            'name' => $cek_itemId[$request->get('package')]->name,
                            'price' => $cek_itemId[$request->get('package')]->price,
                            'category' => $cek_itemId[$request->get('package')]->category,
                            'status' => 'VALID'
                        ], 200);
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function update_qty(Request $request) {
        $package = Package::find($request->get('id'));
        $cart = \Cart::session($request->get('member'))->getContent();
        $cek_itemId = $cart->whereIn('id', $request->get('id'));
        if ($request->get('type') == 'plus') {
            try {
                if ($package->quantity == $cek_itemId[$request->get('id')]->quantity) {
                    return redirect()->back()->with('error', 'jumlah item kurang');
                } else {
                    \Cart::session($request->get('member'))->update($request->get('id'), array(
                        'quantity' => array(
                            'relative' => true,
                            'value' => 1
                        )
                    ));
                    $items = \Cart::session($request->get('member'))->getContent();
                    $get_total = \Cart::session($request->get('member'))->getTotal();
                    $counted = ucwords(counted($get_total) . ' Rupiah');
                    return response()->json([
                        'id' => $request->get('id'),
                        'total' => $get_total,
                        'counted' => $counted,
                        'cart' => $items,
                        'qty' => $cek_itemId[$request->get('id')]->quantity,
                        'price' => $cek_itemId[$request->get('id')]->price
                    ], 200);
                }
            } catch (\Throwable $th) {
                return redirect()->back();
            }
        } else {
            try {
                if ($cek_itemId[$request->get('id')]->quantity == 1) {
                    \Cart::session($request->get('member'))->remove($request->get('id'));
                } else {
                    \Cart::session($request->get('member'))->update($request->get('id'), array(
                        'quantity' => array(
                            'relative' => true,
                            'value' => -1
                        )
                    ));
                }
                $items = \Cart::session($request->get('member'))->getContent();
                $get_total = \Cart::session($request->get('member'))->getTotal();
                $counted = '';
                if (\Cart::isEmpty()) {
                    $counted = '-';
                } else {
                    $counted = ucwords(counted($get_total) . ' Rupiah');
                }
                return response()->json([
                    'id' => $request->get('id'),
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $items,
                    'qty' => $cek_itemId[$request->get('id')]->quantity,
                    'price' => $cek_itemId[$request->get('id')]->price
                ], 200);
            } catch (\Throwable $th) {
                return redirect()->back();
            }
        }
    }

    public function remove(Request $request) {
        try {
            $items = \Cart::session($request->get('member'))->getContent();
            \Cart::session($request->get('member'))->remove($request->get('package'));
            $get_total = \Cart::session($request->get('member'))->getTotal();
            $counted = '';
            if (\Cart::isEmpty()) {
                $counted = '-';
            } else {
                $counted = ucwords(counted($get_total) . ' Rupiah');
            }
            return response()->json([
                'id' => $request->get('id'),
                'total' => $get_total,
                'counted' => $counted,
                'cart' => count($items),
            ], 200);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function clear_cart(Request $request) {
        try {
            \Cart::session($request->get('member'))->clear();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function checkout(Request $request, $id) {
        $get_id = $id;
        $link_pos = URL::signedRoute('order.cart', ['id' => $id]);
        try {
            $visitor = Visitor::find($get_id);
            $items = \Cart::session($get_id)->getContent();
            $totalPrice = \Cart::session($get_id)->getTotal();
            $today = Carbon::now()->isoFormat('dddd');
            if (\Cart::isEmpty()) {
                $cart_data = [];
            } else {
                foreach ($items as $row) {
                    $id_package[] = $row->id;
                    $item_default = 0;
                    $cek_itemId = $items->whereIn('id', $id_package);
                    $package = Package::find($row->id);
                    $cart[] = [
                        'rowId' => $row->id,
                        'name' => $row->name,
                        'qty' => $row->quantity,
                        'pricesingle' => $row->price,
                        'price' => $row->getPriceSum(),
                        'created_at' => $row->attributes['created_at'],
                        'category' => $package->category,
                    ];
                    foreach($cek_itemId as $item){
                        $item_default += $item['quantity'];
                    }
                }
                
                $price_single = 0;
                $package_additional = Package::whereIn('id', $id_package)->where('category', 'additional')->get();
                $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
                $package_others = Package::whereIn('id', $id_package)->where('category', 'others')->get();
                $orders = collect($cart)->sortBy('created_at');
                foreach($package_default as $default){
                    $price_single += $today === 'Sabtu' || $today === 'Minggu' ? $default['price_weekend'] : $default['price_weekdays'];
                }
            }
            $order_number = 'INV/' . Carbon::now()->format('Ymd') . '/' . $visitor->tipe_member . '/' . Carbon::now()->format('his');
            $deposit = Deposit::where('visitor_id', $get_id)->first();
            $log_limit = LogLimit::where('visitor_id', $get_id)->first();
            $log_coupon = LogCoupon::where('visitor_id', $get_id)->first();
            if ($request->ajax()) {
                return response()->json(['order_number' => $order_number]);
            }
            return view("membership.checkout", compact('log_limit','log_coupon', 'get_id', 'price_single', 'item_default', 'package_default', 'package_additional', 'package_others', 'visitor', 'deposit', 'totalPrice', 'order_number', 'orders'))->render();
        } catch (\Throwable $th) {
            return redirect()->to($link_pos); 
        }
    }

    public function select(Request $request) {
        $type = $request->get('type');
        $items = \Cart::session($request->get('param'))->getContent();
        $totalPrice = \Cart::session($request->get('param'))->getTotal();
        $deposit = Deposit::where('visitor_id', $request->get('param'))->first();
        $log_limit = LogLimit::where('visitor_id', $request->get('param'))->first();        
        $log_coupon = LogCoupon::where('visitor_id', $request->get('param'))->first();        
        $today = Carbon::now()->isoFormat('dddd');
        $id_package = [];
        foreach ($items as $row) {
            $package = Package::find($row->id);
            $id_package[] = $row->id;
            $cart[] = [
                'rowId' => $row->id,
                'name' => $row->name,
                'qty' => $row->quantity,
                'pricesingle' => $row->price,
                'price' => $row->getPriceSum(),
                'created_at' => $row->attributes['created_at'],
                'category' => $package->category
            ];
        }
        $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
        $price_default = 0;
        foreach($package_default as $default){
            $price_default += $today === 'Sabtu' || $today === 'Minggu' ? $default['price_weekend'] : $default['price_weekdays'];
        }
        $orders = collect($cart)->sortBy('created_at');

        if ($type == 4) {
            $resultPrice =  $deposit->balance - $totalPrice;
            if ($resultPrice == 0) {
                try {
                    return response(['limit' => $log_limit->quota, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'price' => $resultPrice, 'kupon' => $log_coupon->quota_kupon, 'status' => 'VALID', 'message' => 'Saldo telah dipilih']);
                } catch (\Throwable $th) {
                    return response()->json($this->getResponse());
                }
            } else {
                if ($resultPrice > 0) {
                    try {
                        return response(['limit' => $log_limit->quota, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'price' => $resultPrice, 'kupon' => $log_coupon->quota_kupon, 'status' => 'VALID', 'message' => 'Saldo telah dipilih']);
                    } catch (\Throwable $th) {
                        return response()->json($this->getResponse());
                    }
                } else {
                    $this->setResponse('INVALID', "Saldo tidak terpenuhi");
                    return response()->json($this->getResponse());
                }
            }
        } else if ($type == 3) {
            try {
                return response(['limit' => $log_limit->quota, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'price' => $deposit->balance, 'kupon' => $log_coupon->quota_kupon, 'status' => 'VALID', 'message' => 'Cash/Transfer telah dipilih']);
            } catch (\Throwable $th) {
                return response()->json($this->getResponse());
            }
        } else if ($type == 2) {
            $resultKupon =  $log_coupon->quota_kupon - 1;
            if ($log_coupon->quota_kupon == 0) {
                return response(['price' => $deposit->balance, 'limit' => $log_limit->quota, 'kupon' => 0, 'status' => 'INVALID', 'message' => 'Kupon tidak terpenuhi']);
            } else {
                return response(['price' => $deposit->balance, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'limit' => $log_limit->quota, 'kupon' => $resultKupon, 'status' => 'VALID', 'message' => 'Limit telah dipilih']);
            }
        } else if ($type == 1) {
            $resultLimit =  $log_limit->quota - 1;
            if ($log_limit->quota == 0) {
                return response(['price' => $deposit->balance, 'limit' => 0, 'kupon' => $log_coupon->quota_kupon, 'status' => 'INVALID', 'message' => 'Limit tidak terpenuhi']);
            } else {
                return response(['price' => $deposit->balance, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'limit' => $resultLimit, 'kupon' => $log_coupon->quota_kupon, 'status' => 'VALID', 'message' => 'Limit telah dipilih']);
            }
        }
    }

    public function pay(Request $req) {
        $visitor = Visitor::find($req->get('page'));
        $items = \Cart::session($req->get('page'))->getContent();
        $deposit = Deposit::where('visitor_id', $req->get('page'))->first();
        $log_limit = LogLimit::where('visitor_id', $req->get('page'))->first();
        $log_coupon = LogCoupon::where('visitor_id', $req->get('page'))->first();
        $totalPrice = \Cart::session($req->get('page'))->getTotal();
        $price_single = 0;
        $today = Carbon::now()->isoFormat('dddd');
        if (\Cart::isEmpty()) {
            $cart_data = [];
        } else {
            foreach ($items as $row) {
                $id_package[] = $row->id;
                $item_default = 0;
                $cek_itemId = $items->whereIn('id', $id_package);
                $package = Package::find($row->id);
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'category' => $package->category,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                    'created_at' => $row->attributes['created_at'],
                ];
                foreach($cek_itemId as $item){
                    $item_default += $item['quantity'];
                }
            }
            $cart_data = collect($cart)->sortBy('created_at');
        }
        $priceDefault = Arr::where($cart, function ($value, $key) {
            return $value['category'] == 'default';
        });
        $priceAdditional = Arr::where($cart, function ($value, $key) {
            return $value['category'] == 'additional';
        });
        $priceOthers = Arr::where($cart, function ($value, $key) {
            return $value['category'] == 'others';
        });
        $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
        foreach($package_default as $default){
            $price_single += $today === 'Sabtu' || $today === 'Minggu' ? $default['price_weekend'] : $default['price_weekdays'];
        }

        if ($req->get('type') == 'single') {
            if ($req->get('type_single') == null) {
                $this->setResponse('INVALID', "Silahkan pilih jenis single pembayaran");
                return response()->json($this->getResponse());
            } else {
                if ($req->get('type_single') == 4) {
                    if($visitor->expired_date <= Carbon::now()) {
                        $this->setResponse('INVALID', "Masa berlaku member habis");
                        return response()->json($this->getResponse());
                    } else if($visitor->status == 'inactive') {
                        $this->setResponse('INVALID', "Member tidak aktif");
                        return response()->json($this->getResponse());
                    } else {
                        if ($deposit->balance < $totalPrice) {
                            $this->setResponse('INVALID', "Saldo tidak terpenuhi");
                            return response()->json($this->getResponse());
                        } else {
                            try {
                                $deposit->balance = $deposit->balance - $totalPrice;
                                $deposit->save();
    
                                LogTransaction::create([
                                    'order_number' => $req->get('order_number'),
                                    'visitor_id' => $req->get('page'),
                                    'user_id' => Auth()->id(),
                                    'cart' => serialize($cart_data),
                                    'payment_type' => serialize([
                                        ['payment_type' => 'deposit', 
                                        'transaction_amount' => $totalPrice, 
                                        'balance' => $deposit->balance,
                                        'discount' => 0,
                                        'refund' => 0
                                    ]]),
                                    'payment_status' => 'paid',
                                    'total' => $totalPrice,
                                    'total_gross' => $totalPrice,
                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                ]);
    
                                LogAdmin::create([
                                    'user_id' => Auth::id(),
                                    'type' => 'CREATE',
                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                ]);
    
                                ReportDeposit::create([
                                    'payment_type' => 'deposit',
                                    'report_balance' => $totalPrice,
                                    'visitor_id' => $req->get('page'),
                                    'user_id' => Auth()->id(),
                                    'fund' => $deposit->balance,
                                    'status' => 'Berkurang',
                                    'created_at' => Carbon::now(),
                                ]);
                                \Cart::session($req->get('page'))->clear();
    
                                if ($req->ajax()) {
                                    $this->setResponse('VALID', "Pembayaran berhasil");
                                    return response()->json($this->getResponse());
                                }
                            } catch (Throwable $e) {
                                return response()->json($this->getResponse());
                            }
                        }
                    }
                } else if ($req->get('type_single') == 3) {
                    if($visitor->expired_date <= Carbon::now()) {
                        $this->setResponse('INVALID', "Masa berlaku member habis");
                        return response()->json($this->getResponse());
                    } else if($visitor->status == 'inactive') {
                        $this->setResponse('INVALID', "Member tidak aktif");
                        return response()->json($this->getResponse());
                    } else {
                        if (is_null($req->get('bayar_cash'))) {
                            $this->setResponse('INVALID', "Nominal wajib diisi");
                            return response()->json($this->getResponse());
                        } else {
                            if ($req->get('bayar_cash') < $totalPrice) {
                                $this->setResponse('INVALID', "Nominal tidak terpenuhi");
                                return response()->json($this->getResponse());
                            } else {
                                try {
                                    LogTransaction::create([
                                        'order_number' => $req->get('order_number'),
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'cart' => serialize($cart_data),
                                        'payment_type' => serialize([[
                                            'payment_type' => 'cash/transfer', 
                                            'transaction_amount' => $req->get('bayar_cash'), 
                                            'balance' => 0,
                                            'discount' => 0,
                                            'refund' => $req->get('refund')
                                        ]]),
                                        'payment_status' => 'paid',
                                        'total' => $totalPrice,
                                        'total_gross' => $totalPrice,
                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                    ]);
    
                                    LogAdmin::create([
                                        'user_id' => Auth::id(),
                                        'type' => 'CREATE',
                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                    ]);
    
                                    \Cart::session($req->get('page'))->clear();

                                    if ($req->ajax()) {
                                        return response()->json([
                                            'status' => 'VALID',
                                            'message' => 'Pembayaran berhasil',
                                            'return' => $req->get('bayar_cash')
                                        ]);
                                    }
                                } catch (Throwable $e) {
                                    return response()->json($this->getResponse());
                                }
                            }
                        }
                    }
                } else if ($req->get('type_single') == 2) {
                    if($visitor->expired_date <= Carbon::now()) {
                        $this->setResponse('INVALID', "Masa berlaku member habis");
                        return response()->json($this->getResponse());
                    } else if($visitor->status == 'inactive') {
                        $this->setResponse('INVALID', "Member tidak aktif");
                        return response()->json($this->getResponse());
                    } else {
                        if ($log_coupon->quota_kupon == 0) {
                            $this->setResponse('INVALID', "Kupon tidak terpenuhi");
                            return response()->json($this->getResponse());
                        } else {
                            $id_package = [];
                            foreach ($items as $sd) {
                                $id_package[] = $sd['id'];
                            }
                            $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
                            $package_additional = Package::whereIn('id', $id_package)->where('category', 'additional')->get();
                            if (count($package_additional) >= 1) {
                                $this->setResponse('INVALID', "Kupon hanya berlaku satu jenis permainan");
                                return response()->json($this->getResponse());
                            } else if ($package_default) {
                                if (count($package_default) != 1) {
                                    $this->setResponse('INVALID', "Single kupon hanya berlaku satu jenis permainan");
                                    return response()->json($this->getResponse());
                                } else {
                                    $cek_itemId = $items->whereIn('id', $id_package);
                                    $item_default = 0;
                                    foreach($cek_itemId as $item){
                                        $item_default += $item['quantity'];
                                    }
                                    if ($item_default != 1) {
                                        $this->setResponse('INVALID', "Kupon hanya berlaku untuk satu permainan");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try {
                                            $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                            $log_coupon->save();
        
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'kupon', 
                                                    'transaction_amount' => $price_single, 
                                                    'balance' => $log_coupon->quota_kupon,
                                                    'discount' => $price_single,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice - $price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
        
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
        
                                            // informasi limit kupon
                                            ReportCoupon::create([
                                                'status' => 'Berkurang',
                                                'report_quota_kupon' => $log_coupon->quota_kupon,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'created_at' => Carbon::now(),
                                            ]);
                                            \Cart::session($req->get('page'))->clear();
        
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if($visitor->expired_date <= Carbon::now()) {
                        $this->setResponse('INVALID', "Masa berlaku member habis");
                        return response()->json($this->getResponse());
                    } else if($visitor->status == 'inactive') {
                        $this->setResponse('INVALID', "Member tidak aktif");
                        return response()->json($this->getResponse());
                    } else {
                        if ($log_limit->quota == 0) {
                            $this->setResponse('INVALID', "Limit tidak terpenuhi");
                            return response()->json($this->getResponse());
                        } else {
                            $id_package = [];
                            foreach ($items as $sd) {
                                $id_package[] = $sd['id'];
                            }
                            $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
                            $package_additional = Package::whereIn('id', $id_package)->where('category', 'additional')->get();
                            if (count($package_additional) >= 1) {
                                $this->setResponse('INVALID', "Limit hanya berlaku satu jenis permainan");
                                return response()->json($this->getResponse());
                            } else if ($package_default) {
                                if (count($package_default) != 1) {
                                    $this->setResponse('INVALID', "Single limit hanya berlaku satu jenis permainan");
                                    return response()->json($this->getResponse());
                                } else {
                                    $cek_itemId = $items->whereIn('id', $id_package);
                                    $item_default = 0;
                                    foreach($cek_itemId as $item){
                                        $item_default += $item['quantity'];
                                    }
                                    if ($item_default != 1) {
                                        $this->setResponse('INVALID', "Limit hanya berlaku untuk satu permainan");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try {
                                            $log_limit->quota = $log_limit->quota - 1;
                                            $log_limit->save();
        
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'limit', 
                                                    'transaction_amount' => $price_single, 
                                                    'balance' => $log_limit->quota,
                                                    'discount' => $price_single,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice - $price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
        
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
        
                                            // informasi limit bulanan
                                            ReportLimit::create([
                                                'status' => 'Berkurang',
                                                'report_quota' => $log_limit->quota,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'created_at' => Carbon::now(),
                                            ]);
                                            \Cart::session($req->get('page'))->clear();
        
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if (empty($req->get('type_multiple'))) {
                $this->setResponse('INVALID', "Silahkan pilih jenis split pembayaran");
                return response()->json($this->getResponse());
            } else {
                if($deposit->balance == $totalPrice) {
                    if(count($req->get('type_multiple')) == 1) {
                        if ($req->get('type_multiple')[0] == 'deposit') {
                            if($visitor->expired_date <= Carbon::now()) {
                                $this->setResponse('INVALID', "Masa berlaku member habis");
                                return response()->json($this->getResponse());
                            } else if($visitor->status == 'inactive') {
                                $this->setResponse('INVALID', "Member tidak aktif");
                                return response()->json($this->getResponse());
                            } else {
                                try{
                                    $deposit->balance = $deposit->balance - $totalPrice;
                                    $deposit->save();
                                    
                                    LogTransaction::create([
                                        'order_number' => $req->get('order_number'),
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'cart' => serialize($cart_data),
                                        'payment_type' => serialize([[
                                            'payment_type' => 'deposit',
                                            'transaction_amount' => $totalPrice,
                                            'balance' => $deposit->balance,
                                            'discount' => 0,
                                            'refund' => 0
                                        ]]),
                                        'payment_status' => 'paid',
                                        'total' => $totalPrice,
                                        'total_gross' => $totalPrice,
                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                    ]);
        
                                    LogAdmin::create([
                                        'user_id' => Auth::id(),
                                        'type' => 'CREATE',
                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                    ]);
        
                                    ReportDeposit::create([
                                        'payment_type' => 'deposit',
                                        'report_balance' => $totalPrice,
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'fund' => $deposit->balance,
                                        'status' => 'Berkurang',
                                        'created_at' => Carbon::now(),
                                    ]);
                                    \Cart::session($req->get('page'))->clear();
        
                                    if ($req->ajax()) {
                                        $this->setResponse('VALID', "Pembayaran berhasil");
                                        return response()->json($this->getResponse());
                                    }
                                } catch (Throwable $e) {
                                    return response()->json($this->getResponse());
                                }
                            }
                        } else if ($req->get('type_multiple')[0] == 'cash/transfer') {
                            if($visitor->expired_date <= Carbon::now()) {
                                $this->setResponse('INVALID', "Masa berlaku member habis");
                                return response()->json($this->getResponse());
                            } else if($visitor->status == 'inactive') {
                                $this->setResponse('INVALID', "Member tidak aktif");
                                return response()->json($this->getResponse());
                            } else {
                                if (is_null($req->get('bayar_input'))) {
                                    $this->setResponse('INVALID', "Nominal wajib diisi");
                                    return response()->json($this->getResponse());
                                } else {
                                    if ($req->get('bayar_input') != $totalPrice) {
                                        if ($req->get('bayar_input') >= $totalPrice){
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([[
                                                        'payment_type' => 'cash/transfer', 
                                                        'transaction_amount' => $req->get('bayar_input'), 
                                                        'balance' => 0,
                                                        'discount' => 0,
                                                        'refund' => $req->get('refund')
                                                    ]]),
                                                    'payment_status' => 'paid',
                                                    'total' => $totalPrice,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
                                            } catch (Throwable $e) {
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            $this->setResponse('INVALID', "Nominal yang harus dibayarkan $totalPrice");
                                            return response()->json($this->getResponse());
                                        }
                                    } else {
                                        try {
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'cash/transfer', 
                                                    'transaction_amount' => $req->get('bayar_input'), 
                                                    'balance' => 0,
                                                    'discount' => 0,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
            
                                            if ($req->ajax()) {
                                                return response()->json([
                                                    'status' => 'VALID',
                                                    'message' => 'Pembayaran berhasil',
                                                    'return' => $req->get('bayar_input')
                                                ]);
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        } else if ($req->get('type_multiple')[0] == 'kupon') {
                            if($visitor->expired_date <= Carbon::now()) {
                                $this->setResponse('INVALID', "Masa berlaku member habis");
                                return response()->json($this->getResponse());
                            } else if($visitor->status == 'inactive') {
                                $this->setResponse('INVALID', "Member tidak aktif");
                                return response()->json($this->getResponse());
                            } else {
                                if($item_default != 1){
                                    $this->setResponse('INVALID', "Gunakan split deposit atau cash/transfer");
                                    return response()->json($this->getResponse());
                                } else {
                                    try {
                                        $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                        $log_coupon->save();
        
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([[
                                                'payment_type' => 'kupon',
                                                'transaction_amount' => $price_single,
                                                'balance' => $log_coupon->quota_kupon,
                                                'discount' => $price_single,
                                                'refund' => 0
                                            ]]),
                                            'payment_status' => 'paid',
                                            'total' => $totalPrice - $price_single,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
        
                                        ReportCoupon::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota_kupon' => $log_coupon->quota_kupon,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
                                        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (Throwable $e) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            }
                        } else if ($req->get('type_multiple')[0] == 'limit') {
                            if($visitor->expired_date <= Carbon::now()) {
                                $this->setResponse('INVALID', "Masa berlaku member habis");
                                return response()->json($this->getResponse());
                            } else if($visitor->status == 'inactive') {
                                $this->setResponse('INVALID', "Member tidak aktif");
                                return response()->json($this->getResponse());
                            } else {
                                if($item_default != 1){
                                    $this->setResponse('INVALID', "Gunakan split deposit atau cash/transfer");
                                    return response()->json($this->getResponse());
                                } else {
                                    try {
                                        $log_limit->quota = $log_limit->quota - 1;
                                        $log_limit->save();
        
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([[
                                                'payment_type' => 'limit',
                                                'transaction_amount' => $price_single,
                                                'balance' => $log_limit->quota,
                                                'discount' => $price_single,
                                                'refund' => 0
                                            ]]),
                                            'payment_status' => 'paid',
                                            'total' => $totalPrice - $price_single,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
        
                                        ReportLimit::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota' => $log_limit->quota,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
                                        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (Throwable $e) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            }
                        }
                    } else if (count($req->get('type_multiple')) == 2) {
                        if($req->get('type_multiple')[0] == 'deposit') {
                            if($req->get('type_multiple')[1] == 'cash/transfer') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if ($req->get('bayar_input') > ceil($totalPrice)) {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'deposit', 'transaction_amount' => 0, 'balance' => $deposit->balance,'discount' => 0, 'refund' => 0],
                                                        ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0,'discount' => 0, 'refund' => $req->get('refund')]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $totalPrice,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
    
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
    
                                                ReportDeposit::create([
                                                    'payment_type' => 'deposit',
                                                    'report_balance' => 0,
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'fund' => $deposit->balance,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
    
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
    
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            $minus_deposit = $totalPrice - $req->get('bayar_input');
                                            $deposit->balance = $deposit->balance - $minus_deposit;
                                            $deposit->save();
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'deposit', 'transaction_amount' => $minus_deposit, 'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                        ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0, 'discount' => 0, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $totalPrice,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
    
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
    
                                                ReportDeposit::create([
                                                    'payment_type' => 'deposit',
                                                    'report_balance' => $minus_deposit,
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'fund' => $deposit->balance,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
    
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
    
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            } else if ($req->get('type_multiple')[1] == 'kupon') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    try {
                                        $deposit_before = $deposit->balance;
                                        $deposit->balance = $totalPrice - $price_single;
    
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([
                                                ['payment_type' => 'deposit','transaction_amount' => $deposit->balance,'balance' => $deposit_before, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                            ]),
                                            'payment_status' => 'paid',
                                            'total' => $deposit->balance,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
        
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => $deposit->balance,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit_before,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
    
                                        $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                        $log_coupon->save();
                                        $deposit->save();
        
                                        ReportCoupon::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota_kupon' => $log_coupon->quota_kupon,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (\Throwable $th) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            } else if ($req->get('type_multiple')[1] == 'limit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    try {
                                        $deposit_before = $deposit->balance;
                                        $deposit->balance = $totalPrice - $price_single;
    
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([
                                                ['payment_type' => 'deposit','transaction_amount' => $deposit->balance,'balance' => $deposit_before, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                            ]),
                                            'payment_status' => 'paid',
                                            'total' => $deposit->balance,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
        
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => $deposit->balance,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit_before,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
    
                                        $log_limit->quota = $log_limit->quota - 1;
                                        $log_limit->save();
                                        $deposit->save();
        
                                        ReportLimit::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota' => $log_limit->quota,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (\Throwable $th) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            }
                        } else if($req->get('type_multiple')[0] == 'cash/transfer') {
                            if($req->get('type_multiple')[1] == 'kupon') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        $remaining_balance = $totalPrice - $price_single;
                                        if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                        ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $remaining_balance,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                                $log_coupon->save();
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                ReportCoupon::create([
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'report_quota_kupon' => $log_coupon->quota_kupon,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                    
                                                if ($req->ajax()) {
                                                    $this->setResponse('VALID', "Pembayaran berhasil");
                                                    return response()->json($this->getResponse());
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            $this->setResponse('INVALID', "Nominal yang harus dibayarkan $remaining_balance");
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            } else if($req->get('type_multiple')[1] == 'limit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        $remaining_balance = $totalPrice - $price_single;
                                        if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                        ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $remaining_balance,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                $log_limit->quota = $log_limit->quota - 1;
                                                $log_limit->save();
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                ReportLimit::create([
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'report_quota' => $log_limit->quota,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                    
                                                if ($req->ajax()) {
                                                    $this->setResponse('VALID', "Pembayaran berhasil");
                                                    return response()->json($this->getResponse());
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            $this->setResponse('INVALID', "Nominal yang harus dibayarkan $remaining_balance");
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        }
                    } else if (count($req->get('type_multiple')) == 3) {
                        $remaining_balance = $totalPrice - $price_single;
                        if($req->get('type_multiple')[2] == 'kupon') {
                            if($visitor->expired_date <= Carbon::now()) {
                                $this->setResponse('INVALID', "Masa berlaku member habis");
                                return response()->json($this->getResponse());
                            } else if($visitor->status == 'inactive') {
                                $this->setResponse('INVALID', "Member tidak aktif");
                                return response()->json($this->getResponse());
                            } else {
                                if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                    try {
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([
                                                ['payment_type' => 'deposit','transaction_amount' => 0,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                            ]),
                                            'payment_status' => 'paid',
                                            'total' => $remaining_balance,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
        
                                        $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                        $log_coupon->save();
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
    
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => 0,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit->balance,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        ReportCoupon::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota_kupon' => $log_coupon->quota_kupon,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (\Throwable $th) {
                                        return response()->json($this->getResponse());
                                    }
                                } else {
                                    $minus_deposit = $remaining_balance - $req->get('bayar_input');
                                    $deposit->balance = $deposit->balance - $minus_deposit;
                                    try {
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([
                                                ['payment_type' => 'deposit','transaction_amount' => $minus_deposit,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                            ]),
                                            'payment_status' => 'paid',
                                            'total' => $remaining_balance,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
                                        
                                        $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                        $log_coupon->save();
                                        $deposit->save();
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
    
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => $minus_deposit,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit->balance,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        ReportCoupon::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota_kupon' => $log_coupon->quota_kupon,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (\Throwable $th) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            }
                        } else if ($req->get('type_multiple')[2] == 'limit') {
                            if($visitor->expired_date <= Carbon::now()) {
                                $this->setResponse('INVALID', "Masa berlaku member habis");
                                return response()->json($this->getResponse());
                            } else if($visitor->status == 'inactive') {
                                $this->setResponse('INVALID', "Member tidak aktif");
                                return response()->json($this->getResponse());
                            } else {
                                if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                    try {
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([
                                                ['payment_type' => 'deposit','transaction_amount' => 0,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                            ]),
                                            'payment_status' => 'paid',
                                            'total' => $remaining_balance,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
        
                                        $log_limit->quota = $log_limit->quota - 1;
                                        $log_limit->save();
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
    
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => 0,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit->balance,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        ReportLimit::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota' => $log_limit->quota,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (\Throwable $th) {
                                        return response()->json($this->getResponse());
                                    }
                                } else {
                                    $minus_deposit = $remaining_balance - $req->get('bayar_input');
                                    $deposit->balance = $deposit->balance - $minus_deposit;
                                    try {
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([
                                                ['payment_type' => 'deposit','transaction_amount' => $minus_deposit,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => 0],
                                                ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                            ]),
                                            'payment_status' => 'paid',
                                            'total' => $remaining_balance,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
                                        
                                        $log_limit->quota = $log_limit->quota - 1;
                                        $log_limit->save();
                                        $deposit->save();
        
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
    
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => $minus_deposit,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit->balance,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        ReportLimit::create([
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'report_quota' => $log_limit->quota,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
        
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (\Throwable $th) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if($deposit->balance < $totalPrice) {
                        if(count($req->get('type_multiple')) == 1) {
                            if ($req->get('type_multiple')[0] == 'deposit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if ($deposit->balance < $totalPrice) {
                                        $this->setResponse("INVALID", "Tambahkan metode lain untuk sisa pembayaran");
                                        return response()->json($this->getResponse());
                                    }
                                }
                            } else if ($req->get('type_multiple')[0] == 'cash/transfer') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if ($req->get('bayar_input') != $totalPrice) {
                                            if ($req->get('bayar_input') > $totalPrice) {
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([[
                                                            'payment_type' => 'cash/transfer', 
                                                            'transaction_amount' => $req->get('bayar_input'), 
                                                            'balance' => 0,
                                                            'discount' => 0,
                                                            'refund' => $req->get('refund')
                                                        ]]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
                    
                                                    \Cart::session($req->get('page'))->clear();
                    
                                                    if ($req->ajax()) {
                                                        return response()->json([
                                                            'status' => 'VALID',
                                                            'message' => 'Pembayaran berhasil',
                                                            'return' => $req->get('bayar_input')
                                                        ]);
                                                    }
                                                } catch (Throwable $e) {
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                $this->setResponse('INVALID', "Nominal yang harus dibayarkan $totalPrice");
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([[
                                                        'payment_type' => 'cash/transfer', 
                                                        'transaction_amount' => $req->get('bayar_input'), 
                                                        'balance' => 0,
                                                        'discount' => 0,
                                                        'refund' => 0
                                                    ]]),
                                                    'payment_status' => 'paid',
                                                    'total' => $totalPrice,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            } else if($req->get('type_multiple')[0] == 'kupon') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if($item_default != 1){
                                        $this->setResponse('INVALID', "Gunakan split deposit atau cash/transfer");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try{
                                            $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                            $log_coupon->save();
        
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'kupon',
                                                    'transaction_amount' => $price_single,
                                                    'balance' => $log_coupon->quota_kupon,
                                                    'discount' => $price_single,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice - $price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
        
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
        
                                            ReportCoupon::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota_kupon' => $log_coupon->quota_kupon,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
                                            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (Throwable $e) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            } else if($req->get('type_multiple')[0] == 'limit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if($item_default != 1){
                                        $this->setResponse('INVALID', "Gunakan split deposit atau cash/transfer");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try{
                                            $log_limit->quota = $log_limit->quota - 1;
                                            $log_limit->save();
        
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'limit',
                                                    'transaction_amount' => $price_single,
                                                    'balance' => $log_limit->quota,
                                                    'discount' => $price_single,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice - $price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
        
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
        
                                            ReportLimit::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota' => $log_limit->quota,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
                                            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (Throwable $e) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        } else if (count($req->get('type_multiple')) == 2) {
                            if($req->get('type_multiple')[0] == 'deposit') {
                                if($req->get('type_multiple')[1] == 'cash/transfer') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if (is_null($req->get('bayar_input'))) {
                                            $this->setResponse('INVALID', "Nominal wajib diisi");
                                            return response()->json($this->getResponse());
                                        } else {
                                            $remaining_balance = $totalPrice - $deposit->balance;
                                            if ($req->get('bayar_input') != ceil($remaining_balance)) {
                                                if ($req->get('bayar_input') >= ceil($remaining_balance)){
                                                    try{
                                                        $deposit_before = $deposit->balance;
                                                        $deposit->balance = $deposit->balance - $deposit->balance;
                                                        $deposit->save();
                                
                                                        LogTransaction::create([
                                                            'order_number' => $req->get('order_number'),
                                                            'visitor_id' => $req->get('page'),
                                                            'user_id' => Auth()->id(),
                                                            'cart' => serialize($cart_data),
                                                            'payment_type' => serialize([
                                                                ['payment_type' => 'deposit','transaction_amount' => $deposit_before,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                                ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')]
                                                            ]),
                                                            'payment_status' => 'paid',
                                                            'total' => $totalPrice,
                                                            'total_gross' => $totalPrice,
                                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                        ]);
                        
                                                        LogAdmin::create([
                                                            'user_id' => Auth::id(),
                                                            'type' => 'CREATE',
                                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                        ]);
                        
                                                        ReportDeposit::create([
                                                            'payment_type' => 'deposit',
                                                            'report_balance' => $deposit_before,
                                                            'visitor_id' => $req->get('page'),
                                                            'user_id' => Auth()->id(),
                                                            'fund' => $deposit->balance,
                                                            'status' => 'Berkurang',
                                                            'created_at' => Carbon::now(),
                                                        ]);
                                                        \Cart::session($req->get('page'))->clear();
                            
                                                        if ($req->ajax()) {
                                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                                            return response()->json($this->getResponse());
                                                        }
                            
                                                    } catch (Throwable $e) {
                                                        return response()->json($this->getResponse());
                                                    }
                                                } else {
                                                    $this->setResponse('INVALID', "Nominal yang harus dibayarkan $remaining_balance");
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                try{
                                                    $deposit_before = $deposit->balance;
                                                    $deposit->balance = $deposit->balance - $deposit->balance;
                                                    $deposit->save();
                            
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'deposit','transaction_amount' => $deposit_before,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                            ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => 0]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
                    
                                                    ReportDeposit::create([
                                                        'payment_type' => 'deposit',
                                                        'report_balance' => $deposit_before,
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'fund' => $deposit->balance,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
                                                    \Cart::session($req->get('page'))->clear();
                        
                                                    if ($req->ajax()) {
                                                        $this->setResponse('VALID', "Pembayaran berhasil");
                                                        return response()->json($this->getResponse());
                                                    }
                        
                                                } catch (Throwable $e) {
                                                    return response()->json($this->getResponse());
                                                }
                                            }
                                        }
                                    }
                                } else if($req->get('type_multiple')[1] == 'kupon') {
                                    $remaining_balance = $totalPrice - $deposit->balance;
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if($remaining_balance != $price_single) {
                                            if ($remaining_balance >= $price_single){
                                                $this->setResponse('INVALID', "Tambahkan cash/transfer untuk sisa bayar");
                                                return response()->json($this->getResponse());
                                            } else {
                                                $this->setResponse('INVALID', "Harga satuan kupon tidak terpenuhi");
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            try {
                                                $deposit_before = $deposit->balance;
                                                $deposit->balance = $deposit->balance - $deposit->balance;
                                                $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                                $log_coupon->save();
                                                $deposit->save();
        
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'deposit','transaction_amount' => $deposit_before,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                        ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon, 'discount' => $price_single, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $deposit_before,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                ReportDeposit::create([
                                                    'payment_type' => 'deposit',
                                                    'report_balance' => $deposit_before,
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'fund' => $deposit->balance,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                ReportCoupon::create([
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'report_quota_kupon' => $log_coupon->quota_kupon,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                    
                                                if ($req->ajax()) {
                                                    $this->setResponse('VALID', "Pembayaran berhasil");
                                                    return response()->json($this->getResponse());
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                } else if($req->get('type_multiple')[1] == 'limit') {
                                    $remaining_balance = $totalPrice - $deposit->balance;
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if($remaining_balance != $price_single) {
                                            if ($remaining_balance >= $price_single){
                                                $this->setResponse('INVALID', "Tambahkan cash/transfer untuk sisa bayar");
                                                return response()->json($this->getResponse());
                                            } else {
                                                $this->setResponse('INVALID', "Harga satuan limit tidak terpenuhi");
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            try {
                                                $deposit_before = $deposit->balance;
                                                $deposit->balance = $deposit->balance - $deposit->balance;
                                                $log_limit->quota = $log_limit->quota - 1;
                                                $log_limit->save();
                                                $deposit->save();
        
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'deposit','transaction_amount' => $deposit_before,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                        ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota, 'discount' => $price_single, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $deposit_before,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                ReportDeposit::create([
                                                    'payment_type' => 'deposit',
                                                    'report_balance' => $deposit_before,
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'fund' => $deposit->balance,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                ReportLimit::create([
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'report_quota' => $log_limit->quota,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                    
                                                if ($req->ajax()) {
                                                    $this->setResponse('VALID', "Pembayaran berhasil");
                                                    return response()->json($this->getResponse());
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            } else if($req->get('type_multiple')[0] == 'cash/transfer') {
                                if($req->get('type_multiple')[1] == 'kupon') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if (is_null($req->get('bayar_input'))) {
                                            $this->setResponse('INVALID', "Nominal wajib diisi");
                                            return response()->json($this->getResponse());
                                        } else {
                                            $coupon_free = $totalPrice - $price_single;
                                            if($req->get('bayar_input') != $coupon_free) {
                                                if($req->get('bayar_input') >= $coupon_free) {
                                                    $log_coupon->quota_kupon = $log_coupon->quota_kupon -1;
                                                    $log_coupon->save();
    
                                                    try {
                                                        LogTransaction::create([
                                                            'order_number' => $req->get('order_number'),
                                                            'visitor_id' => $req->get('page'),
                                                            'user_id' => Auth()->id(),
                                                            'cart' => serialize($cart_data),
                                                            'payment_type' => serialize([
                                                                ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0,'discount' => 0, 'refund' => $req->get('refund')],
                                                                ['payment_type' => 'kupon', 'transaction_amount' => $price_single, 'balance' => $log_coupon->quota_kupon,'discount' => $price_single, 'refund' => 0]
                                                            ]),
                                                            'payment_status' => 'paid',
                                                            'total' => $totalPrice - $price_single,
                                                            'total_gross' => $totalPrice,
                                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                        ]);
                        
                                                        LogAdmin::create([
                                                            'user_id' => Auth::id(),
                                                            'type' => 'CREATE',
                                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                        ]);
    
                                                        ReportCoupon::create([
                                                            'visitor_id' => $req->get('page'),
                                                            'user_id' => Auth()->id(),
                                                            'report_quota_kupon' => $log_coupon->quota_kupon,
                                                            'status' => 'Berkurang',
                                                            'created_at' => Carbon::now(),
                                                        ]);
                        
                                                        \Cart::session($req->get('page'))->clear();
                        
                                                        if ($req->ajax()) {
                                                            return response()->json([
                                                                'status' => 'VALID',
                                                                'message' => 'Pembayaran berhasil',
                                                                'return' => $req->get('bayar_input')
                                                            ]);
                                                        }
                                                    } catch (\Throwable $th) {
                                                        return response()->json($this->getResponse());
                                                    }
                                                } else {
                                                    $this->setResponse('INVALID', "Nominal yang harus dibayarkan $coupon_free");
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                $log_coupon->quota_kupon = $log_coupon->quota_kupon -1;
                                                $log_coupon->save();
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'cash/transfer', 'transaction_amount' => $coupon_free, 'balance' => 0,'discount' => 0, 'refund' => 0],
                                                            ['payment_type' => 'kupon', 'transaction_amount' => $price_single, 'balance' => $log_coupon->quota_kupon,'discount' => $price_single, 'refund' => 0]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice - $price_single,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
    
                                                    ReportCoupon::create([
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'report_quota_kupon' => $log_coupon->quota_kupon,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
                    
                                                    \Cart::session($req->get('page'))->clear();
                    
                                                    if ($req->ajax()) {
                                                        return response()->json([
                                                            'status' => 'VALID',
                                                            'message' => 'Pembayaran berhasil',
                                                            'return' => $req->get('bayar_input')
                                                        ]);
                                                    }
                                                } catch (\Throwable $th) {
                                                    return response()->json($this->getResponse());
                                                }
                                            }
                                        }
                                    }
                                } else if($req->get('type_multiple')[1] == 'limit') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if (is_null($req->get('bayar_input'))) {
                                            $this->setResponse('INVALID', "Nominal wajib diisi");
                                            return response()->json($this->getResponse());
                                        } else {
                                            $limit_free = $totalPrice - $price_single;
                                            if($req->get('bayar_input') != $limit_free) {
                                                if($req->get('bayar_input') >= $limit_free) {
                                                    $log_limit->quota = $log_limit->quota -1;
                                                    $log_limit->save();
    
                                                    try {
                                                        LogTransaction::create([
                                                            'order_number' => $req->get('order_number'),
                                                            'visitor_id' => $req->get('page'),
                                                            'user_id' => Auth()->id(),
                                                            'cart' => serialize($cart_data),
                                                            'payment_type' => serialize([
                                                                ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0,'discount' => 0, 'refund' => $req->get('refund')],
                                                                ['payment_type' => 'limit', 'transaction_amount' => $price_single, 'balance' => $log_limit->quota,'discount' => $price_single, 'refund' => 0]
                                                            ]),
                                                            'payment_status' => 'paid',
                                                            'total' => $totalPrice - $price_single,
                                                            'total_gross' => $totalPrice,
                                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                        ]);
                        
                                                        LogAdmin::create([
                                                            'user_id' => Auth::id(),
                                                            'type' => 'CREATE',
                                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                        ]);
    
                                                        ReportLimit::create([
                                                            'visitor_id' => $req->get('page'),
                                                            'user_id' => Auth()->id(),
                                                            'report_quota' => $log_limit->quota,
                                                            'status' => 'Berkurang',
                                                            'created_at' => Carbon::now(),
                                                        ]);
                        
                                                        \Cart::session($req->get('page'))->clear();
                        
                                                        if ($req->ajax()) {
                                                            return response()->json([
                                                                'status' => 'VALID',
                                                                'message' => 'Pembayaran berhasil',
                                                                'return' => $req->get('bayar_input')
                                                            ]);
                                                        }
                                                    } catch (\Throwable $th) {
                                                        return response()->json($this->getResponse());
                                                    }
                                                } else {
                                                    $this->setResponse('INVALID', "Nominal yang harus dibayarkan $limit_free");
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                $log_limit->quota = $log_limit->quota -1;
                                                $log_limit->save();
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'cash/transfer', 'transaction_amount' => $limit_free, 'balance' => 0,'discount' => 0, 'refund' => 0],
                                                            ['payment_type' => 'limit', 'transaction_amount' => $price_single, 'balance' => $log_limit->quota,'discount' => $price_single, 'refund' => 0]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice - $price_single,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
    
                                                    ReportLimit::create([
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'report_quota' => $log_limit->quota,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
                    
                                                    \Cart::session($req->get('page'))->clear();
                    
                                                    if ($req->ajax()) {
                                                        return response()->json([
                                                            'status' => 'VALID',
                                                            'message' => 'Pembayaran berhasil',
                                                            'return' => $req->get('bayar_input')
                                                        ]);
                                                    }
                                                } catch (\Throwable $th) {
                                                    return response()->json($this->getResponse());
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else if (count($req->get('type_multiple')) == 3) {
                            $disc = $totalPrice - $price_single;
                            $deposit_before = $deposit->balance;
                            $minus_deposit = $disc - $deposit->balance;
                            $deposit->balance = $deposit->balance - $deposit->balance;
                            if($req->get('type_multiple')[2] == 'kupon') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if ($req->get('bayar_input') < $minus_deposit) {
                                            $this->setResponse('INVALID', "Nominal sisa bayar $minus_deposit");
                                            return response()->json($this->getResponse());
                                        } else {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'deposit', 'transaction_amount' => $deposit_before, 'balance' => $deposit->balance,'discount' => 0, 'refund' => 0],
                                                        ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0,'discount' => 0, 'refund' => $req->get('refund')],
                                                        ['payment_type' => 'kupon', 'transaction_amount' => $price_single, 'balance' => $log_coupon->quota_kupon - 1,'discount' => $price_single, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $disc,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                                                
                                                $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                                $log_coupon->save();
                                                $deposit->save();
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
            
                                                ReportDeposit::create([
                                                    'payment_type' => 'deposit',
                                                    'report_balance' => $disc,
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'fund' => $deposit_before,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
        
                                                ReportCoupon::create([
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'report_quota_kupon' => $log_coupon->quota_kupon,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            } else if($req->get('type_multiple')[2] == 'limit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if ($req->get('bayar_input') < $minus_deposit) {
                                            $this->setResponse('INVALID', "Nominal sisa bayar $minus_deposit");
                                            return response()->json($this->getResponse());
                                        } else {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([
                                                        ['payment_type' => 'deposit', 'transaction_amount' => $deposit_before, 'balance' => $deposit->balance,'discount' => 0, 'refund' => 0],
                                                        ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0,'discount' => 0, 'refund' => $req->get('refund')],
                                                        ['payment_type' => 'limit', 'transaction_amount' => $price_single, 'balance' => $log_limit->quota - 1,'discount' => $price_single, 'refund' => 0]
                                                    ]),
                                                    'payment_status' => 'paid',
                                                    'total' => $disc,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                                                
                                                $log_limit->quota = $log_limit->quota - 1;
                                                $log_limit->save();
                                                $deposit->save();
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
            
                                                ReportDeposit::create([
                                                    'payment_type' => 'deposit',
                                                    'report_balance' => $disc,
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'fund' => $deposit_before,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
        
                                                ReportLimit::create([
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'report_quota' => $log_limit->quota,
                                                    'status' => 'Berkurang',
                                                    'created_at' => Carbon::now(),
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if(count($req->get('type_multiple')) == 1) {
                            if ($req->get('type_multiple')[0] == 'deposit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    try{
                                        $deposit->balance = $deposit->balance - $totalPrice;
                                        $deposit->save();
                                        
                                        LogTransaction::create([
                                            'order_number' => $req->get('order_number'),
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'cart' => serialize($cart_data),
                                            'payment_type' => serialize([[
                                                'payment_type' => 'deposit',
                                                'transaction_amount' => $totalPrice,
                                                'balance' => $deposit->balance,
                                                'discount' => 0,
                                                'refund' => 0
                                            ]]),
                                            'payment_status' => 'paid',
                                            'total' => $totalPrice,
                                            'total_gross' => $totalPrice,
                                            'jml_default' => array_sum(array_column($priceDefault,'price')),
                                            'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                            'jml_other' => array_sum(array_column($priceOthers,'price')),
                                        ]);
            
                                        LogAdmin::create([
                                            'user_id' => Auth::id(),
                                            'type' => 'CREATE',
                                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                        ]);
            
                                        ReportDeposit::create([
                                            'payment_type' => 'deposit',
                                            'report_balance' => $totalPrice,
                                            'visitor_id' => $req->get('page'),
                                            'user_id' => Auth()->id(),
                                            'fund' => $deposit->balance,
                                            'status' => 'Berkurang',
                                            'created_at' => Carbon::now(),
                                        ]);
                                        \Cart::session($req->get('page'))->clear();
            
                                        if ($req->ajax()) {
                                            $this->setResponse('VALID', "Pembayaran berhasil");
                                            return response()->json($this->getResponse());
                                        }
                                    } catch (Throwable $e) {
                                        return response()->json($this->getResponse());
                                    }
                                }
                            } else if ($req->get('type_multiple')[0] == 'cash/transfer') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if (is_null($req->get('bayar_input'))) {
                                        $this->setResponse('INVALID', "Nominal wajib diisi");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if ($req->get('bayar_input') != $totalPrice) {
                                            if ($req->get('bayar_input') >= $totalPrice){
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([[
                                                            'payment_type' => 'cash/transfer', 
                                                            'transaction_amount' => $req->get('bayar_input'), 
                                                            'balance' => 0,
                                                            'discount' => 0,
                                                            'refund' => $req->get('refund')
                                                        ]]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
                    
                                                    \Cart::session($req->get('page'))->clear();
                    
                                                    if ($req->ajax()) {
                                                        return response()->json([
                                                            'status' => 'VALID',
                                                            'message' => 'Pembayaran berhasil',
                                                            'return' => $req->get('bayar_input')
                                                        ]);
                                                    }
                                                } catch (Throwable $e) {
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                $this->setResponse('INVALID', "Nominal yang harus dibayarkan $totalPrice");
                                                return response()->json($this->getResponse());
                                            }
                                        } else {
                                            try {
                                                LogTransaction::create([
                                                    'order_number' => $req->get('order_number'),
                                                    'visitor_id' => $req->get('page'),
                                                    'user_id' => Auth()->id(),
                                                    'cart' => serialize($cart_data),
                                                    'payment_type' => serialize([[
                                                        'payment_type' => 'cash/transfer', 
                                                        'transaction_amount' => $req->get('bayar_input'), 
                                                        'balance' => 0,
                                                        'discount' => 0,
                                                        'refund' => 0
                                                    ]]),
                                                    'payment_status' => 'paid',
                                                    'total' => $totalPrice,
                                                    'total_gross' => $totalPrice,
                                                    'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                    'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                    'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                ]);
                
                                                LogAdmin::create([
                                                    'user_id' => Auth::id(),
                                                    'type' => 'CREATE',
                                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                ]);
                
                                                \Cart::session($req->get('page'))->clear();
                
                                                if ($req->ajax()) {
                                                    return response()->json([
                                                        'status' => 'VALID',
                                                        'message' => 'Pembayaran berhasil',
                                                        'return' => $req->get('bayar_input')
                                                    ]);
                                                }
                                            } catch (\Throwable $th) {
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            } else if ($req->get('type_multiple')[0] == 'kupon') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if($item_default != 1){
                                        $this->setResponse('INVALID', "Gunakan split deposit atau cash/transfer");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try {
                                            $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                            $log_coupon->save();
            
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'kupon',
                                                    'transaction_amount' => $price_single,
                                                    'balance' => $log_coupon->quota_kupon,
                                                    'discount' => $price_single,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice - $price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
            
                                            ReportCoupon::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota_kupon' => $log_coupon->quota_kupon,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
                                            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (Throwable $e) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            } else if ($req->get('type_multiple')[0] == 'limit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if($item_default != 1){
                                        $this->setResponse('INVALID', "Gunakan split deposit atau cash/transfer");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try {
                                            $log_limit->quota = $log_limit->quota - 1;
                                            $log_limit->save();
            
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([[
                                                    'payment_type' => 'limit',
                                                    'transaction_amount' => $price_single,
                                                    'balance' => $log_limit->quota,
                                                    'discount' => $price_single,
                                                    'refund' => 0
                                                ]]),
                                                'payment_status' => 'paid',
                                                'total' => $totalPrice - $price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
            
                                            ReportLimit::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota' => $log_limit->quota,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
                                            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (Throwable $e) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        } else if (count($req->get('type_multiple')) == 2) {
                            if($req->get('type_multiple')[0] == 'deposit') {
                                if($req->get('type_multiple')[1] == 'cash/transfer') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if (is_null($req->get('bayar_input'))) {
                                            $this->setResponse('INVALID', "Nominal wajib diisi");
                                            return response()->json($this->getResponse());
                                        } else {
                                            if ($req->get('bayar_input') > ceil($totalPrice)) {
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'deposit', 'transaction_amount' => 0, 'balance' => $deposit->balance,'discount' => 0, 'refund' => 0],
                                                            ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0,'discount' => 0, 'refund' => $req->get('refund')]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
    
                                                    ReportDeposit::create([
                                                        'payment_type' => 'deposit',
                                                        'report_balance' => 0,
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'fund' => $deposit->balance,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
    
                                                    \Cart::session($req->get('page'))->clear();
                    
                                                    if ($req->ajax()) {
                                                        return response()->json([
                                                            'status' => 'VALID',
                                                            'message' => 'Pembayaran berhasil',
                                                            'return' => $req->get('bayar_input')
                                                        ]);
                                                    }
    
                                                } catch (\Throwable $th) {
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                $minus_deposit = $totalPrice - $req->get('bayar_input');
                                                $deposit->balance = $deposit->balance - $minus_deposit;
                                                $deposit->save();
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'deposit', 'transaction_amount' => $minus_deposit, 'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                            ['payment_type' => 'cash/transfer', 'transaction_amount' => $req->get('bayar_input'), 'balance' => 0, 'discount' => 0, 'refund' => 0]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $totalPrice,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
    
                                                    ReportDeposit::create([
                                                        'payment_type' => 'deposit',
                                                        'report_balance' => $minus_deposit,
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'fund' => $deposit->balance,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
    
                                                    \Cart::session($req->get('page'))->clear();
                    
                                                    if ($req->ajax()) {
                                                        return response()->json([
                                                            'status' => 'VALID',
                                                            'message' => 'Pembayaran berhasil',
                                                            'return' => $req->get('bayar_input')
                                                        ]);
                                                    }
    
                                                } catch (\Throwable $th) {
                                                    return response()->json($this->getResponse());
                                                }
                                            }
                                        }
                                    }
                                } else if ($req->get('type_multiple')[1] == 'kupon') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try {
                                            $deposit_before = $deposit->balance;
                                            $minus_price_single = $totalPrice - $price_single;
    
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([
                                                    ['payment_type' => 'deposit','transaction_amount' => $minus_price_single,'balance' => $deposit->balance - $minus_price_single, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                                ]),
                                                'payment_status' => 'paid',
                                                'total' => $minus_price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
            
                                            ReportDeposit::create([
                                                'payment_type' => 'deposit',
                                                'report_balance' => $minus_price_single,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'fund' => $deposit->balance - $minus_price_single,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
    
                                            $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                            $deposit->balance = $deposit->balance - $minus_price_single;
                                            $log_coupon->save();
                                            $deposit->save();
            
                                            ReportCoupon::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota_kupon' => $log_coupon->quota_kupon,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                } else if ($req->get('type_multiple')[1] == 'limit') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        try {
                                            $deposit_before = $deposit->balance;
                                            $minus_price_single = $totalPrice - $price_single;
    
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([
                                                    ['payment_type' => 'deposit','transaction_amount' => $minus_price_single,'balance' => $deposit->balance - $minus_price_single, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                                ]),
                                                'payment_status' => 'paid',
                                                'total' => $minus_price_single,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
            
                                            ReportDeposit::create([
                                                'payment_type' => 'deposit',
                                                'report_balance' => $minus_price_single,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'fund' => $deposit->balance - $minus_price_single,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
    
                                            $log_limit->quota = $log_limit->quota - 1;
                                            $deposit->balance = $deposit->balance - $minus_price_single;
                                            $log_limit->save();
                                            $deposit->save();
            
                                            ReportLimit::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota' => $log_limit->quota,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            } else if($req->get('type_multiple')[0] == 'cash/transfer') {
                                if($req->get('type_multiple')[1] == 'kupon') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if (is_null($req->get('bayar_input'))) {
                                            $this->setResponse('INVALID', "Nominal wajib diisi");
                                            return response()->json($this->getResponse());
                                        } else {
                                            $remaining_balance = $totalPrice - $price_single;
                                            if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                            ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $remaining_balance,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                                    $log_coupon->save();
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
                    
                                                    ReportCoupon::create([
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'report_quota_kupon' => $log_coupon->quota_kupon,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
                    
                                                    \Cart::session($req->get('page'))->clear();
                        
                                                    if ($req->ajax()) {
                                                        $this->setResponse('VALID', "Pembayaran berhasil");
                                                        return response()->json($this->getResponse());
                                                    }
                                                } catch (\Throwable $th) {
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                if (empty($req->get('bayar_input'))) {
                                                    $this->setResponse('INVALID', "Gunakan limit atau kupon");
                                                    return response()->json($this->getResponse());
                                                } else {
                                                    $this->setResponse('INVALID', "Nominal yang harus dibayarkan $remaining_balance");
                                                    return response()->json($this->getResponse());
                                                }
                                            }
                                        }
                                    }
                                } else if($req->get('type_multiple')[1] == 'limit') {
                                    if($visitor->expired_date <= Carbon::now()) {
                                        $this->setResponse('INVALID', "Masa berlaku member habis");
                                        return response()->json($this->getResponse());
                                    } else if($visitor->status == 'inactive') {
                                        $this->setResponse('INVALID', "Member tidak aktif");
                                        return response()->json($this->getResponse());
                                    } else {
                                        if (is_null($req->get('bayar_input'))) {
                                            $this->setResponse('INVALID', "Nominal wajib diisi");
                                            return response()->json($this->getResponse());
                                        } else {
                                            $remaining_balance = $totalPrice - $price_single;
                                            if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                                try {
                                                    LogTransaction::create([
                                                        'order_number' => $req->get('order_number'),
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'cart' => serialize($cart_data),
                                                        'payment_type' => serialize([
                                                            ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                            ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                                        ]),
                                                        'payment_status' => 'paid',
                                                        'total' => $remaining_balance,
                                                        'total_gross' => $totalPrice,
                                                        'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                        'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                        'jml_other' => array_sum(array_column($priceOthers,'price')),
                                                    ]);
                    
                                                    $log_limit->quota = $log_limit->quota - 1;
                                                    $log_limit->save();
                    
                                                    LogAdmin::create([
                                                        'user_id' => Auth::id(),
                                                        'type' => 'CREATE',
                                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                                    ]);
                    
                                                    ReportLimit::create([
                                                        'visitor_id' => $req->get('page'),
                                                        'user_id' => Auth()->id(),
                                                        'report_quota' => $log_limit->quota,
                                                        'status' => 'Berkurang',
                                                        'created_at' => Carbon::now(),
                                                    ]);
                    
                                                    \Cart::session($req->get('page'))->clear();
                        
                                                    if ($req->ajax()) {
                                                        $this->setResponse('VALID', "Pembayaran berhasil");
                                                        return response()->json($this->getResponse());
                                                    }
                                                } catch (\Throwable $th) {
                                                    return response()->json($this->getResponse());
                                                }
                                            } else {
                                                $this->setResponse('INVALID', "Nominal yang harus dibayarkan $remaining_balance");
                                                return response()->json($this->getResponse());
                                            }
                                        }
                                    }
                                }
                            }
                        } else if (count($req->get('type_multiple')) == 3) {
                            $remaining_balance = $totalPrice - $price_single;
                            if($req->get('type_multiple')[2] == 'kupon') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                        try {
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([
                                                    ['payment_type' => 'deposit','transaction_amount' => 0,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                    ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                                ]),
                                                'payment_status' => 'paid',
                                                'total' => $remaining_balance,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                            $log_coupon->save();
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
    
                                            ReportDeposit::create([
                                                'payment_type' => 'deposit',
                                                'report_balance' => 0,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'fund' => $deposit->balance,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            ReportCoupon::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota_kupon' => $log_coupon->quota_kupon,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    } else {
                                        $minus_deposit = $remaining_balance - $req->get('bayar_input');
                                        $deposit->balance = $deposit->balance - $minus_deposit;
                                        try {
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([
                                                    ['payment_type' => 'deposit','transaction_amount' => $minus_deposit,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'kupon','transaction_amount' => $price_single,'balance' => $log_coupon->quota_kupon - 1, 'discount' => $price_single, 'refund' => 0]
                                                ]),
                                                'payment_status' => 'paid',
                                                'total' => $remaining_balance,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
                                            
                                            $log_coupon->quota_kupon = $log_coupon->quota_kupon - 1;
                                            $log_coupon->save();
                                            $deposit->save();
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
    
                                            ReportDeposit::create([
                                                'payment_type' => 'deposit',
                                                'report_balance' => $minus_deposit,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'fund' => $deposit->balance,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            ReportCoupon::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota_kupon' => $log_coupon->quota_kupon,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            } else if ($req->get('type_multiple')[2] == 'limit') {
                                if($visitor->expired_date <= Carbon::now()) {
                                    $this->setResponse('INVALID', "Masa berlaku member habis");
                                    return response()->json($this->getResponse());
                                } else if($visitor->status == 'inactive') {
                                    $this->setResponse('INVALID', "Member tidak aktif");
                                    return response()->json($this->getResponse());
                                } else {
                                    if ($req->get('bayar_input') > ceil($remaining_balance)) {
                                        try {
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([
                                                    ['payment_type' => 'deposit','transaction_amount' => 0,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => $req->get('refund')],
                                                    ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                                ]),
                                                'payment_status' => 'paid',
                                                'total' => $remaining_balance,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
            
                                            $log_limit->quota = $log_limit->quota - 1;
                                            $log_limit->save();
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
    
                                            ReportDeposit::create([
                                                'payment_type' => 'deposit',
                                                'report_balance' => 0,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'fund' => $deposit->balance,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            ReportLimit::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota' => $log_limit->quota,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    } else {
                                        $minus_deposit = $remaining_balance - $req->get('bayar_input');
                                        $deposit->balance = $deposit->balance - $minus_deposit;
                                        try {
                                            LogTransaction::create([
                                                'order_number' => $req->get('order_number'),
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'cart' => serialize($cart_data),
                                                'payment_type' => serialize([
                                                    ['payment_type' => 'deposit','transaction_amount' => $minus_deposit,'balance' => $deposit->balance, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'cash/transfer','transaction_amount' => $req->get('bayar_input'),'balance' => 0, 'discount' => 0, 'refund' => 0],
                                                    ['payment_type' => 'limit','transaction_amount' => $price_single,'balance' => $log_limit->quota - 1, 'discount' => $price_single, 'refund' => 0]
                                                ]),
                                                'payment_status' => 'paid',
                                                'total' => $remaining_balance,
                                                'total_gross' => $totalPrice,
                                                'jml_default' => array_sum(array_column($priceDefault,'price')),
                                                'jml_additional' => array_sum(array_column($priceAdditional,'price')),
                                                'jml_other' => array_sum(array_column($priceOthers,'price')),
                                            ]);
                                            
                                            $log_limit->quota = $log_limit->quota - 1;
                                            $log_limit->save();
                                            $deposit->save();
            
                                            LogAdmin::create([
                                                'user_id' => Auth::id(),
                                                'type' => 'CREATE',
                                                'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                            ]);
    
                                            ReportDeposit::create([
                                                'payment_type' => 'deposit',
                                                'report_balance' => $minus_deposit,
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'fund' => $deposit->balance,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            ReportLimit::create([
                                                'visitor_id' => $req->get('page'),
                                                'user_id' => Auth()->id(),
                                                'report_quota' => $log_limit->quota,
                                                'status' => 'Berkurang',
                                                'created_at' => Carbon::now(),
                                            ]);
            
                                            \Cart::session($req->get('page'))->clear();
                
                                            if ($req->ajax()) {
                                                $this->setResponse('VALID', "Pembayaran berhasil");
                                                return response()->json($this->getResponse());
                                            }
                                        } catch (\Throwable $th) {
                                            return response()->json($this->getResponse());
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function print_invoice($id) {
        try{
            $data['visitor'] = Visitor::find($id);
            $data['log_transaction'] = LogTransaction::where('visitor_id', $id)->latest()->first();
            $data['user'] = User::find($data['log_transaction']->user_id);
            $data['cart'] = unserialize($data['log_transaction']->cart);
            $data['payment_type'] = unserialize($data['log_transaction']->payment_type);
            $data['deposit'] = Deposit::where('visitor_id', $id)->first();
            $data['total'] = 0;
            $data['qty'] = 0;
            $data['discount'] = 0;
            $data['refund'] = 0;
            $data['transaction_amount'] = 0;
            foreach ($data['cart'] as $get) {
                $data['qty'] += $get['qty'];
                $data['total'] += $get['price'];
            }
            foreach ($data['payment_type'] as $get) {
                $data['discount'] += $get['discount'];
                $data['refund'] += $get['refund'];
                $data['transaction_amount'] += $get['transaction_amount'];
            }
            $data['counted'] = ucwords(counted($data['log_transaction']->total) . ' Rupiah');
            return view('membership.print-invoice', $data);
        } catch (Throwable $e) {
            return redirect()->route('scan-tamu');
        }
    }

    private function setResponse($status = "INVALID", $message = "Ada sesuatu yang salah!", $data = []) {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    private function getResponse() {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data ? $this->data : null
        ];
    }
}