<?php

namespace App\Exports;

use App\Models\LogTransaction;
use illuminate\contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class LogTransactionExport implements FromView
{
    public function view(): View
    {
        return view('invoice.export_excel', [
            // 'export_excel' => LogTransaction::select('log_transactions.id', 'log_transactions.total', 'visitors.name', 'visitors.tipe_member', 'log_transactions.created_at')
            //                                 ->leftJoin('visitors', 'visitors.id', '=', 'log_transactions.visitor_id')
            //                                 ->get();
            'transaction' => LogTransaction::select('order_number', 'visitors.name', 'visitor_id', 'visitors.tipe_member', 'total', 'log_transactions.created_at')
            ->leftJoin('visitors', 'log_transactions.visitor_id', '=', 'visitors.id')
            ->get()
        ]);
    }
}
