<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class AnalisisTamuSheet implements FromView, WithTitle
{
    private $data;
    private $category;

    public function __construct($data, $category)
    {
        $this->data = $data;
        $this->category  = $category;
    }

    public function view(): View
    {
        $category = $this->category;
        $data = Arr::where($this->data, function ($value, $key) use ($category) {
            return $value['category'] == $category;
        });
        return view('dashboard.export', [
            'data' => $data,
            'category' => $category
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->category == 'default' ? 'Permainan' : ($this->category == 'additional' ? 'Proshop & Fasilitas' : ($this->category == 'others' ? 'Kantin' : ($this->category == 'rental' ? 'Penyewaan' : 'Service Fee')));
    }
}