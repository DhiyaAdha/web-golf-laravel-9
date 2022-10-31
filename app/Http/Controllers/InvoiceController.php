<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Package;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogTransactionExport;
use Illuminate\Support\Facades\Crypt;
// use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $riwayat_invoice = LogTransaction::join('visitors', 'log_transactions.visitor_id', '=', 'visitors.id')->orderBy('log_transactions.created_at', 'desc')->get(['log_transactions.*', 'visitors.name as name', 'visitors.tipe_member as tipe_member']);
        $list_invoice = [];
        foreach($riwayat_invoice as $invoice){
            $list_invoice += [
                'id'=> $invoice['id'],
                'payment_type'=> unserialize($invoice['payment_type']),
                'total'=> $invoice['total'],
                'created_at'=> $invoice['created_at'],
                'name'=> $invoice['name'],
                'tipe_member'=> $invoice['tipe_member'],
            ];
        }
        if($request->ajax()){
            return datatables()->of($riwayat_invoice)->addColumn('action', function ($data) {
                return '<div class="align-items-center"><a href="'.url('invoice_cetakpdf/'.$data->id).'" target="_blank" name="pdf" data-toggle="tooltip" data-placement="top" title="download pdf"><img src="dist/img/pdf.svg" width="23px" height="23px"></a></div>';
            })
            ->editColumn('name', function ($data) {
                return '<a data-toggle="tooltip" title="klik untuk melihat detail invoice" href="
                '.url('invoice/'.$data->id).'
                ">'
                .$data->name.
                "</a>";
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d F Y');
            })
            ->editColumn('payment_type', function ($data) {
                $type = unserialize($data->payment_type);
                if (isset($type['payment_type'])) {
                    return sprintf('<div class="d-flex flex-wrap justify-content-center align-items-center"><span class="label mr-5 label-info">'.$type[0]['payment_type'].'</span></div>');
                } else {
                    $datax = array();
                    foreach ($type as $i => $t) {
                        $datax[$i] = $t['payment_type'];
                    }
                    $tagsString = implode("</span> <span class='label mr-5 label-info'>", $datax);
                    return sprintf('<div class="d-flex flex-wrap justify-content-center align-items-center"><span class="label mr-5 label-info">'.$tagsString.'</span></div>');
                }
            })
            ->editColumn('total', function ($data) {
                return  ('Rp. ' .formatrupiah($data->total));
            })
            ->rawColumns(['name','action', 'payment_type'])
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
    
    public function show($id) {
        try {
            $transaction = LogTransaction::find($id);
            $payment_type = unserialize($transaction->payment_type);
            $datax = array();
            foreach ($payment_type as $i => $t) {
                $datax[$i] = $t['payment_type'];
            }
            $method_payment = implode(", ", $datax);
            $cart = unserialize($transaction->cart);
            $visitor = Visitor::find($transaction->visitor_id);
            $total = 0;
            $qty = 0;
            $discount = 0;
            foreach ($cart as $get) {
                $qty += $get['qty'];
                $total += $get['price'];
            }
            foreach ($payment_type as $get) {
                $discount += $get['discount'];
            }
            return view('invoice.invoice', compact('method_payment','transaction', 'visitor', 'cart', 'qty', 'discount', 'total'));
        } catch (\Throwable $th) {
            return redirect()->route('invoice',$id);
        }
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

    public function metode_pembayaran () {
        return view('invoice.metode_pembayaran');
    }

    public function cetak_pdf($id) {
        try {
            $transaction = LogTransaction::find($id);
            $payment_type = unserialize($transaction->payment_type);
            $datax = array();
            foreach ($payment_type as $i => $t) {
                $datax[$i] = $t['payment_type'];
            }
            $method_payment = implode(", ", $datax);
            $cart = unserialize($transaction->cart);
            $visitor = Visitor::find($transaction->visitor_id);
            $total = 0;
            $qty = 0;
            $discount = 0;
            foreach ($cart as $get) {
                $qty += $get['qty'];
                $total += $get['price'];
            }
            foreach ($payment_type as $get) {
                $discount += $get['discount'];
            }
            $pdf = PDF::loadView('invoice.cetak_invoice', compact('method_payment','transaction', 'visitor', 'cart', 'qty', 'discount', 'total'));
            return $pdf->download('invoice_'.$visitor->name.'_'.date('YmdHis').'.pdf');
        } catch (\Throwable $th) {
            return redirect()->route('riwayat-invoice.index');
        }
    }
    public function export_excel()
    {
        return Excel::download(new LogTransactionExport, 'riwayat_invoice.xlsx');
    }
}