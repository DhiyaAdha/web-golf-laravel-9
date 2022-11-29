@extends('layouts.main', ['title' => 'TGCC | Daftar Admin'])
@section('content')
    <div class="page-wrapper intro-foo">
        <div class="container-fluid" data-title="Daftar Admin" data-intro="Halaman ini memberikan informasi data kasir yang memiliki akses aplikasi, dan mencatat segala aktifitas kasir yang sedang online. ">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar Admin</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('daftar-admin') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar Admin</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" >
                    <div class="panel panel-default card-view" data-title="Daftar Admin" data-intro="Panel ini memberikan informasi daftar kasir yang memiliki akses aplikasi." >
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Daftar Admin</h6>
                            </div>
                            <div class="pull-right" data-title="Tambah Admin" data-intro="panel ini merupakan panel untuk menambah daftar data kasir baru. kasir dibedakan 2 jenis, Admin dan Super Admin.">
                                <a href="{{ route('tambah-admin') }}" class="btn btn-xs btn-success">Tambah Admin</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" id="dt-admin">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Nomer hp</th>
                                                    <th>Kategori Admin</th>
                                                    <th>Aksi</th>
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
                <div class="col-sm-12">
                    <div class="panel panel-default card-view" data-title="Riwayat aktifitas" data-intro="Panel ini merekam riwayat aktifitas admin dan super admin. ditampilkan dalam bentuk tabel sesuai nama, informasi, status dan kategori.">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover" id="dt-aktifitas">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Nama</th>
                                                    <th>Informasi</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
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
    <script defer src="{{ asset('dist/asset_offline/admin_list.js') }}">
    </script>
    <script>
        $(document).on('click', '#setting_panel_btn', function() {
            introJs('.intro-foo').setOptions({
                'showProgress': true,
                'tooltipPosition': 'right'
            }).start();
        });
    </script>
@endpush
