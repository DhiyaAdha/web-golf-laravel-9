@extends('Layouts.main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                @include('Layouts.Breadcrumb')
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view" style="height: 500px;">
                        <strong>
                            <p class="mb-10">Sisa Deposit / Limit</p>
                        </strong>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="label-pembayaran-hijau">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="color:white;">Deposit</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-3 col-sm-3">
                                            <h4 style="text-align:start; font-weight:500; color:white;">Rp</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-3">
                                            <h4 style="text-align:right; font-weight:500; color:white;">12.000.000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="label-pembayaran-hitam">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="color:white;">Limit Kupon</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-3 col-sm-3">
                                            <h4 style="text-align:start; font-weight:500; color:white;">0</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-3">
                                            <h4 style="text-align:right; font-weight:500; color:white;"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="label-pembayaran-hitam">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="color:white;">Limit Bulanan</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-3 col-sm-3">
                                            <h4 style="text-align:start; font-weight:500; color:white;">2</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-3">
                                            <h4 style="text-align:right; font-weight:500; color:white;"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-15">
                                <strong>
                                    <p class="mb-10">Sisa Deposit / Limit</p>
                                </strong>
                                <div class="form-group">
                                    <select class="form-control select2">
                                        <option>Pilih Metode Pembayaran</option>
                                        <option>Limit Bulanan</option>
                                        <option>Limit Bulanan Kupon</option>
                                        <option>Cash / Transfer</option>
                                        <option>Deposit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
