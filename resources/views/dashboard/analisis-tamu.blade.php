@extends('layouts.main', ['title' => 'TGCC | Analisis Tamu'])
@push('css')
    <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid pt-25" data-title="Halaman Analisis Tamu" data-intro="Halaman ini memberikan informasi transaksi jumlah pengunjung yang datang di tgcc">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box today" style="background-color:#01C853;" data-title="Jumlah Pengunjung Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung yang sudah melakukan transaksi pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">
                                                    <span class="counter-anim">{{ $visitor_today }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Transaksi <br> Hari ini</span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box vvip" data-title="Jumlah Pengunjung VIP Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung VIP yang sudah melakukan transaksi pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">
                                                    <span class="counter-anim">{{ $visitor_vvip }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Transaksi VIP <br> Hari Ini</span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box vip" data-title="Jumlah Pengunjung Member Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung Member yang sudah melakukan transaksi pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">
                                                    <span class="counter-anim">{{ $visitor_vip }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Transaksi Member <br> Hari Ini </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box reguler" data-title="Jumlah Pengunjung Non Member Hari Ini" data-intro="Panel ini memberikan informasi total keseluruhan pengunjung Umum yang sudah melakukan transaksi pada hari ini.">
                                    <div class="container-fluid">
                                        <div class="row p-2">
                                            <div class="col-xs-8 text-left data-wrap-left">
                                                <span class="txt-light block counter">
                                                    <span class="counter-anim">{{ $visitor_reguler }}</span>
                                                </span>
                                                <span class="weight-500 txt-light block">Transaksi Reguler <br> Hari Ini </span>
                                            </div>
                                            <div class="col-xs-4 text-right data-wrap-right">
                                                <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                            </div>
                                            <img src="{{ asset('/img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view panel-refresh relative" data-title="Pengunjung 7 Hari Terakhir" data-intro="Panel ini berbentuk bar chart dan bersifat data objektif dinamis memberikan informasi jumlah pengunjung setiap hari dalam kurun waktu satu minggu terakhir.">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Statistika Pengunjung 7 Hari Terakhir</h6>
                            </div>
                            <div class="pull-right">
                                <div class="d-flex align-items-center">
                                    <div id="visitor_week" class="bar-chart-legend"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="statistic_visitor_bar" class="morris-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default card-view" data-title="Pengunjung 12 Bulan Terakhir" data-intro="Panel ini berbentuk line chart dan bersifat data objektif dinamis memberikan informasi jumlah pengunjung setiap bulan dalam kurun waktu satu tahun terakhir.">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Statistika Pengunjung 12 Bulan Terakhir</h6>
                            </div>
                            <div class="pull-right">
                                <div class="d-flex align-items-center">
                                    <div id="visitor_month" class="bar-chart-legend"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="statistic_visitor_line" class="morris-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default card-view" data-title="Kategori Pengunjung 12 Bulan Terakhir" data-intro="Panel ini berbentuk line chart dan bersifat data objektif dinamis memberikan informasi jumlah kategori pengunjung VIP/Member setiap bulan dalam kurun waktu satu tahun terakhir.">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Kategori Pengunjung 12 Bulan Terakhir</h6>
                            </div>
                            <div class="pull-right">
                                <div class="d-flex align-items-center">
                                    <div id="visitor_legend" class="bar-chart-legend"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="bar-chart" height="200"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view" data-title="Tabel Daftar Nama Terakhir Berkunjung" data-intro="Panel ini menampilkan seluruh data membership tgcc dan data pada tabel diurutkan berdasarkan tanggal terakhir member yang berkunjung ke tgcc.">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-filter-two" data-title="Unduh Laporan Transaksi" data-intro="Klik tombol ini untuk memunculkan popup. Admin dapat mengunduh laporan pengunjung dengan filter tahun. kemudian klik tombol unduh.">Laporan Tamu</button>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-filter" data-title="Unduh Laporan Transaksi" data-intro="Klik tombol ini untuk memunculkan popup. Admin dapat mengunduh laporan transaksi dengan filter kategori paket dan pilih tanggal. kemudian klik tombol unduh.">Laporan Transaksi</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-analisis">
                                            <thead>
                                                <tr>
                                                    <th class="">NAMA TAMU</th>
                                                    <th class="">Kategori</th>
                                                    <th class="">JENIS MEMBER</th>
                                                    <th class="table-th">PUKUL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
        @include('layouts.footer')
    </div>
    </div>
    <div id="modal-filter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Unduh Laporan Transaksi</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('export-analisis-tamu')}}" method="POST">
                        @csrf
                        <input type="hidden" name="daterange"/>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Jenis kategori paket</label>
                                    <select class="form-control" name="category" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                        <option value="all">- Semua -</option>
                                        @foreach ($category as $value)
                                            <option value="{{$value}}">{{ $value == 'default' ? 'Permainan' : ($value == 'additional' ? 'Proshop & Fasilitas' : ($value == 'others' ? 'Kantin' : ($value == 'rental' ? 'Sewa' : 'Service Fee')))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="pull-right">
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="">Tanggal</label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                                <span class="mr-5"><i class="fa fa-calendar"></i> Date range picker</span>
                                                <i class="fa fa-caret-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success download">Unduh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-filter-two" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Unduh Laporan Tamu</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('export-laporan-tahunan')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="">Pilih tahun</label>
                                    <select class="form-control" name="year" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                        @foreach ($years as $row)
                                            <option value="{{$row}}">{{$row}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success download-visitor" type="submit">Unduh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script defer src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script defer src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script defer src="{{ asset('/dist/js/dashboard-data.js') }}"></script>
@endpush