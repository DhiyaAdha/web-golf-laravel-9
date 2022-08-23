<?php

namespace App\Http\Controllers;
use App\Models\Invoice;

use App\Models\Visitor;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //fungsi untuk INVOICE
    public function invoice(){
        $data['invoice'] = Invoice::all();
        // $invoice = Invoice::where('id',$id)->first();
        // dd($invoice);
        // if(is_null($invoice)){
            //     $todaydate = Carbon::today();
            //     $invoice = new Invoice;
            //     $invoice->id = $id;
            //     $invoice->created_at = $todaydate;
            //     $invoice->status = 1;
            //     $invoice->save();
            // }
            // $order_payments = Order::find($id);
            // $unique_number = $order_payments->unique_number;
            // $profile = Profile::where('user_id',$customer_id)->first();
        // $orderitems = Orderitem::where('order_id',$order_id)->get();
        // $judulhalaman = "Invoice";
        return view('Invoice.invoice', $data);
    }

    public function riwayatinvoice(){
        $data['visitor'] = Visitor::all()->sortByDesc('created_at');

        
        return view('Invoice.riwayat-invoice', $data);
    }
}
