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
                <div class="row d-flex justify-content-center">
                    <input type="text" class="col-lg-12" id="resultTEXT">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
                    type: 'POST',
                    url: "{{ route('visitor.qrcode') }}",
                    data: {
                        email: decodedText
                    },
                    dataType: 'json',
                    success: function(response) {
                        // if (response.status === "VALID") {
                        //     swal({
                        //         title: "Verifikasi berhasil",
                        //         type: "success",
                        //         text: "Atas nama " + response.data.name,
                        //         confirmButtonColor: "#01c853",
                        //         closeOnConfirm: false,
                        //         closeOnCancel: false,
                        //         showCancelButton: false,
                        //         showConfirmButton: false,
                        //         timer: 2000,
                        //     }, function() {
                        //         window.location.href = "/detail_scan/" + response.data.id;
                        //     });
                        // } else {
                        //     swal({
                        //         icon: 'error',
                        //         title: response.status,
                        //         text: response.message,
                        //         allowOutsideClick: false
                        //     }, function() {
                        //         window.location.reload(true)
                        //     });
                        // }
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
    </script>
@endpush
