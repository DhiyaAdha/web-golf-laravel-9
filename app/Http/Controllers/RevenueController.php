<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogTransaction;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Total revenue today
        $data['pendapatan_revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('total');

        $data['pendapatan_revenue_default'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_default');
        // $transaction = LogTransaction::all();
        // $cart = unserialize($transaction->cart);
        // foreach($cart as $kondisi){
        //     if ($kondisi['category'] == 'default'){
                
        //     }
        // }
        // $total = 0;
        // $qty = 0;
        // foreach ($cart as $get) {
        //     $qty += $get['category'];
        //     $total += $get['price'];
        // }


        //Total revenue permainan
        // $transaction = LogTransaction::find($id);
        // $cart = unserialize($transaction->cart);
        // $id_jenis_permainan = '';
        // foreach ($cart as $get) {
        //     $id_jenis_permainan += $get['rowId'];
        // }



        //Total revenue fasilitas
        //Total revenue penjualan produk


        return view('dashboard.revenue', $data);
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
