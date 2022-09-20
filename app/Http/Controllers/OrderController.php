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
        // dd($oldCart);
        return view('keranjang', compact('orders','oldCart', 'counted', 'totalPrice', 'totalQuantity', 'default','additional', 'date_now', 'today'));
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

    public function add(Request $request, $id)
    { 
        $package = Package::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($package,$package->id);
        $request->session()->put('cart',$cart);
        return redirect()->back()->with('success', 'Data berhasil ditambah');
    }
}
