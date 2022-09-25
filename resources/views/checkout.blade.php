<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $order_number }}</title>
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.PNG') }}">
    <link rel="icon" href="{{ asset('tgcc144.PNG') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .panel-green {
            background-color: #01c853;
            color: #fff;
            border-radius: 4px
        }

        .panel-black {
            background-color: #000000;
            color: #fff;
            border-radius: 4px
        }

        .text-big {
            font-size: 16px;
            font-weight: bold;
        }

        .pd-1 {
            padding: 1rem 0;
        }

        .font-weight-bold {
            padding: 0px 15px;
        }

        .table td,
        .table th {
            border-top: none !important;
        }

        .table th {
            border-top: 1px solid #dee2e6 !important;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #fff;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb:vertical {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="margin: 1rem 0;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="d-flex">
                            <span class="font-weight-bold flex-grow-1"><i class="fa fa-money"></i> Bayar
                                Billing :
                                #{{ $order_number }}</span>
                            <span class="font-weight-bold"> Tamu : {{ $visitor->name }}</span>
                        </div>
                        <div class="d-flex flex-wrap pd-1">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body panel-green">
                                        <div class="d-flex-flex-column">
                                            <span class="text-capitalize">deposit</span>
                                            <div class="d-flex">
                                                <span class="flex-grow-1 text-big">Rp</span>
                                                <span class=" text-big"
                                                    id="balance">{{ formatrupiah($deposit->balance) ?? '0' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body panel-black">
                                        <div class="d-flex-flex-column">
                                            <span class="text-capitalize">Limit Kupon</span>
                                            <div class="d-flex">
                                                <span class=" text-big"
                                                    id="kupon">{{ $log_limit->quota_kupon ?? '0' }}</span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body panel-black">
                                        <div class="d-flex-flex-column">
                                            <span class="text-capitalize">Limit Bulanan</span>
                                            <div class="d-flex">
                                                <span class="text-big"
                                                    id="limit">{{ $log_limit->quota ?? '0' }}</span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap pd-1">
                            <div class="col-md-7">
                                <form>
                                    <div class="form-group">
                                        <label for="payment-type">Pilih jenis pembayaran</label>
                                        <select class="form-control" id="payment-type">
                                            <option value="" disabled selected>Jenis pembayaran</option>
                                            <option value="1">Limit Bulanan</option>
                                            <option value="2">Limit Kupon</option>
                                            <option value="3">Cash/Transfer</option>
                                            <option value="4">Deposit</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="cash-transfer"></div>

                                    <div class="d-flex justify-content-start pd-1">
                                        <a href="javascript:void(0)" id="print"
                                            class="d-flex align-items-center btn btn-sm btn-primary mr-2"><i
                                                class="fa fa-print mr-2"></i> Invoice</a>
                                        <a href="javascript:void(0)" id="pay"
                                            class="btn btn-sm btn-success">Bayar</a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex-flex-column">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Jumlah order</span>
                                            <span>{{ count($orders) }}</span>
                                        </div>
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Total bayar</span>
                                            <span>Rp. {{ formatrupiah($totalPrice) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            function formatIDR(price) {
                var number_string = price.toString(),
                    split = number_string.split(','),
                    remainder = split[0].length % 3,
                    idr = split[0].substr(0, remainder),
                    thousand = split[0].substr(remainder).match(/\d{1,3}/gi);
                if (thousand) {
                    separator = remainder ? '.' : '';
                    idr += separator + thousand.join('.');
                }
                return split[1] != undefined ? idr + ',' + split[1] : idr;
            }

            $(document).on('change', '#payment-type', function(e) {
                e.preventDefault();
                let type = $(this).val();
                var tg = window.location.href;
                tg = tg.split("?")
                tg = tg[0];
                tg = tg.split("/");
                page = tg[tg.length - 1];

                if (type == 3) {
                    $('#cash-transfer').html(
                        `<label for="cash">Pembayaran cash</label>
                                            <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" id="cash" placeholder="masukan jumlah nominal pembayaran">`
                    ).show();
                } else {
                    $('#cash-transfer').html(
                        `<label for="cash">Pembayaran cash</label>
                                            <input type="text" min="0" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" id="cash" placeholder="masukan jumlah nominal pembayaran">`
                    ).hide();
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    async: true,
                    type: 'GET',
                    data: {
                        type: type,
                        param: page
                    },
                    url: "{{ route('select.type') }}",
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
                        $('#balance').text(formatIDR(response.price));
                        $('#kupon').text(formatIDR(parseInt(response.kupon)));
                        $('#limit').text(formatIDR(parseInt(response.limit)));
                        $.toast({
                            text: response.VALID,
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 1000,
                        });
                    },
                    error: function(request, error) {
                        if (response.status == "INVALID") {
                            $.toast({
                                heading: 'Opps! somthing wents wrong',
                                text: 'Use the predefined ones, or specify a custom position object.',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'error',
                                hideAfter: 3500
                            });
                            return false;
                        }
                    }
                });
            });
            $(document).on('click', '#pay', function() {
                let error = false;
                const type = $('#payment-type').val();
                if (!error) {
                    if (type == null) {
                        swal({
                            title: "",
                            type: "error",
                            text: "Silahkan pilih jenis pembayaran",
                            confirmButtonColor: "#01c853",
                        }, function(isConfirm) {});
                    }
                }
            });
        });
    </script>
</body>

</html>
