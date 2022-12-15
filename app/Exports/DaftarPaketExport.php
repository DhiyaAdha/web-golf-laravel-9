<?php

namespace App\Exports;

use App\Models\Package;
use illuminate\contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;

class DaftarPaketExport implements FromView
{
    public function view(): View
    {
        $output = Package::all();
        return view('package.export_excel_package', [
            'package' => $output,
        ]);
    }
}
