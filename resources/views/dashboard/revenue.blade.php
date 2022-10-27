@if (auth()->user()->role_id == '2')
    @extends('layouts.main', ['title' => 'TGCC | Analisis Revenue'])
    @section('content')
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view panel-refresh relative">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Statistika Transaksi Harian</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="statistic_permainan_bar" class="morris-chart" style="height:340px;"></div>
                                    <ul class="flex-stat mt-1" style="display: flex">
                                        <li>
                                            <span class="block"></span>
                                            <span class="block txt-dark weight-500 font-18">
                                                <span class="">
                                                </span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="block">Total</span>
                                            <span class="block txt-dark weight-500 font-18">Rp. 
                                                <span class="counter-anim">{{ number_format($pendapatan_rev_permainan_week) }}</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Statistika Transaksi</h6>
                                </div>
                                <a href="javascript:void(0)" class="pull-right inline-block full-screen mr-15"
                                    data-toggle="tooltip" title="Fullscreen">
                                    <i class="zmdi zmdi-fullscreen"></i>
                                </a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="statistic_permainan_line" class="morris-chart" style="d:293px;"></div>
                                    <ul class="flex-stat mt-1" style="display: flex">
                                        <li>
                                            <span class="block"></span>
                                            <span class="block txt-dark weight-500 font-18">
                                                <span class="">
                                                </span>
                                        </li>
                                        <li>
                                            <span class="block">Total </span>
                                            <span class="block txt-dark weight-500 font-18">Rp. <span
                                                    class="counter-anim">{{ $pendapatan_rev_permainan_year }}</span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h3>Total Revenue Hari ini</h3>Rp. {{ formatrupiah($pendapatan_revenue_today) }}
                        <h3>Total Revenue Permainan Hari ini</h3>Rp. {{ formatrupiah($pendapatan_revenue_default) }}
                        <h3>Total Revenue Fasilitas Hari ini</h3>Rp. {{ formatrupiah($pendapatan_revenue_additional) }}
                        <h3>Total Revenue Penjualan Produk Hari ini</h3>Rp. {{ formatrupiah($pendapatan_revenue_other) }}
                    </div>
                </div>
            </div>
            <!-- Footer -->
            @include('layouts.footer')
            <!-- /Footer -->
        </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            // fungsi grafik-line & Grafik-bar
            var dataMingguan = {!! json_encode($permainan_daily) !!}
            var dataNewPermainan = {!! json_encode($permainan) !!}
        </script>
    @endpush
@else
    <!DOCTYPE HTML>
    <html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="0; url=/scan-tamu">
        <script type="text/javascript">
            window.location.href = "/scan-tamu"
        </script>
    </head>

    <body>
        Halaman Tidak Ada <a href='/scan-tamu'>Kembali</a>.
    </body>

    </html>
@endif
