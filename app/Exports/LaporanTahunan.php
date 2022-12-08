<?php

namespace App\Exports;

// use App\Models\LogTransaction;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanTahunan implements FromView
{
    protected $data;
    protected $year;
    protected $month;
    protected $category;

    public function __construct($data, $year, $category)
    {
        $this->data = $data;
        $this->year = $year;
        $this->category = $category;
    }

    public function view(): View
    {
        return view('dashboard.download_tahunan', [
            'year' => $this->year,
            'data' => $this->data,
            'category' => $this->category,
        ]);
    }
}
