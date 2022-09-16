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
        return view('invoice.riwayat-invoice', [
            'export_excel' => LogTransaction::all()
        ]);
    }
}
