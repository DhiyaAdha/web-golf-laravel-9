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
                $get_total = \Cart::session(auth()->id())->getTotal();
                $counted = ucwords(counted($get_total) . ' Rupiah');
                return response()->json([
                    'id' => $request->get('id'),
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $cart_data,
                    'qty' => $cek_itemId[$request->get('id')]->quantity,
                    'name' => $cek_itemId[$request->get('id')]->name,
                    'price' => $cek_itemId[$request->get('id')]->price,
                    'status' => 'VALID'
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
            $items = \Cart::session(auth()->id())->getContent();
            $totalPrice = \Cart::session(auth()->id())->getTotal();
            $today = Carbon::now()->isoFormat('dddd');
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
            $order_number = 'INV/' . Carbon::now()->format('Ymd') . '/REGULER/' . Carbon::now()->format('his');
            if ($request->ajax()) {
                return response()->json(['order_number' => $order_number]);
            }
            return view("reguler.checkout_reguler", compact('totalPrice', 'order_number', 'orders'))->render();
        } catch (\Throwable $th) {
            return redirect()->route('proses_reguler');
        }
    }

    public function pay_reguler(Request $request) {
        $items = \Cart::session(auth()->id())->getContent();
        $totalPrice = \Cart::session(auth()->id())->getTotal();
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
        try {
            Visitor::create([
                'name' => $request->get('name'),
                'tipe_member' => 'REGULER',
                'created_at' => Carbon::now(),
            ]);

            LogTransaction::create([
                'order_number' => $request->get('order_number'),
                'visitor_id' =>  Visitor::latest()->first()->id,
                'user_id' => Auth()->id(),
                'cart' => serialize($cart_data),
                'payment_type' => serialize([[
                    'payment_type' => 'cash/transfer', 
                    'transaction_amount' => $request->get('pay_amount'),
                    'balance' => 0,
                    'discount' => 0,
                    'refund' => $request->get('refund')
                ]]),
                'payment_status' => 'paid',
                'total' => $totalPrice
            ]);

            LogAdmin::create([
                'user_id' => Auth::id(),
                'type' => 'CREATE',
                'activities' => 'Melakukan transaksi tamu <b>' . Visitor::latest()->first()->name . '</b>'
            ]);

            \Cart::session(auth()->id())->clear();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'VALID',
                    'message' => 'Pembayaran berhasil',
                    'return' => $request->get('pay_amount')
                ]);
            }
        } catch (Throwable $e) {
            return response()->json($this->getResponse());
        }
    }

    public function print_invoice(Request $request) {
        try {
            $visitor = Visitor::latest()->first();
            $log_transaction = LogTransaction::latest()->first();
            $user = User::find($log_transaction->user_id);
            $cart = unserialize($log_transaction->cart);
            $payment_type = unserialize($log_transaction->payment_type);
            $total = 0;
            $qty = 0;
            $refund = 0;
            $transaction_amount = 0;
            foreach ($cart as $get) {
                $qty += $get['qty'];
                $total += $get['price'];
            }
            foreach ($payment_type as $get) {
                $refund += $get['refund'];
                $transaction_amount += $get['transaction_amount'];
            }
            $counted = ucwords(counted($log_transaction->total) . ' Rupiah');
            return view('reguler.print-invoice', compact(
                'visitor',
                'log_transaction',
                'payment_type',
                'cart',
                'counted',
                'total',
                'qty',
                'user',
                'refund',
                'transaction_amount'
            ));
        } catch (Throwable $e) {
            return redirect()->route('proses_reguler');
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