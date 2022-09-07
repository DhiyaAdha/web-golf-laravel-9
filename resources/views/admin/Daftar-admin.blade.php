    @extends('Layouts.Main')
    @section('content')
        <div class="page-wrapper">
            <div class="container-fluid">
                {{-- <div class="row heading-bg">
                    @include('Layouts.Breadcrumb')
                    <div class="row" style="padding: 20px 25px 1px 25px">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heding">
                                    <div class="row">
                                        <div class="col-lg-10 mt-15">
                                            <h6 style="margin-left: -20px;">Daftar Admin</h6>
                                        </div>
                                        <div class="col-lg-2 mt-10" style="text-align: end; padding: 5px 30px 0px 5px;">
                                            <a href="{{ route('tambah-admin') }}">
                                                <i class="fa-2x fa-plus" style="margin-right: 10px;"></i></a>
                                            <div class="row">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="table-wrap mt-40">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="dt-admin">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Nomer hp</th>
                                                            <th style="text-align: center;">Kategori Admin</th>
                                                            <th style="text-align: center;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 1px 25px">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-10 mt-15">
                                            <h6 style="margin-left: 20px;">history aktifitas</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-bodi">
                                        <div class="table-wrap mt-20">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="dt-admin">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">Role</th>
                                                            <th>Nama Admin</th>
                                                            <th>Informasi</th>
                                                            <th style="text-align: center;">Status</th>
                                                            <th style="text-align: center;">Tanggal</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('Layouts.Footer')
                </div> --}}

                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Daftar Admin</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="active"><span>Daftar Admin</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Daftar Paket</h6>
                                </div>
                                <div class="pull-right">
                                    <div class=" pull-left">
                                        <a href="{{ route('tambah-admin') }}" type="submit"
                                            class="btn btn-xs btn-success">Tambah admin</a>
                                    </div>
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
                    <!-- /Basic Table -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Riwayat Aktifitas</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
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
                    <!-- /Basic Table -->
                </div>
            </div>
        </div>
    @endsection
