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
                <div class="col-12 d-flex justify-content-center">
                    <div class="panel-scan-qr d-flex justify-content-center align-items-center disabled-scan">
                        <div class="d-flex flex-column ">
                            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_6SsPj1.json"
                                background="transparent" speed="1" style="width: 200px; height: 200px;" hover loop
                                autoplay></lottie-player>
                            <p class="text-center txt-dark mt-20">Scan Barcode</p>
                            <button id="show-qr-scan" data-scan-status="STOP" class="btn btn-primary" type="button">
                                Mulai Scan
                            </button>
                        </div>
                    </div>
                    <div id="reader" class="disabled-show-scan">
                    </div>
                </div>
                {{-- <div class="col-lg-8" style="position: relative;">
                    <div style="height: 300px" class="panel panel-default card-view">
                        <h6>Data Pengunjung</h6>
                        <div class="col-sm-12">
                            <div class="panel-body">
                                <div class="ct-txt">
                                    <p>Tidak ada data</p>
                                </div>
                            </div>
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
                </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>Hasil Scan</p>
                <input type="text" id="resultTEXT" size="30px">
            </div>
            <div class="col-lg-12">
                <p>Hasil Scan</p>
                <input type="text" id="resultDECODE" size="30px">
            </div>
        </div>
    </div>
    <!-- Modal:start -->
    <div class="modal fade" id="modalConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">User Verification</h5>
                    <button id="closeButton" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Name</th>
                            <th>:</th>
                            <td class="text-left">
                                <label id="labelName"></label>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td class="text-left">
                                <label id="labelEmail"></label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button id="cancelButton" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button id="confirmationButton" type="button" class="btn btn-primary">
                        Confirmation
                        <div id="progressBar" class="spinner-border spinner-border-sm d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal:end -->
@endsection
