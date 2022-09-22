<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Deposit;
use App\Models\Package;
use App\Models\Visitor;
use App\Models\LogLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

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
    private $user;

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
        $package = Package::get();
        $default = Package::where('category', 'default')->where('status', 0)->get();
        $additional = Package::where('category', 'additional')->where('status', 0)->get();
        $today = Carbon::now()->isoFormat('dddd');
        $date_now = Carbon::now()->translatedFormat('d F Y');
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        $orders = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        $counted = ucwords(counted($totalPrice). ' Rupiah');
        $visitor = request()->segment(2);
        $url_checkout = URL::temporarySignedRoute('checkout', now()->addMinutes(7), ['id' => $visitor]);
        return view('keranjang', compact(
            'orders',
            'url_checkout', 
            'oldCart', 
            'counted', 
            'totalPrice', 
            'totalQuantity', 
            'default',
            'additional', 
            'date_now', 
            'today'
        ));
    }

    public function add(Request $request, $id)
    { 
        $package = Package::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart',[]) : null;
        $cart = new Cart($oldCart);
        $cart->add($package);
        $request->session()->put('cart',$cart); 
        return redirect()->back()->with('success', 'Data berhasil ditambah');
    }

    public function remove($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->totalPrice -= $cart->items[$id]['item']['price'];
        unset($cart->items[$id]);
        $cart->totalQuantity--;
    
        Session::put('cart',$cart);
        if($cart->totalQuantity<=0){
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function remove_all($id)
    {
        if(Session::has('cart')){
            foreach (Session::get('cart') as $key => $value) {
                Session::forget('cart', $id);
            }
        }
        return redirect()->back();
    }

    public function checkout(Request $request, $id)
    {
        $url_qr = request()->segment(2);
        $visitor = Visitor::find($url_qr);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart= new Cart($oldCart);
        $orders = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        $time = Carbon::now();
        // $order_number = 'INV/'.$time->format('Ymd').'/'.$visitor->tipe_member.'/'.$time->format('his');
        
        $deposit = Deposit::where('visitor_id', $url_qr)->first();
        $log_limit = LogLimit::where('visitor_id', $url_qr)->first();
        return view("checkout", compact('log_limit', 'deposit','totalPrice', 'totalQuantity', 'orders'))->render();
    }

    public function select(Request $request)
    {
        $type = $request->get('type');
        $param = $request->get('param');
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart= new Cart($oldCart);
        $totalPrice = $cart->totalPrice;
        $deposit = Deposit::where('visitor_id', $param)->first();
        $log_limit = LogLimit::where('visitor_id', $param)->first();
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
