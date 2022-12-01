@extends('layouts.main', ['title' => 'TGCC | Scan Tamu'])
@section('content')
    <div class="page-wrapper intro-foo ">
        <div class="container-fluid">
            <div class="row heading-bg">
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Verifikasi</h5>
                        </div>
                        <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="javascript:void(0)">Dashboard</a></li>
                                <li class="active"><span>Verifikasi Scan</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="d-flex flex-column" data-title="Scan Tamu" data-intro="Panel ini merupakan panel proses verifikasi qr-code atau verifikasi no hp yang sudah terdaftar di tgcc.">
                        <div class="form-group d-flex justify-content-center">
                            <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                                <li class="active" role="presentation">
                                    <a class="tabs-log" aria-expanded="true" data-toggle="tab" role="tab" href="#qrcode">
                                        <input type="radio" name="status" id="radio_12" value="qr" style="visibility:hidden;">
                                        <label for="radio_12"></label>
                                        QR Code
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="tabs-log" data-toggle="tab" role="tab" href="#nohp" aria-expanded="false">
                                        <input type="radio" name="status" id="radio_12" value="hp" style="visibility:hidden;">
                                        <label for="radio_12"></label>
                                        Nomor Hp
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="qrcode" class="tab-pane fade active in" role="tabpanel">
                                <div class="panel-scan-qr d-flex justify-content-center align-items-center disabled-scan">
                                    <div class="d-flex flex-column ">
                                        <a href="javascript:void()" id="show-qr-scan" data-scan-status="STOP">
                                            <lottie-player src="{{ asset('dist/asset_offline/lf20_6SsPj1.json') }}" background="transparent" speed="1" style="width: 200px; height: 200px;" hover loop autoplay></lottie-player>
                                        </a>
                                    </div>
                                </div>
                                <div id="reader" class="disabled-show-scan"></div>
                            </div>
                            <div id="nohp" class="tab-pane fade" role="tabpanel">
                                <div class="panel-scan-qr d-flex justify-content-center align-items-center">
                                    <div class="input-group">
                                        <div class="input-group-addon">No Hp</div>
                                        <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" placeholder="Masukan Nomor Hp" id="verification-no-hp">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="setting_panel_btn" data-toggle="tooltip" title="Panduan" data-placement="left" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
            @include('layouts.footer')
        </div>
    </div>
    @endsection
@push('scripts')
    <script defer src="{{ asset('dist/asset_offline/lottie-player.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/scan_member.js') }}"></script>
    <script>
        $(document).on('click', '#setting_panel_btn', function() {
            introJs('.intro-foo').setOptions({
                'showProgress': true,
                'tooltipPosition': 'right'
            }).start();
        });
    </script>
    @endpush
