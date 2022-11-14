@extends('layouts.main', ['title' => 'TGCC | Paket Bermain'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Daftar Paket</h6>
                            </div>
                            <div class="pull-right">
                                <div class=" pull-left">
                                    <a href="{{ route('package.create') }}" type="submit" class="btn btn-xs btn-success">Tambah Paket</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="dt-package">
                                            <thead>
                                                <tr>
                                                    <th class="table-th">Nama Produk</th>
                                                    <th class="table-th">Kategori</th>
                                                    <th class="table-th">Harga Weekdays</th>
                                                    <th class="table-th">Harga Weekend</th>
                                                    <th class="table-th">Status</th>
                                                    <th class="table-th">Opsi</th>
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
            @include('layouts.footer')
        </div>
    </div>
@endsection
@push('scripts')
    <script defer src="{{ asset('dist/asset_offline/list_package.js') }}"></script>
@endpush
