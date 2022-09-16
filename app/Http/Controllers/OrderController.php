<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

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
        $count_default = count($default);
        $additional = Package::where('category', 'additional')->where('status', 0)->get();
        $count_additional = count($additional);
        return view('proses', compact('package','default','additional', 'count_default', 'count_additional'));
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

    public function qty_plus(Request $request)
    {
        $id = $request->get('id');
        $qty_plus = $request->get('qty_plus');
        $price = $request->get('price');
        return response()->json(['id' => $id, 'plus' => $qty_plus, 'price' => $price], 200);
    }

    public function qty_minus(Request $request)
    {
        $id = $request->get('id');
        $qty_minus = $request->get('qty_minus');
        $price = $request->get('price');
        return response()->json(['id' => $id, 'minus' => $qty_minus, 'price' => $price], 200);
    }
}
