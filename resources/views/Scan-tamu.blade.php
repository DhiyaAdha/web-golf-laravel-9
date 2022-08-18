@extends('Layouts.Main')

@section('content')
    {{-- Script --}}
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    {{-- Script --}}

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
                        <div id="reader" width="600px" class="mt-10"></div>
                        <script>
                            function onScanSuccess(decodedText, decodedResult) {
                                // handle the scanned code as you like, for example:
                                // console.log(`Code matched = ${decodedText}`, decodedResult);
                                $("#result").val(decodedText)
                            }

                            function onScanFailure(error) {
                                // handle scan failure, usually better to ignore and keep scanning.
                                // for example:
                                console.warn(`Code scan error = ${error}`);
                            }

                            let html5QrcodeScanner = new Html5QrcodeScanner(
                                "reader", {
                                    fps: 10,
                                    qrbox: {
                                        width: 250,
                                        height: 250
                                    }
                                },
                                /* verbose= */
                                false);
                            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                        </script>
                        {{-- <div class="kotak bg-white mt-10">
                            <div class="gambar-qr">
                                <img src="/dist/img/qr.png" alt="" width="100px">
                                <a href="">
                                    <div class="btn-qr" style="text-align:center;">Scan QR</div>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" id="result" size="50px">
                </div>
            </div>
        </div>
    </div>
@endsection
