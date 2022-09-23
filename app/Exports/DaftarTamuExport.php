<?php

namespace App\Exports;

use App\Models\Visitor;
use illuminate\contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DaftarTamuExport implements FromView
{
    public function view(): View
    {
        return view('tamu.export_excel_tamu', [
            // 'export_excel' => LogTransaction::select('log_transactions.id', 'log_transactions.total', 'visitors.name', 'visitors.tipe_member', 'log_transactions.created_at')
            //                                 ->leftJoin('visitors', 'visitors.id', '=', 'log_transactions.visitor_id')
            //                                 ->get();
            'visitor' => Visitor::all()
            
        ]);
    }
}
