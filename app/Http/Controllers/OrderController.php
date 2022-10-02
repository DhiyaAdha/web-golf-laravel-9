<?php

namespace App\Http\Controllers;

use DB;
use Throwable;
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

class OrderController extends Controller
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
        $products = Package::orderBy('id', 'desc')->get();
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
        if (!$request->hasValidSignature()) {
            return \redirect('/analisis-tamu');
        }
        $today = Carbon::now()->isoFormat('dddd');
        $date_now = Carbon::now()->translatedFormat('d F Y');
        $visitor = request()->segment(2);
        $get_visitor = Visitor::find(request()->segment(2));
        $url_checkout = URL::temporarySignedRoute('checkout', now()->addMinutes(7), ['id' => $visitor]);
        $default = Package::where('category', 'default')->where('status', 0)->get();
        $additional = Package::where('category', 'additional')->where('status', 0)->get();
        if (request()->tax) {
            $tax = "+10%";
        } else {
            $tax = "0%";
        }

        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $tax,
            'order' => 1
        ));
        \Cart::session(request()->segment(2))->condition($condition);
        $items = \Cart::session(request()->segment(2))->getContent();
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
                ];
            }
            $cart_data = collect($cart)->sortBy('created_at');
        }

        $sub_total = \Cart::session(request()->segment(2))->getSubTotal();
        $total = \Cart::session(request()->segment(2))->getTotal();
        $counted = ucwords(counted($total) . ' Rupiah');
        $new_condition = \Cart::session(request()->segment(2))->getCondition('pajak');
        $pajak = $new_condition->getCalculatedValue($sub_total);

        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total,
            'tax' => $pajak
        ];

        return view('keranjang', compact(
            'url_checkout',
            'counted',
            'date_now',
            'today',
            'default',
            'additional',
            'products',
            'cart_data',
            'data_total',
            'get_visitor'
        ));
    }

    public function add(Request $request)
    {
        $id = explode("/", parse_url($request->get('url'), PHP_URL_PATH));
        $package = Package::find($id[3]);
        $cart = \Cart::session($request->get('page'))->getContent();
        $cek_itemId = $cart->whereIn('id', $id[3]);
        $today = Carbon::now()->isoFormat('dddd');
        $price = $today === 'Sabtu' || 'Minggu' ? $package->price_weekend : $package->price_weekdays;
        $get_total = \Cart::session($request->get('page'))->getTotal();
        $counted = ucwords(counted($get_total) . ' Rupiah');
        if ($cek_itemId->isNotEmpty()) {
            if ($package->quantity == $cek_itemId[$id[3]]->quantity) {
                return redirect()->back()->with('error', 'jumlah item kurang');
            } else {
                // \Cart::session($request->get('page'))->update($id[3], array(
                //     'quantity' => 1
                // ));
                if ($cek_itemId[$id[3]]->quantity >= 1) {
                    $this->setResponse('INVALID', "Limit tidak terpenuhi");
                    return response()->json($this->getResponse());
                }
                return response()->json([
                    'id' => $id[3],
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $cart,
                    'qty' => $cek_itemId[$id[3]]->quantity,
                    'price' => $cek_itemId[$id[3]]->price
                ], 200);
            }
        } else {
            \Cart::session($request->get('page'))->add(array(
                'id' => $id[3],
                'name' => $package->name,
                'price' => $price,
                'quantity' => 1,
                'attributes' => array(
                    'created_at' => date('Y-m-d H:i:s')
                )
            ));
            $cart = \Cart::session($request->get('page'))->getContent();
            $cek_itemId = $cart->whereIn('id', $id[3]);
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
                    ];
                }
                $cart_data = collect($cart)->sortBy('created_at');
            }
            $get_total = \Cart::session($request->get('page'))->getTotal();
            $counted = ucwords(counted($get_total) . ' Rupiah');
            return response()->json([
                'id' => $id[3],
                'total' => $get_total,
                'counted' => $counted,
                'cart' => $cart_data,
                'qty' => $cek_itemId[$id[3]]->quantity,
                'name' => $cek_itemId[$id[3]]->name,
                'price' => $cek_itemId[$id[3]]->price
            ], 200);
        }
    }

    public function update_qty(Request $request)
    {
        $package = Package::find($request->get('id'));
        $cart = \Cart::session($request->get('page'))->getContent();
        $cek_itemId = $cart->whereIn('id', $request->get('id'));
        if ($request->get('type') == 'plus') {
            if ($package->quantity == $cek_itemId[$request->get('id')]->quantity) {
                return redirect()->back()->with('error', 'jumlah item kurang');
            } else {
                \Cart::session($request->get('page'))->update($request->get('id'), array(
                    'quantity' => array(
                        'relative' => true,
                        'value' => 1
                    )
                ));
                $items = \Cart::session($request->get('page'))->getContent();
                $get_total = \Cart::session($request->get('page'))->getTotal();
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
                \Cart::session($request->get('page'))->remove($request->get('id'));
            } else {
                \Cart::session($request->get('page'))->update($request->get('id'), array(
                    'quantity' => array(
                        'relative' => true,
                        'value' => -1
                    )
                ));
            }
            $items = \Cart::session($request->get('page'))->getContent();
            $get_total = \Cart::session($request->get('page'))->getTotal();
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
        $id = explode("/", parse_url($request->get('url'), PHP_URL_PATH));
        \Cart::session($request->get('page'))->remove($id[3]);
        $items = \Cart::session($request->get('page'))->getContent();
        $get_total = \Cart::session($request->get('page'))->getTotal();
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

    public function clear_cart(Request $request)
    {
        \Cart::session($request->get('page'))->clear();
        return redirect()->back();
    }

    public function checkout(Request $request, $id)
    {
        $visitor = Visitor::find(request()->segment(2));
        $items = \Cart::session(request()->segment(2))->getContent();
        $totalPrice = \Cart::session(request()->segment(2))->getTotal();
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
                ];
            }
            $orders = collect($cart)->sortBy('created_at');
        }
        $order_number = 'INV/' . Carbon::now()->format('Ymd') . '/' . $visitor->tipe_member . '/' . Carbon::now()->format('his');
        $deposit = Deposit::where('visitor_id', request()->segment(2))->first();
        $log_limit = LogLimit::where('visitor_id', request()->segment(2))->first();
        if ($request->ajax()) {
            return response()->json(['order_number' => $order_number]);
        }
        return view("checkout", compact('log_limit', 'visitor', 'deposit', 'totalPrice', 'order_number', 'orders'))->render();
    }

    public function select(Request $request)
    {
        $type = $request->get('type');
        $totalPrice = \Cart::session($request->get('param'))->getTotal();
        $deposit = Deposit::where('visitor_id', $request->get('param'))->first();
        $log_limit = LogLimit::where('visitor_id', $request->get('param'))->first();
        if ($type == 4) {
            $resultPrice =  $deposit->balance - $totalPrice;
            if ($resultPrice > 0) {
                try {
                    return response(['limit' => $log_limit->quota, 'price' => $resultPrice, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Saldo telah dipilih']);
                } catch (\Throwable $th) {
                    return response()->json($this->getResponse());
                }
            } else {
                $this->setResponse('INVALID', "Saldo tidak terpenuhi");
                return response()->json($this->getResponse());
            }
        } else if ($type == 3) {
            try {
                return response(['limit' => $log_limit->quota, 'price' => $deposit->balance, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Cash/Transfer telah dipilih']);
            } catch (\Throwable $th) {
                return response()->json($this->getResponse());
            }
        } else if ($type == 2) {
            $resultKupon =  $log_limit->quota_kupon - 1;
            if ($log_limit->quota_kupon == 0) {
                return response(['price' => $deposit->balance, 'limit' => $log_limit->quota, 'kupon' => 0, 'status' => 'INVALID', 'message' => 'Kupon tidak terpenuhi']);
            } else {
                return response(['price' => $deposit->balance, 'limit' => $log_limit->quota, 'kupon' => $resultKupon, 'status' => 'VALID', 'message' => 'Limit telah dipilih']);
            }
        } else if ($type == 1) {
            $resultLimit =  $log_limit->quota - 1;
            if ($log_limit->quota == 0) {
                return response(['price' => $deposit->balance, 'limit' => 0, 'kupon' => $log_limit->quota_kupon, 'status' => 'INVALID', 'message' => 'Limit tidak terpenuhi']);
            } else {
                return response(['price' => $deposit->balance, 'limit' => $resultLimit, 'kupon' => $log_limit->quota_kupon, 'status' => 'VALID', 'message' => 'Limit telah dipilih']);
            }
        }
    }

    public function pay(Request $req)
    {
        $visitor = Visitor::find($req->get('page'));
        $items = \Cart::session($req->get('page'))->getContent();
        $deposit = Deposit::where('visitor_id', $req->get('page'))->first();
        $log_limit = LogLimit::where('visitor_id', $req->get('page'))->first();
        $totalPrice = \Cart::session($req->get('page'))->getTotal();
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
                ];
            }
            $cart_data = collect($cart)->sortBy('created_at');
        }
        if ($req->get('type') == 'single') {
            if ($req->get('type_single') == null) {
                $this->setResponse('INVALID', "Silahkan pilih jenis single pembayaran");
                return response()->json($this->getResponse());
            } else {
                if ($req->get('type_single') == 4) {
                    if ($deposit->balance < $totalPrice) {
                        $this->setResponse('INVALID', "Saldo tidak terpenuhi");
                        return response()->json($this->getResponse());
                    } else {
                        $id_package = [];
                        foreach ($items as $sd) {
                            $id_package[] = $sd['id'];
                        }
                        $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
                        if (count($package_default) == 0) {
                            $this->setResponse('INVALID', "Setidaknya pilih satu jenis permainan default");
                            return response()->json($this->getResponse());
                        } else {
                            try {
                                $deposit->balance = $deposit->balance - $totalPrice;
                                $report_deposit = ReportDeposit::where('visitor_id', $req->get('page'))->first();
                                $report_deposit->report_balance = $report_deposit->report_balance - $totalPrice;
                                $deposit->save();
                                $report_deposit->save();
                                LogTransaction::create([
                                    'order_number' => $req->get('order_number'),
                                    'visitor_id' => $req->get('page'),
                                    'user_id' => Auth()->id(),
                                    'cart' => serialize($cart_data),
                                    'payment_type' => serialize([['payment_type' => 'deposit', 'total' => $totalPrice, 'balance' => $deposit->balance]]),
                                    'payment_status' => 'paid',
                                    'total' => $totalPrice
                                ]);

                                LogAdmin::create([
                                    'user_id' => Auth::id(),
                                    'type' => 'CREATE',
                                    'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                ]);

                                ReportDeposit::create([
                                    'payment_type' => 'Deposit',
                                    'report_balance' => $deposit->balance,
                                    'visitor_id' => $req->get('page'),
                                    'user_id' => Auth()->id(),
                                    'activities' => '<b>Saldo Berkurang !</b> Anda telah melakukan pembayaran menggunakan<b> deposit</b>',
                                    'created_at' => Carbon::now(),
                                ]);

                                \Cart::session($req->get('page'))->clear();

                                $data['qty'] = $row->quantity;
                                $total_qty = 0;
                                foreach ($cart_data as $get) {
                                    $total_qty += $get['qty'];
                                }
                                $log_transaction = LogTransaction::where('visitor_id', $req->get('page'))->latest()->first();
                                $payment_type = unserialize($log_transaction->payment_type);

                                $data = [
                                    'name' => $visitor->name,
                                    'email' => $visitor->email,
                                    'address' => $visitor->address,
                                    'phone' => $visitor->phone,
                                    'type_member' => $visitor->tipe_member,
                                    'sisasaldo' => $report_deposit->report_balance,
                                    'order_number' => $req->get('order_number'),
                                    'payment_type' => $payment_type,
                                    'date' => $row->attributes['created_at'],
                                    'pricesingle' => $row->price,
                                    'price' => $row->getPriceSum(),
                                    'total' => $totalPrice,
                                    'qty' => $row->quantity,
                                    'total_qty' => $total_qty,
                                    'cart' => $cart_data,
                                ];
                                // dd($data);
                                dispatch(new SendMailPaymentsuccess4Job($data));

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
                    if (is_null($req->get('bayar_input'))) {
                        $this->setResponse('INVALID', "Nominal wajib diisi");
                        return response()->json($this->getResponse());
                    } else {
                        if ($req->get('bayar_input') < $totalPrice) {
                            $this->setResponse('INVALID', "Nominal tidak terpenuhi");
                            return response()->json($this->getResponse());
                        } else {
                            $id_package = [];
                            foreach ($items as $sd) {
                                $id_package[] = $sd['id'];
                            }
                            $package_default = Package::whereIn('id', $id_package)->where('category', 'default')->get();
                            if (count($package_default) == 0) {
                                $this->setResponse('INVALID', "Setidaknya pilih satu jenis permainan default");
                                return response()->json($this->getResponse());
                            } else {
                                try {
                                    LogTransaction::create([
                                        'order_number' => $req->get('order_number'),
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'cart' => serialize($cart_data),
                                        'payment_type' => serialize([['payment_type' => 'cash/transfer', 'total' => $totalPrice, 'balance' => $totalPrice]]),
                                        'payment_status' => 'paid',
                                        'total' => $totalPrice
                                    ]);

                                    LogAdmin::create([
                                        'user_id' => Auth::id(),
                                        'type' => 'CREATE',
                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                    ]);

                                    \Cart::session($req->get('page'))->clear();

                                    $data['qty'] = $row->quantity;
                                    $total_qty = 0;
                                    foreach ($cart_data as $get) {
                                        $total_qty += $get['qty'];
                                    }
                                    $log_transaction = LogTransaction::where('visitor_id', $req->get('page'))->latest()->first();
                                    $payment_type = unserialize($log_transaction->payment_type);

                                    $data = [
                                        'name' => $visitor->name,
                                        'email' => $visitor->email,
                                        'address' => $visitor->address,
                                        'phone' => $visitor->phone,
                                        'type_member' => $visitor->tipe_member,
                                        'order_number' => $req->get('order_number'),
                                        'payment_type' => $payment_type,
                                        'date' => $row->attributes['created_at'],
                                        'pricesingle' => $row->price,
                                        'price' => $row->getPriceSum(),
                                        'total' => $totalPrice,
                                        'qty' => $row->quantity,
                                        'total_qty' => $total_qty,
                                        'cart' => $cart_data,
                                    ];
                                    dispatch(new SendMailPaymentsuccess4Job($data));

                                    if ($req->ajax()) {
                                        return response()->json([
                                            'status' => 'VALID',
                                            'return' => $req->get('bayar_input')
                                        ]);
                                    }
                                } catch (Throwable $e) {
                                    return response()->json($this->getResponse());
                                }
                            }
                        }
                    }
                } else if ($req->get('type_single') == 2) {
                    if ($log_limit->quota_kupon == 0) {
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
                                try {
                                    $log_limit->quota_kupon = $log_limit->quota_kupon - 1;
                                    $report_limit = ReportLimit::where('visitor_id', $req->get('page'))->first();
                                    $report_limit->report_quota_kupon = $report_limit->report_quota_kupon - 1;
                                    $log_limit->save();
                                    $report_limit->save();

                                    LogTransaction::create([
                                        'order_number' => $req->get('order_number'),
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'cart' => serialize($cart_data),
                                        'payment_type' => serialize([['payment_type' => 'kupon', 'total' => 1, 'balance' => $log_limit->quota_kupon]]),
                                        'payment_status' => 'paid',
                                        'total' => $totalPrice
                                    ]);

                                    LogAdmin::create([
                                        'user_id' => Auth::id(),
                                        'type' => 'CREATE',
                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                    ]);

                                    // informasi limit kupon
                                    ReportLimit::create([
                                        'status' => 'Berkurang',
                                        'report_quota_kupon' => $log_limit->quota_kupon,
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'activities' => 'Limit Kupon <b>Berkurang</b> menjadi <b>' . $log_limit->quota_kupon . ' ! </b>  Anda telah melakukan pembayaran menggunakan<b> quota kupon</b>',
                                        'created_at' => Carbon::now(),
                                    ]);

                                    \Cart::session($req->get('page'))->clear();

                                    $log_limit = LogLimit::where('visitor_id', $req->get('page'))->first();
                                    $data['qty'] = $row->quantity;
                                    $total_qty = 0;
                                    foreach ($cart_data as $get) {
                                        $total_qty += $get['qty'];
                                    }
                                    $log_transaction = LogTransaction::where('visitor_id', $req->get('page'))->latest()->first();
                                    $payment_type = unserialize($log_transaction->payment_type);

                                    $data = [
                                        'name' => $visitor->name,
                                        'email' => $visitor->email,
                                        'address' => $visitor->address,
                                        'phone' => $visitor->phone,
                                        'type_member' => $visitor->tipe_member,
                                        'order_number' => $req->get('order_number'),
                                        'payment_type' => $payment_type,
                                        'date' => $row->attributes['created_at'],
                                        'pricesingle' => $row->price,
                                        'price' => $row->getPriceSum(),
                                        'total' => $totalPrice,
                                        'qty' => $row->quantity,
                                        'total_qty' => $total_qty,
                                        'cart' => $cart_data,
                                        'sisakupon' => $log_limit->quota_kupon,
                                    ];
                                    dispatch(new SendMailPaymentsuccess4Job($data));

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
                                try {
                                    $log_limit->quota = $log_limit->quota - 1;
                                    $report_limit = ReportLimit::where('visitor_id', $req->get('page'))->first();
                                    $report_limit->report_quota = $report_limit->report_quota - 1;
                                    $log_limit->save();
                                    $report_limit->save();

                                    LogTransaction::create([
                                        'order_number' => $req->get('order_number'),
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'cart' => serialize($cart_data),
                                        'payment_type' => serialize([['payment_type' => 'limit', 'total' => 1, 'balance' => $log_limit->quota]]),
                                        'payment_status' => 'paid',
                                        'total' => $totalPrice
                                    ]);

                                    LogAdmin::create([
                                        'user_id' => Auth::id(),
                                        'type' => 'CREATE',
                                        'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                                    ]);

                                    // informasi limit bulanan
                                    ReportLimit::create([
                                        'status' => 'Berkurang',
                                        'report_quota' => $report_limit->report_quota,
                                        'visitor_id' => $req->get('page'),
                                        'user_id' => Auth()->id(),
                                        'activities' => '<b>Limit Bulanan Berkurang menjadi '.$report_limit->report_quota.' ! </b>  Anda telah melakukan pembayaran menggunakan<b> quota bulanan</b>',
                                        'created_at' => Carbon::now(),
                                    ]);

                                    \Cart::session($req->get('page'))->clear();

                                    $log_limit = LogLimit::where('visitor_id', $req->get('page'))->first();
                                    $data['qty'] = $row->quantity;
                                    $total_qty = 0;
                                    foreach ($cart_data as $get) {
                                        $total_qty += $get['qty'];
                                    }
                                    $log_transaction = LogTransaction::where('visitor_id', $req->get('page'))->latest()->first();
                                    $payment_type = unserialize($log_transaction->payment_type);

                                    $data = [
                                        'name' => $visitor->name,
                                        'email' => $visitor->email,
                                        'address' => $visitor->address,
                                        'phone' => $visitor->phone,
                                        'type_member' => $visitor->tipe_member,
                                        'order_number' => $req->get('order_number'),
                                        'payment_type' => $payment_type,
                                        'date' => $row->attributes['created_at'],
                                        'pricesingle' => $row->price,
                                        'price' => $row->getPriceSum(),
                                        'total' => $totalPrice,
                                        'qty' => $row->quantity,
                                        'total_qty' => $total_qty,
                                        'cart' => $cart_data,
                                        'sisabulanan' => $log_limit->quota,
                                    ];
                                    dispatch(new SendMailPaymentsuccess4Job($data));

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
            if (empty($req->get('type_multiple'))) {
                $this->setResponse('INVALID', "Silahkan pilih jenis multiple pembayaran");
                return response()->json($this->getResponse());
            } else {
                $this->setResponse('VALID', "iohoiuerg");
                return response()->json($this->getResponse());
            }
        }
    }

    public function print_invoice($id)
    {
        $visitor = Visitor::find($id);
        $log_transaction = LogTransaction::where('visitor_id', $id)->latest()->first();
        $cart = unserialize($log_transaction->cart);
        $payment_type = unserialize($log_transaction->payment_type);
        $deposit = Deposit::where('visitor_id', $id)->first();
        $total = 0;
        $qty = 0;
        foreach ($cart as $get) {
            $qty += $get['qty'];
            $total += $get['price'];
        }
        $counted = ucwords(counted($total) . ' Rupiah');
        return view('print-invoice', compact(
            'visitor',
            'log_transaction',
            'payment_type',
            'cart',
            'deposit',
            'total',
            'counted',
            'qty'
        ));
    }

    private function setResponse($status = "INVALID", $message = "Ada sesuatu yang salah!", $data = [])
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    private function getResponse()
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data ? $this->data : null
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
