@extends('Layouts.Main', ['title' => 'TGCC | Scan Tamu'])

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                @include('Layouts.Breadcrumb')
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8" style="position: relative;">
                    <div style="height: 300px" class="panel panel-default card-view">
                        <h6>Data Pengunjung</h6>
                        <div class="col-sm-12">
                            <div class="panel-body">
                                <p class="mt-500"
                                    style="text-align: center; color:gray; position:absolute; top:100px; left:350px;">Tidak
                                    ada data</p>
                            </div>
                            </ </div>
                            <!-- /Basic Table -->
                        </div>

                        <div class="row">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="height: 300px" class="panel panel-default card-view">
                        <h6>Data Pengunjung</h6>
                        <div class="kotak bg-white mt-10">
                            <div class="gambar-qr">
                                <div class="disabled-scan">
                                    <img src="/dist/img/qr.png" alt="" width="100px">
                                    <button type="button" id="show-scan" style="text-align:center;">Scan QR</button>
                                </div>
                                <div id="reader" width="600px" class="mt-10"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <input type="text" id="result" size="30px">
            </div>
        </div>
    </div>
    </div>
@endsection
