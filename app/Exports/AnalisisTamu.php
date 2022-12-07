<?php

namespace App\Exports;

// use App\Models\LogTransaction;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\FromView; 
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AnalisisTamu implements WithMultipleSheets
{
    use Exportable;

    protected $data;
    protected $category;

    public function __construct($data, $sheets)
    {
        $this->data = $data;
        $this->category = $sheets;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->category as $key => $value) {
            $sheets[] = new AnalisisTamuSheet($this->data, $value);
        }

        return $sheets;
    }
}
