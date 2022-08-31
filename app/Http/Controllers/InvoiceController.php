<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Package;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $riwayat_invoice = LogTransaction::select(['log_transactions.id', 'log_transactions.total', 'visitors.name', 'visitors.tipe_member', 'log_transactions.created_at'])
        ->leftJoin('visitors', 'visitors.id', '=', 'log_transactions.visitor_id')->get();
        if($request->ajax()){
            return datatables()->of($riwayat_invoice)
            ->editColumn('name', function ($data) {
                return '<a href="'.url('invoice/'.$data->id).'">'.$data->name."</a>";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d F Y');
            })
            ->rawColumns(['name','action'])
            ->make(true);
        }
        return view('invoice.riwayat-invoice');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $invoice = Detail::select(['packages.category', 'detail_transactions.harga', 'detail_transactions.quantity'])
        ->leftJoin('packages', 'packages.id', '=', 'detail_transactions.package_id')->get();
        if($request->ajax()){
            return datatables()->of($invoice)
            ->editColumn('harga', function ($data) {
                return  ('Rp. ' .formatrupiah($data->harga));
            })
            ->editColumn('total', function ($data) {
                return  ('Rp. ' .formatrupiah($data->harga * $data->quantity));
            })
            ->make(true);

        }
        return view('invoice.invoice');
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
        $transaction = LogTransaction::find($id);
        $package = Package::find($id);
        $detail = Detail::find($id);
        $data['transaction'] = $transaction;
        $data['visitor'] = Visitor::find($transaction->visitor_id);
        $data['package'] = Package::find($package->id);
        $data['detail'] = Detail::find($detail->id);
        // $data['detail'] = Detail::where('transaction_id', $id)->get();
        return view('invoice.invoice', $data);
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
