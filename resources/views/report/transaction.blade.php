@extends('layouts.main', ['title' => 'TGCC | Laporan Laba Permainan'])
@section('content')
    <div class="page-wrapper intro-foo" >
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Rincian Laporan Permainan</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Permainan</span></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12"  >
                    <div class="panel panel-default card-view" data-title="Halaman Daftar Paket" data-intro="Halaman ini memberikan informasi seluruh data paket yang tersedia. ">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <div class="d-flex">
                                    <span class="mr-5" style="right: 420px; top: 27px; position: responsive; margin-top: 4px;">Filter waktu</span>
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-all" name="time">
                                            <option selected disabled>Pilih waktu</option>
                                            <option value="today">Hari ini</option>
                                            <option value="week">Minggu lalu</option>
                                            <option value="month">Bulan lalu</option>
                                            <option value="year">Tahun lalu</option>
                                        </select>
                                    </div>	
                                    <a href="{{ url('export_excel_package') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel" data-title="Download Paket" data-intro="Icon ini digunakan untuk download seluruh data paket yang tersedia di tgcc dalam bentuk data excel">
                                        <img src="{{ asset('dist/img/excel.svg') }}" width="25px" height="25px">
                                    </a>
                                </div>
                            </div>
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">daftar semua transaksi</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap" data-title="Daftar Paket" data-intro="Panel ini menampilkan seluruh data paket di tgcc. berisi informasi nama-produk, kategori paket, harga paket weekdays(senin sd.jumat), harga paket weekend(sabtu & minggu), status paket aktif atau nonaktif, opsi edit dan hapus paket">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-report-all">
                                            <thead >
                                                <tr data-title="Daftar Paket" >
                                                    <th class="table-th">nama Permainan</th>
                                                    <th class="table-th">qty</th>
                                                    <th class="table-th">harga satuan</th>
                                                    <th class="table-th">total tagihan</th>
                                                    <th class="table-th">Tanggal pemesanan</th>
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

            <div class="row">
                <div class="col-sm-12"  >
                    <div class="panel panel-default card-view" data-title="Halaman Daftar Paket" data-intro="Halaman ini memberikan informasi seluruh data paket yang tersedia. ">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <div class="d-flex">
                                    <span class="mr-5" style="right: 420px; top: 27px; position: responsive; margin-top: 4px;">Filter waktu</span>
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-games" name="time">
                                            <option selected disabled>Pilih waktu</option>
                                            <option value="today">Hari ini</option>
                                            <option value="week">Minggu lalu</option>
                                            <option value="month">Bulan lalu</option>
                                            <option value="year">Tahun lalu</option>
                                        </select>
                                    </div>	
                                    <a href="{{ url('export_excel_package') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel" data-title="Download Paket" data-intro="Icon ini digunakan untuk download seluruh data paket yang tersedia di tgcc dalam bentuk data excel">
                                        <img src="{{ asset('dist/img/excel.svg') }}" width="25px" height="25px">
                                    </a>
                                </div>
                            </div>
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">daftar transaksi permainan</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap" data-title="Daftar Paket" data-intro="Panel ini menampilkan seluruh data paket di tgcc. berisi informasi nama-produk, kategori paket, harga paket weekdays(senin sd.jumat), harga paket weekend(sabtu & minggu), status paket aktif atau nonaktif, opsi edit dan hapus paket">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-report-games">
                                            <thead >
                                                <tr data-title="Daftar Paket" >
                                                    <th class="table-th">nama Permainan</th>
                                                    <th class="table-th">qty</th>
                                                    <th class="table-th">harga satuan</th>
                                                    <th class="table-th">total tagihan</th>
                                                    <th class="table-th">Tanggal pemesanan</th>
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

            <div class="row">
                <div class="col-sm-12"  >
                    <div class="panel panel-default card-view" data-title="Halaman Daftar Paket" data-intro="Halaman ini memberikan informasi seluruh data paket yang tersedia. ">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <div class="d-flex">
                                    <span class="mr-5" style="right: 420px; top: 27px; position: responsive; margin-top: 4px;">Filter waktu</span>
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-proshop" name="time">
                                            <option selected disabled>Pilih waktu</option>
                                            <option value="today">Hari ini</option>
                                            <option value="week">Minggu lalu</option>
                                            <option value="month">Bulan lalu</option>
                                            <option value="year">Tahun lalu</option>
                                        </select>
                                    </div>	
                                    <a href="{{ url('export_excel_package') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel" data-title="Download Paket" data-intro="Icon ini digunakan untuk download seluruh data paket yang tersedia di tgcc dalam bentuk data excel">
                                        <img src="{{ asset('dist/img/excel.svg') }}" width="25px" height="25px">
                                    </a>
                                </div>
                            </div>
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">daftar transaksi proshop dan fasilitas</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap" data-title="Daftar Paket" data-intro="Panel ini menampilkan seluruh data paket di tgcc. berisi informasi nama-produk, kategori paket, harga paket weekdays(senin sd.jumat), harga paket weekend(sabtu & minggu), status paket aktif atau nonaktif, opsi edit dan hapus paket">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-report-proshop">
                                            <thead >
                                                <tr data-title="Daftar Paket" >
                                                    <th class="table-th">nama Permainan</th>
                                                    <th class="table-th">qty</th>
                                                    <th class="table-th">harga satuan</th>
                                                    <th class="table-th">total tagihan</th>
                                                    <th class="table-th">Tanggal pemesanan</th>
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

            <div class="row">
                <div class="col-sm-12"  >
                    <div class="panel panel-default card-view" data-title="Halaman Daftar Paket" data-intro="Halaman ini memberikan informasi seluruh data paket yang tersedia. ">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <div class="d-flex">
                                    <span class="mr-5" style="right: 420px; top: 27px; position: responsive; margin-top: 4px;">Filter waktu</span>
                                    <div class="form-group mr-5">
                                        <select class="form-control" style="height: 32px" id="filter-canteen" name="time">
                                            <option selected disabled>Pilih waktu</option>
                                            <option value="today">Hari ini</option>
                                            <option value="week">Minggu lalu</option>
                                            <option value="month">Bulan lalu</option>
                                            <option value="year">Tahun lalu</option>
                                        </select>
                                    </div>	
                                    <a href="{{ url('export_excel_package') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel" data-title="Download Paket" data-intro="Icon ini digunakan untuk download seluruh data paket yang tersedia di tgcc dalam bentuk data excel">
                                        <img src="{{ asset('dist/img/excel.svg') }}" width="25px" height="25px">
                                    </a>
                                </div>
                            </div>
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">daftar penjualan kantin</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap" data-title="Daftar Paket" data-intro="Panel ini menampilkan seluruh data paket di tgcc. berisi informasi nama-produk, kategori paket, harga paket weekdays(senin sd.jumat), harga paket weekend(sabtu & minggu), status paket aktif atau nonaktif, opsi edit dan hapus paket">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-report-canteen">
                                            <thead >
                                                <tr data-title="Daftar Paket" >
                                                    <th class="table-th">nama Permainan</th>
                                                    <th class="table-th">qty</th>
                                                    <th class="table-th">harga satuan</th>
                                                    <th class="table-th">total tagihan</th>
                                                    <th class="table-th">Tanggal pemesanan</th>
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
            <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script defer src="{{ asset('dist/asset_offline/list_report_games.js') }}"></script>
    <script src="{{ asset('/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
