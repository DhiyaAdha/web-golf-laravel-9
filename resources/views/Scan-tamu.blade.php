@extends('Layouts.Main', ['title' => 'TGCC | Scan Tamu'])

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                {{-- @include('Layouts.Breadcrumb') --}}
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Scan Tamu</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>scan tamu</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8" style="position: relative;">
                    <div style="height: 300px" class="panel panel-default card-view">
                        <h6>Data Pengunjung</h6>
                        <div class="col-sm-12">
                            <div class="panel-body">
                                {{-- <p class="ct-txt mt-500"
                                    style="text-align: center; color:gray; position:absolute; top:100px; left:350px;">
                                    Tidak
                                    ada data</p> --}}
                                <div class="ct-txt">
                                    <p>Tidak ada data</p>
                                </div>
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
                            <div id="reader" width="600px" class=""></div>
                            <div class="gambar-qr">
                                <div class="disabled-scan ">
                                    <img src="/dist/img/qr.png" class="ml-20">
                                    <div class="btn-scan mt-10">
                                        {{-- <button type="button" id="show-scan" style="text-align:center;">Scan QR</button> --}}
                                        <div class="btn-scan-qr">
                                            <a href="#" id="show-scan">
                                                <p>Scan Barcode</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <p>Hasil Scan</p>
                        <input type="text" id="result" size="30px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- //hello -->
