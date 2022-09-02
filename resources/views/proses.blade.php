@extends('Layouts.main', ['title' => 'TGCC | Proses'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Proses Invoice</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>Proses</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
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
                                <button id="decrement" onclick="stepper(this)">-</button>
                                <input type="number" min="0" max="100" step="1" value="0"
                                    id="my-input" readonly>
                                <button id="increment" onclick="stepper(this)">+</button>
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
                                @foreach ($package as $data)
                                    <p style="color: #7D7D7D; text-align:start;">
                                        {{ $data->name }} <hr>
                                    </p>
                                @endforeach
                            </div>
                            <div class="col-lg-6 mt-5">
                                @foreach ($package as $data)
                                <p style="color: #7D7D7D; text-align:end;">Rp. {{ formatrupiah($data->price_weekdays) }} <hr>
                                </p>
                                @endforeach
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
                                <p style="text-align:end;">Rp. 1.000.000,00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-10">
                                <div class="btn-proses">
                                    <a href="/metode_pembayaran">
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
