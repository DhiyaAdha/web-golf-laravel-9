<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // dd($oldCart);
        $cart= new Cart($oldCart);
        $orders = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        $counted = ucwords(counted($totalPrice). ' Rupiah');
        return view('keranjang', compact('orders','oldCart', 'counted', 'totalPrice', 'totalQuantity', 'default','additional', 'date_now', 'today'));
    }

    public function add(Request $request, $id)
    { 
        $package = Package::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart',[]) : null;
        
        $cart = new Cart($oldCart);
        $cart->add($package,$package->id);
        $request->session()->put('cart',$cart); 

        // if($oldCart->items['quantity'] > 1){
        //     foreach($oldCart->items as $item) {
        //         if ($item['product_id'] == $package->id) {
        //             $item['quantity'] = $item['quantity'] + 1;
        //             $item['price'] = $item['price'] * 2;
        //             $oldCart->totalPrice *= $item['quantity'];
        //             break;
        //         }
        //     }
        //     $request->session()->put('cart',$oldCart); 
        // } else {
        // }
        return redirect()->back()->with('success', 'Data berhasil ditambah');
    }

    public function remove($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        foreach($cart->items as $item) {
            for ($x=0; $x<=count($item);$x++){
                if(!array_key_exists($x, $item)){
                    $item_id=$x;
                    break;
                }
            }
        }
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

    public function checkout(Request $request)
    {
        $time = Carbon::now();
        $order_number = 'INV/'.$time->format('Ymd').'/'.'VIP'.'/'.$time->format('his');
        return view("checkout", compact('order_number'))->render();
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
