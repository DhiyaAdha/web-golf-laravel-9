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
        $riwayat_invoice = LogTransaction::select(['log_transactions.id', 'log_transactions.total', 'visitors.name', 'visitors.tipe_member', 'log_transactions.created_at'])->leftJoin('visitors', 'visitors.id', '=', 'log_transactions.visitor_id')->get();
        if($request->ajax()){
            return datatables()->of($riwayat_invoice)->addColumn('action', function ($data) {
                $button = '<div class="align-items-center">
                                <a href="javascript:void(0)" name="pdf" data-toggle="tooltip" data-placement="top" title="download pdf"><img src="'. url('/dist/img/pdf.svg').'" width="20" height="20"></a>
                            </div>';
                return $button;
            })->editColumn('name', function ($data) {
                return '<a data-toggle="tooltip" title="klik untuk melihat detail invoice" href="'.url('invoice/'.$data->id).'">'.$data->name."</a>";
            })->editColumn('created_at', function ($data) {
                return $data->created_at->format('d F Y');
            })->editColumn('total', function ($data) {
                return  ('Rp. ' .formatrupiah($data->total));
            })->rawColumns(['name','action'])->make(true);
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
        $transaction = LogTransaction::find($id);
        $package = Package::find($id);
        $detail = Detail::find($id);
        $data['transaction'] = $transaction;
        $data['visitor'] = Visitor::find($transaction->visitor_id);
        $data['package'] = Package::find($package->id);
        $data['detail'] = Detail::find($detail->id);
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

    public function exportpdf () {
        return 'berhasil';
    }

    public function metode_pembayaran () {
        return view('Invoice.metode_pembayaran');
    }
    
}