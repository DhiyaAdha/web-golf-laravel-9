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
        $output = Visitor::where('tipe_member','!=','REGULER')->get();
        // dd($output);
        return view('tamu.export_excel_tamu', [
            'visitor' => $output
        ]);
    }
}
