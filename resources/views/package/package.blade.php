@extends('layouts.main', ['title' => 'TGCC | Paket Bermain'])
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid" data-title="Halaman Daftar Paket" data-intro="Halaman ini memberikan informasi seluruh data paket yang tersedia.">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Paket</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar paket</span></li>
                    </ol>
                </div>
            </div>
            <div class="row" >
                <div class="col-sm-12"  >
                    <div class="panel panel-default card-view">
                        <div class="panel-heading" >
                            <div class="pull-left" >
                                <a href="{{ route('package.create') }}" type="submit" class="btn btn-xs btn-success" data-title="Tambah Paket" data-intro="Klik tombol ini untuk mengarahkan ke halaman tambah paket tgcc">Tambah Paket</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('export_excel_package') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel" data-title="Download Paket" data-intro="Klik icon ini untuk mendownload file excel yang berisi semua data paket yang tersedia pada tabel.">
                                    <img src="{{ asset('dist/img/excel.svg') }}" width="25px" height="25px">
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap" data-title="Daftar Paket" data-intro="Tabel ini menampilkan seluruh data paket di tgcc, diantaranya adalah berisi informasi nama-produk, kategori paket, harga paket weekdays(senin sd.jumat), harga paket weekend(sabtu & minggu), status paket aktif atau nonaktif, opsi edit dan hapus paket.">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-package" >
                                            <thead >
                                                <tr data-title="Daftar Paket" >
                                                    <th class="table-th">nama paket</th>
                                                    <th class="table-th">kategori</th>
                                                    <th class="table-th">senin</th>
                                                    <th class="table-th">selasa-jumat</th>
                                                    <th class="table-th">sabtu-minggu</th>
                                                    <th class="table-th">status</th>
                                                    <th class="table-th">opsi</th>
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
    <script defer src="{{ asset('dist/asset_offline/list_package.js') }}"></script>
@endpush
