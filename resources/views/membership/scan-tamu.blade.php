@extends('layouts.main', ['title' => 'TGCC | Scan Tamu'])
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
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
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <div class="form-group d-flex justify-content-center">
                            <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                                <li class="active" role="presentation">
                                    <a class="tabs-log" aria-expanded="true" data-toggle="tab" role="tab" href="#qrcode">
                                        <input type="radio" name="status" id="radio_12" value="qr" style="visibility:hidden;">
                                        <label for="radio_12"></label>
                                        Verifikasi QR Code
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="tabs-log" data-toggle="tab" role="tab" href="#nohp" aria-expanded="false">
                                        <input type="radio" name="status" id="radio_12" value="hp" style="visibility:hidden;">
                                        <label for="radio_12"></label>
                                        Verifikasi Kode Member
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
                                        <div class="input-group-addon">Kode</div>
                                        <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" placeholder="Masukan Kode Member" id="verification-no-hp">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @endsection
@push('scripts')
    <script defer src="{{ asset('dist/asset_offline/lottie-player.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/scan_member.js') }}"></script>
@endpush
