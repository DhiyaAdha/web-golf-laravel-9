@extends('layouts.main')
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
                    <div class="panel panel-default card-view" style="height: 600px;">
                        <strong>
                            <p class="mb-10 mt-10">Sisa Deposit / Limit</p>
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
                                        <div class="col-lg-6 col-md-3 col-sm-3 col-xs-3">
                                            <h4 style="text-align:start; font-weight:500; color:white;">Rp</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-sm-3 col-xs-3">
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
                        <div class="row">
                            <div class="col-lg-3">
                                <p style="text" class="ml-10">Item</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Harga</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Jumlah</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Total</p>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-3">
                                <p style="text" class="ml-10">Hole</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Rp 500.000</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">2</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Rp. 100.000</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr class="h">
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10" style="text-align:center;">Sub Total</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Rp. 100.000</p>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10" style="text-align:center;">Deposit</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="ml-10">Rp. -100.000</p>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                                <h5 class="ml-10" style="text-align:center;">Total Bayar</h5>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="ml-10">Rp. -</h5>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                                <div class="btn-print">
                                    <a href="/proses">
                                        <p>Kembali</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="btn-selesai">
                                    <a href="/riwayat-invoice">
                                        <p style="color: white">Proses</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
