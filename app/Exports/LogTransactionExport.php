<?php

namespace App\Exports;

use App\Models\LogTransaction;
use illuminate\contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LogTransactionExport implements FromView
{
    public function view(): View
    {
        return view('invoice.export_excel', [
            'transaction' => LogTransaction::select('order_number', 'visitors.name', 'visitor_id', 'visitors.tipe_member', 'total', 'payment_type', 'log_transactions.created_at')
            ->leftJoin('visitors', 'log_transactions.visitor_id', '=', 'visitors.id')
            ->get(),
        ]);
    }
}
