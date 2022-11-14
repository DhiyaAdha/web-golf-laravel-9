@extends('layouts.main', ['title' => 'TGCC | Invoice'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Daftar invoice</h5>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('analisis-tamu') }}">Dashboard</a></li>
                        <li class="active"><span>Daftar invoice</span></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="pull-right">
                            <a href="{{ url('export_excel') }}" target="_blank" name="excel" data-toggle="tooltip" data-placement="top" title="Download Excel"><img src="dist/img/excel2.svg" width="25px" height="25px"></a>
                        </div>
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Invoice</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="dt-riwayat">
                                            <thead>
                                                <tr>
                                                    <th class="">Nama</th>
                                                    <th class="">Jenis Member</th>
                                                    <th class="">Metode Pembayaran</th>
                                                    <th class="">Total Bayar</th>
                                                    <th class="">Tanggal Bayar</th>
                                                    <th class="">Action</th>
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
        @include('layouts.footer')
    </div>
@endsection
@push('scripts')
    <script defer src="{{ asset('dist/asset_offline/list_invoice.js') }}"></script>
@endpush