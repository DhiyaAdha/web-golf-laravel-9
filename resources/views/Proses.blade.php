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
                <div class="col-lg-8">
                    <div class="panel panel-default card-view" style="height: 300px;">
                        <div class="form-group mt-10 ml-20">
                            <strong>Pilih Paket Bermain</strong>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="cb1">
                                <label for="cb1">One Games</label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="cb2">
                                <label for="cb2">Practice</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <strong>Pilih Item Tambahan</strong>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="cb3">
                                            <label for="cb3">Mobil 1 Cabine</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="cb4">
                                            <label for="cb4">Caddy</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="cb5">
                                            <label for="cb5">Additional 1</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="cb6">
                                            <label for="cb6">Mobil 2 Cabine</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="cb7">
                                            <label for="cb7">Sewa Tongkat</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="cb8">
                                            <label for="cb8">Additional 2</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view" style="height: 300px;">
                        <h5 style="text-align: center;" class="mt-15 mb-5"><strong>DAFTAR ORDER</strong></h5>
                        <div class="col-lg-6 mt-5">
                            <p style="color: #7D7D7D; text-align:left;" class="ml-12">Product</p>
                        </div>
                        <div class="col-lg-6 mt-5">
                            <p style="color: #7D7D7D; text-align:end;">Sub-Total</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr class="h">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-5">
                                <p style="color: #7D7D7D; text-align:start;">One Game</p>
                            </div>
                            <div class="col-lg-6 mt-5">
                                <p style="color: #7D7D7D; text-align:end;">Rp. 1.000.000</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr class="h">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-5">
                                <p style="text-align:start;"><strong>Total</strong></p>
                            </div>
                            <div class="col-lg-6 mt-5">
                                <p style="text-align:end;">Rp. 1.000.000</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-proses">
                                    <a href="/proses">
                                        <h6 style="color: #ffffff;">Checkout</h6>
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
