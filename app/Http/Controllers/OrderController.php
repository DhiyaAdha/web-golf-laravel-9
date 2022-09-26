<?php

namespace App\Http\Controllers;

use DB;
use Throwable;
use App\Models\Deposit;
use App\Models\Package;
use App\Models\Visitor;
use App\Models\LogAdmin;
use App\Models\LogLimit;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\ReportDeposit;
use App\Models\LogTransaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
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
        if (! $request->hasValidSignature()) {
            return \redirect('/analisis-tamu');
        }
        $today = Carbon::now()->isoFormat('dddd');
        $date_now = Carbon::now()->translatedFormat('d F Y');
        $visitor = request()->segment(2);
        $url_checkout = URL::temporarySignedRoute('checkout', now()->addMinutes(7), ['id' => $visitor]);
        $default = Package::where('category', 'default')->where('status', 0)->get();
        $additional = Package::where('category', 'additional')->where('status', 0)->get();
        if(request()->tax){
            $tax = "+10%";
        }else{
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
        if(\Cart::isEmpty()){
            $cart_data = [];            
        } else {
            foreach($items as $row) {
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
        $counted = ucwords(counted($total). ' Rupiah');
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
        $counted = ucwords(counted($get_total). ' Rupiah');
        if($cek_itemId->isNotEmpty()){
            if($package->quantity == $cek_itemId[$id[3]]->quantity){
                return redirect()->back()->with('error','jumlah item kurang');
            }else{
                // \Cart::session($request->get('page'))->update($id[3], array(
                //     'quantity' => 1
                // ));
                if( $cek_itemId[$id[3]]->quantity >= 1){
                    $this->setResponse('INVALID', "Limit tidak terpenuhi");
                    return response()->json($this->getResponse());
                }
                return response()->json([
                    'id'=>$id[3], 
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
            if(\Cart::isEmpty()){
                $cart_data = [];            
            } else {
                foreach($cart as $row) {
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
            $counted = ucwords(counted($get_total). ' Rupiah');
            return response()->json([
                'id'=>$id[3], 
                'total' => $get_total,
                'counted' => $counted,
                'cart' => $cart_data,
                'qty' => $cek_itemId[$id[3]]->quantity, 
                'name' => $cek_itemId[$id[3]]->name, 
                'price' => $cek_itemId[$id[3]]->price
            ], 200);
        }  
    }

    public function update_qty(Request $request){
        $package = Package::find($request->get('id'));     
        $cart = \Cart::session($request->get('page'))->getContent();        
        $cek_itemId = $cart->whereIn('id', $request->get('id')); 
        if($request->get('type') == 'plus'){
            if($package->quantity == $cek_itemId[$request->get('id')]->quantity) {
                return redirect()->back()->with('error','jumlah item kurang');
            } else {
                \Cart::session($request->get('page'))->update($request->get('id'), array(
                    'quantity' => array(
                        'relative' => true,
                        'value' => 1
                )));
                $items = \Cart::session($request->get('page'))->getContent();
                $get_total = \Cart::session($request->get('page'))->getTotal();
                $counted = ucwords(counted($get_total). ' Rupiah');
                return response()->json([
                    'id'=>$request->get('id'), 
                    'total' => $get_total,
                    'counted' => $counted,
                    'cart' => $items,
                    'qty' => $cek_itemId[$request->get('id')]->quantity, 
                    'price' => $cek_itemId[$request->get('id')]->price
                ], 200);
            }   
        } else {
            if($cek_itemId[$request->get('id')]->quantity == 1){
                \Cart::session($request->get('page'))->remove($request->get('id'));  
            }else{
                \Cart::session($request->get('page'))->update($request->get('id'), array(
                'quantity' => array(
                    'relative' => true,
                    'value' => -1
                )));            
            }
            $items = \Cart::session($request->get('page'))->getContent();
            $get_total = \Cart::session($request->get('page'))->getTotal();
            $counted = '';
            if(\Cart::isEmpty()){
                $counted = '-';
            } else {
                $counted = ucwords(counted($get_total). ' Rupiah');
            }
            return response()->json([
                'id'=>$request->get('id'), 
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
        if(\Cart::isEmpty()){
            $counted = '-';
        } else {
            $counted = ucwords(counted($get_total). ' Rupiah');
        }
        return response()->json([
            'id'=>$request->get('id'), 
            'total' => $get_total,
            'counted' => $counted,
            'cart' => $items,
        ], 200);
    }

    public function clear_cart(Request $request){
        \Cart::session($request->get('page'))->clear();
        return redirect()->back();
    }

    public function checkout(Request $request, $id)
    {
        $visitor = Visitor::find(request()->segment(2));
        $items = \Cart::session(request()->segment(2))->getContent();
        $totalPrice = \Cart::session(request()->segment(2))->getTotal();
        if(\Cart::isEmpty()){
            $cart_data = [];            
        } else {
            foreach($items as $row) {
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
        $order_number = 'INV/'.Carbon::now()->format('Ymd').'/'.$visitor->tipe_member.'/'.Carbon::now()->format('his');
        $deposit = Deposit::where('visitor_id', request()->segment(2))->first();
        $log_limit = LogLimit::where('visitor_id', request()->segment(2))->first();
        if($request->ajax()){
            return response()->json(['order_number' => $order_number]);
        }
        return view("checkout", compact('log_limit', 'visitor', 'deposit','totalPrice', 'order_number', 'orders'))->render();
    }

    public function select(Request $request)
    {
        $type = $request->get('type');
        $totalPrice = \Cart::session($request->get('param'))->getTotal();
        $deposit = Deposit::where('visitor_id', $request->get('param'))->first();
        $log_limit = LogLimit::where('visitor_id', $request->get('param'))->first();
        if($type == 4) {
            $resultPrice =  $deposit->balance - $totalPrice;
            if($resultPrice > 0) {
                try {
                    return response(['limit' => $log_limit->quota, 'price' => $resultPrice, 'kupon' => $log_limit->quota_kupon, 'VALID' => 'Deposit telah dipilih']);
                } catch (\Throwable $th) {
                    return response()->json($this->getResponse());
                }
            } else {
                $this->setResponse('INVALID', "Deposit tidak terpenuhi");
                return response()->json($this->getResponse());
            }
        } else if ($type == 3) {
            try {
                return response(['limit' => $log_limit->quota, 'price' => $deposit->balance, 'kupon' => $log_limit->quota_kupon, 'VALID' => 'Deposit telah dipilih']);
            } catch (\Throwable $th) {
                return response()->json($this->getResponse());
            }
        } else if($type == 2) {
            $resultLimit =  $log_limit->quota_kupon - 1;
            if($resultLimit > 0){
                try {
                    return response(['kupon' => $resultLimit, 'limit' => $log_limit->quota, 'price' => $deposit->balance, 'VALID' => 'Kupon telah dipilih']);
                } catch (\Throwable $th) {
                    return response()->json($this->getResponse());
                }
            } else {
                $this->setResponse('INVALID', "Limit tidak terpenuhi");
                return response()->json($this->getResponse());
            }
        } else if ($type == 1) {
            $resultLimit =  $log_limit->quota - 1;
            if($log_limit > '0') {
                try {
                    return response(['price' => $deposit->balance, 'limit' => $resultLimit, 'kupon' => $log_limit->quota_kupon, 'VALID' => 'Limit telah dipilih']);
                } catch (\Throwable $th) {
                    return response()->json($this->getResponse());
                }
            } else {
                $this->setResponse('INVALID', "Limit tidak terpenuhi");
                return response()->json($this->getResponse());
            }
        }
    }

    public function pay(Request $req) {
        $visitor = Visitor::find($req->get('page'));
        $items = \Cart::session($req->get('page'))->getContent();
        $deposit = Deposit::where('visitor_id', $req->get('page'))->first();
        $totalPrice = \Cart::session($req->get('page'))->getTotal();
        if(\Cart::isEmpty()){
            $cart_data = [];            
        } else {
            foreach($items as $row) {
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
        if($req->get('single')){
            if($req->get('single') == 4){
                if($deposit->balance < $totalPrice){
                    $this->setResponse('INVALID', "Deposit tidak terpenuhi");
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
                            'payment_type' => 'deposit',
                            'payment_status' => 'paid',
                            'total' => $totalPrice
                        ]);

                        LogAdmin::create([
                            'user_id' => Auth::id(),
                            'type' => 'CREATE',
                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                        ]);

                        \Cart::session($req->get('page'))->clear();
                        if($req->ajax()){
                            $this->setResponse('VALID', "Pembayaran berhasil");
                            return response()->json($this->getResponse());
                        }
                    } catch (Throwable $e) {
                        return response()->json($this->getResponse());
                    }
                }
            } else if($req->get('single') == 3){
                if($req->get('bayar_input') < $totalPrice) {
                    $this->setResponse('INVALID', "Nominal tidak terpenuhi");
                    return response()->json($this->getResponse());
                } else {
                    try {
                        $return = $req->get('bayar_input') - $totalPrice;
                        LogTransaction::create([
                            'order_number' => $req->get('order_number'),
                            'visitor_id' => $req->get('page'),
                            'user_id' => Auth()->id(),
                            'cart' => serialize($cart_data),
                            'payment_type' => 'cash/transfer',
                            'payment_status' => 'paid',
                            'total' => $totalPrice
                        ]);

                        LogAdmin::create([
                            'user_id' => Auth::id(),
                            'type' => 'CREATE',
                            'activities' => 'Melakukan transaksi tamu <b>' . $visitor->name . '</b>'
                        ]);

                        \Cart::session($req->get('page'))->clear();

                        if($req->ajax()){
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
    }

    public function print_invoice($id){
        $visitor = Visitor::find($id);
        $log_transaction = LogTransaction::where('visitor_id', $id)->latest()->first();
        $cart = unserialize($log_transaction->cart);
        $deposit = Deposit::where('visitor_id', $id)->first();
        $total = 0;
        $qty = 0;
        foreach($cart as $get) {
            $qty += $get['qty'];
            $total += $get['price'];
        }
        $counted = ucwords(counted($total). ' Rupiah');
        return view('print-invoice', compact(
            'visitor', 
            'log_transaction', 
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
