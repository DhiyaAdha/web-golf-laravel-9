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
use App\Models\ReportLimit;
use Darryldecode\Cart\Cart;
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

class OrderRegulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $status;
    private $message;
    private $data;

    public function __construct()
    {
        $this->status = "INVALID";
        $this->message = "Ada sesuatu yang salah!";
        $this->data = [];
    }

    public function index(Request $request)
    {
        $products = Package::orderBy('id', 'desc')->where('status', '0')->get();
        if ($request->ajax()) {
            return datatables()
                ->of($products)->editColumn('price_weekdays', function ($data) {
                    return formatrupiah($data->price_weekdays);
                })->editColumn('price_weekend', function ($data) {
                    return formatrupiah($data->price_weekend);
                })
                ->addIndexColumn()
                ->make(true);
        }
        $today = Carbon::now()->isoFormat('dddd');
        $date_now = Carbon::now()->translatedFormat('d F Y');
        $default = Package::where('category', 'default')->where('status', 0)->get();
        $additional = Package::where('category', 'additional')->where('status', 0)->get();
        $others = Package::where('category', 'others')->where('status', 0)->get();
        $items = \Cart::session(auth()->id())->getContent();
        // dd($items);
        if (\Cart::isEmpty()) {
            $cart_data = [];
        } else {
            foreach ($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                    'created_at' => $row->attributes['created_at'],
                    'category' => $row->category,
                ];
            }
            

            $cart_data = collect($cart)->sortBy('created_at');
        }

        $sub_total = \Cart::session(auth()->id())->getSubTotal();
        $total = \Cart::session(auth()->id())->getTotal();
        $counted = ucwords(counted($total) . ' Rupiah');
        $new_condition = \Cart::session(auth()->id())->getCondition('pajak');

        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total
        ];

        return view('reguler.keranjang-reguler', compact(
            'date_now',
            'today',
            'default',
            'additional',
            'others',
            'data_total',
            'cart_data'
        ));
    }

    public function add(Request $request)
    {
        $package = Package::find($request->get('id'));
        $cart = \Cart::session(auth()->id())->getContent();
        $cek_itemId = $cart->whereIn('id', $request->get('id'));
        $today = Carbon::now()->isoFormat('dddd');
        $price = $today === 'Sabtu' || $today === 'Minggu' ? $package->price_weekend : $package->price_weekdays;
        $get_total = \Cart::session(auth()->id())->getTotal();
        $counted = ucwords(counted($get_total) . ' Rupiah');
        if ($cek_itemId->isNotEmpty()) {
            if ($package->quantity == $cek_itemId[$request->get('id')]->quantity) {
                return redirect()->back()->with('error', 'jumlah item kurang');
            } else {
                // \Cart::session($request->get('page'))->update($request->get('id'), array(
                //     'quantity' => 1
                // ));
                if ($cek_itemId[$request->get('id')]->quantity >= 1) {
                    $this->setResponse('INVALID', "Sudah ditambahkan");
                    return response()->json($this->getResponse());
                }
                return response()->json([
                    'id' => $request->get('id'),
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $cart,
                    'qty' => $cek_itemId[$request->get('id')]->quantity,
                    'price' => $cek_itemId[$request->get('id')]->price
                ], 200);
            }
        } else {
            \Cart::session(auth()->id())->add(array(
                'id' => $request->get('id'),
                'name' => $package->name,
                'price' => $price,
                'quantity' => 1,
                'attributes' => array(
                    'created_at' => date('Y-m-d H:i:s')
                ),
            ));
            $id_package = [];
            foreach (\Cart::session(auth()->id())->getContent() as $sd) {
                $id_package[] = $sd['id'];
            }
            $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
            $package_additional = Package::whereIn('id', $id_package)->where('category', 'additional')->get();
            
            if (count($package_additional) == 0) {
                $cart = \Cart::session(auth()->id())->getContent();
                $cek_itemId = $cart->whereIn('id', $request->get('id'));
                if (\Cart::isEmpty()) {
                    $cart_data = [];
                } else {
                    foreach ($cart as $row) {
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
                // dd($cart_data);
                $get_total = \Cart::session(auth()->id())->getTotal();
                $counted = ucwords(counted($get_total) . ' Rupiah');
                return response()->json([
                    'id' => $request->get('id'),
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $cart_data,
                    'qty' => $cek_itemId[$request->get('id')]->quantity,
                    'name' => $cek_itemId[$request->get('id')]->name,
                    'price' => $cek_itemId[$request->get('id')]->price
                ], 200);
            } else if(count($package_default) == 0) {
                \Cart::session(auth()->id())->clear();
                $this->setResponse('INVALID', "Setidaknya pilih satu jenis permainan");
                return response()->json($this->getResponse());
            } else {
                $cart = \Cart::session(auth()->id())->getContent();
                $cek_itemId = $cart->whereIn('id', $request->get('id'));
                if (\Cart::isEmpty()) {
                    $cart_data = [];
                } else {
                    foreach ($cart as $row) {
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
                // dd($cart_data);
                $get_total = \Cart::session(auth()->id())->getTotal();
                $counted = ucwords(counted($get_total) . ' Rupiah');
                return response()->json([
                    'id' => $request->get('id'),
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $cart_data,
                    'qty' => $cek_itemId[$request->get('id')]->quantity,
                    'name' => $cek_itemId[$request->get('id')]->name,
                    'price' => $cek_itemId[$request->get('id')]->price
                ], 200);
            }
            
        }
        return back();
    }

    public function update_qty(Request $request)
    {
        $package = Package::find($request->get('id'));
        $cart = \Cart::session(auth()->id())->getContent();
        $cek_itemId = $cart->whereIn('id', $request->get('id'));
        if ($request->get('type') == 'plus') {
            if ($package->quantity == $cek_itemId[$request->get('id')]->quantity) {
                return redirect()->back()->with('error', 'jumlah item kurang');
            } else {
                \Cart::session(auth()->id())->update($request->get('id'), array(
                    'quantity' => array(
                        'relative' => true,
                        'value' => 1
                    )
                ));
                $items = \Cart::session(auth()->id())->getContent();
                $get_total = \Cart::session(auth()->id())->getTotal();
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
        } else {
            if ($cek_itemId[$request->get('id')]->quantity == 1) {
                \Cart::session(auth()->id())->remove($request->get('id'));
            } else {
                \Cart::session(auth()->id())->update($request->get('id'), array(
                    'quantity' => array(
                        'relative' => true,
                        'value' => -1
                    )
                ));
            }
            $items = \Cart::session(auth()->id())->getContent();
            $get_total = \Cart::session(auth()->id())->getTotal();
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
        }
    }

    public function remove(Request $request)
    {
        $items = \Cart::session(auth()->id())->getContent();

        // $counts = $items->where('is_default', 'default')->count();
        // $counts = $items->where('is_default', 'default')->count();
        // return $counts;
        
        \Cart::session(auth()->id())->remove($request->get('id'));
        $get_total = \Cart::session(auth()->id())->getTotal();
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
        ], 200);
    }

    public function clear_cart()
    {
        \Cart::session(auth()->id())->clear();
        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        try {
            $items = \Cart::session($request->get('id'))->getContent();
            $totalPrice = \Cart::session($request->get('id'))->getTotal();
            $today = Carbon::now()->isoFormat('dddd');
            if (\Cart::isEmpty()) {
                $cart_data = [];
            } else {
                foreach ($items as $row) {
                    $id_package[] = $row->id;
                    $item_default = 0;
                    $cek_itemId = $items->whereIn('id', $id_package);
                    $cart[] = [
                        'rowId' => $row->id,
                        'name' => $row->name,
                        'qty' => $row->quantity,
                        'pricesingle' => $row->price,
                        'price' => $row->getPriceSum(),
                        'created_at' => $row->attributes['created_at'],
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
            return view("reguler.checkout_reguler", compact('log_limit', 'price_single', 'item_default', 'package_default', 'package_additional', 'package_others', 'deposit', 'totalPrice', 'order_number', 'orders'))->render();
        } catch (\Throwable $th) {
            return redirect()->route('scan-tamu');
        }
    }

    public function select(Request $request)
    {
        $type = $request->get('type');
        $items = \Cart::session($request->get('param'))->getContent();
        $totalPrice = \Cart::session($request->get('param'))->getTotal();
        $deposit = Deposit::where('visitor_id', $request->get('param'))->first();
        $log_limit = LogLimit::where('visitor_id', $request->get('param'))->first();        
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
                    return response(['limit' => $log_limit->quota, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'price' => $resultPrice, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Saldo telah dipilih']);
                } catch (\Throwable $th) {
                    return response()->json($this->getResponse());
                }
            } else {
                if ($resultPrice > 0) {
                    try {
                        return response(['limit' => $log_limit->quota, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'price' => $resultPrice, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Saldo telah dipilih']);
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
                return response(['limit' => $log_limit->quota, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'price' => $deposit->balance, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Cash/Transfer telah dipilih']);
            } catch (\Throwable $th) {
                return response()->json($this->getResponse());
            }
        } else if ($type == 2) {
            $resultKupon =  $log_limit->quota_kupon - 1;
            if ($log_limit->quota_kupon == 0) {
                return response(['price' => $deposit->balance, 'limit' => $log_limit->quota, 'kupon' => 0, 'status' => 'INVALID', 'message' => 'Kupon tidak terpenuhi']);
            } else {
                return response(['price' => $deposit->balance, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'limit' => $log_limit->quota, 'kupon' => $resultKupon, 'status' => 'VALID', 'message' => 'Limit telah dipilih']);
            }
        } else if ($type == 1) {
            $resultLimit =  $log_limit->quota - 1;
            if ($log_limit->quota == 0) {
                return response(['price' => $deposit->balance, 'limit' => 0, 'kupon' => $log_limit->quota_kupon, 'status' => 'INVALID', 'message' => 'Limit tidak terpenuhi']);
            } else {
                return response(['price' => $deposit->balance, 'total_price' => $totalPrice, 'price_default' => $price_default, 'orders' => $orders, 'limit' => $resultLimit, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Limit telah dipilih']);
            }
        }
    }

    public function print_invoice($id) {
        try{
            $visitor = Visitor::find($id);
            $log_transaction = LogTransaction::where('visitor_id', $id)->latest()->first();
            $user = User::find($log_transaction->user_id);
            $cart = unserialize($log_transaction->cart);
            $payment_type = unserialize($log_transaction->payment_type);
            $deposit = Deposit::where('visitor_id', $id)->first();
            $total = 0;
            $qty = 0;
            $discount = 0;
            foreach ($cart as $get) {
                $qty += $get['qty'];
                $total += $get['price'];
            }
            foreach ($payment_type as $get) {
                $discount += $get['discount'];
            }
            $counted = ucwords(counted($log_transaction->total) . ' Rupiah');
            return view('print-invoice', compact(
                'visitor',
                'log_transaction',
                'payment_type',
                'cart',
                'deposit',
                'discount', 
                'counted',
                'total',
                'qty',
                'user'
            ));
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