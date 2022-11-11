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
                                            <script src="{{ asset('dist/asset_offline/lottie-player.js') }}"></script>
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
    <script src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
@endsection
@push('scripts')
    <script>
        function sword() {
            var audio = new Audio('../sound/sword.mp3');
            audio.play();
        }

        $('#show-qr-scan').on('click', function() {
            $('.disabled-scan').addClass('d-none');
            function onScanSuccess(decodedText, decodedResult) {
                $("#resultTEXT").val(decodedText)
                $('#resultDECODE').val(JSON.stringify(decodedResult));
                html5QrcodeScanner.clear();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "{{ route('visitor.qrcode') }}",
                    data: {
                        qrCode: decodedText
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === "VALID") {
                            swal({
                                title: "Verifikasi berhasil",
                                type: "success",
                                text: "Atas nama " + response.data.name,
                                confirmButtonColor: "#01c853",
                                closeOnConfirm: false,
                                closeOnCancel: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 2000,
                            }, function() {
                                window.location.href = decodedText;
                            });
                        } else {
                            sword();
                            swal({
                                title: "",
                                type: "error",
                                text: response.message,
                                confirmButtonColor: "#01c853",
                            }, function() {
                                window.location.reload(true)
                            });
                        }
                    }
                });
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 144,
                    qrbox: {
                        width: 200,
                        height: 200
                    }
                },
                true);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });

        $('#verification-no-hp').keypress(function(e) {
            if (e.which == 13) {
                swal({
                    title: "",
                    text: "Verifikasi Kode Member?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#01c853",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            data: {
                                phone: $('#verification-no-hp').val()
                            },
                            url: "{{ route('visitor.phone') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr(
                                        'content')
                            },
                            beforeSend: function(request) {
                                $.blockUI({
                                    css: {
                                        backgroundColor: 'transparent',
                                        border: 'none'
                                    },
                                    message: '<img src="../img/rolling.svg">',
                                    baseZ: 1500,
                                    overlayCSS: {
                                        backgroundColor: '#7C7C7C',
                                        opacity: 0.4,
                                        cursor: 'wait'
                                    }
                                });
                            },
                            success: function(response) {
                                $.unblockUI();
                                if (response.status == "INVALID") {
                                    sword();
                                    swal({
                                        title: "",
                                        type: "error",
                                        text: response.message,
                                        confirmButtonColor: "#01c853",
                                    });
                                } else {
                                    swal({
                                        title: '',
                                        type: "success",
                                        text: response.message,
                                        confirmButtonColor: "#01c853",
                                    }, function(isConfirm) {
                                        window.location.href = response.data.unique_qr;
                                    });
                                }
                            }
                        });
                    } else {
                        swal("Dibatalkan", "", "info");
                    }
                });
            }
        })
    </script>
@endpush
