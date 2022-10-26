@if (auth()->user()->role_id == '2')
    @extends('layouts.main', ['title' => 'TGCC | Analisis Revenue'])
    @section('content')
        <div class="page-wrapper">
            <div class="container-fluid">
                <h3>Total Revenue Hari ini</h3>Rp. {{ formatrupiah($pendapatan_revenue_today) }}
                <h3>Total Revenue Permainan Hari ini</h3>{{ $pendapatan_revenue_default }}
                <h3>Total Revenue Fasilitas Hari ini</h3>p
                <h3>Total Revenue Lainnya Hari ini</h3>p
            </div>
        </div>
        @endsection
@endif
