<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metode Pembayaran</title>
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
            color: #fff;
            border-radius: 4px;
            background: linear-gradient(to right, #82eee5, #01c853) !important;
        }

        .payment-1 {
            background-color: #efefef;
            border-radius: 5px;
        }

        .card-img-absolute {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
        }

        .nilai-total1-td {
            color: #19d895;
            border-radius: 5px;
            font-weight: bold;
        }

        .panel-black {
            background-color: #000000;
            color: #fff;
            border-radius: 4px;
            background: linear-gradient(to right, #525151, #000000) !important;
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
                                        <img src="{{ asset('img/circle.svg') }}" class="card-img-absolute"
                                            alt="circle-image">
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
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Pilih metode Pembayaran</span>
                                                <div class="d-flex">
                                                    <div class="custom-control custom-radio mr-2">
                                                        <input type="radio" name="payment" id="wk"
                                                            class="custom-control-input" value="single" checked>
                                                        <label class="custom-control-label"
                                                            for="wk">Single</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="payment" id="kw"
                                                            class="custom-control-input" value="multiple">
                                                        <label class="custom-control-label"
                                                            for="kw">Multiple</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="single">
                                                <div class="form-group">
                                                    <label for="payment-type"></label>
                                                    <select class="form-control" id="payment-type">
                                                        <option value="" disabled selected>Jenis pembayaran
                                                        </option>
                                                        <option value="1">Limit Bulanan</option>
                                                        <option value="2">Limit Kupon</option>
                                                        <option value="3">Cash/Transfer</option>
                                                        <option value="4">Deposit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="cash-transfer"></div>
                                            </div>
                                            <div id="multiple"></div>
                                            <div class="d-flex justify-content-end pd-1">
                                                {{-- <a href="javascript:void(0)" id="print"
                                                    class="d-flex align-items-center btn btn-sm btn-primary mr-2"><i
                                                        class="fa fa-print mr-2"></i> Invoice</a> --}}
                                                <a href="javascript:void(0)" id="pay"
                                                    class="btn btn-sm btn-success">Bayar</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card " style="border:none;">
                                    <div class="card-body payment-1">
                                        <div class="d-flex-flex-column">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Tanggal order</span>
                                                    <span>{{ date('d M, Y') }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Waktu</span>
                                                    <span>{{ date('H:i') }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Admin</span>
                                                    <span>{{ auth()->user()->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card " style="border:none;">
                                    <div class="card-body">
                                        <div class="d-flex-flex-column">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Invoice</span>
                                                    <span style="font-size: small;"
                                                        id="order-number">#{{ $order_number }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Tamu</span>
                                                    <span>{{ $visitor->name }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Jumlah order</span>
                                                    <span>{{ count($orders) }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Total bayar</span>
                                                    <span class="nilai-total1-td">Rp.
                                                        {{ formatrupiah($totalPrice) }}</span>
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

            $('input[type=radio][name=payment]').on('change', function() {
                switch ($(this).val()) {
                    case 'single':
                        $('#single').show();
                        $('#multiple').html(`<div id="multiple">
                                                <div class="form-group">
                                                    <label for="payment-type"></label>
                                                    <select class="form-control" id="payment-type">
                                                        <option value="" disabled selected>Jenis ok</option>
                                                        <option value="1">Limit Bulanan</option>
                                                        <option value="2">Limit Kupon</option>
                                                        <option value="3">Cash/Transfer</option>
                                                        <option value="4">Deposit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="cash-transfer"></div>
                                            </div>`).hide();
                        break;
                    case 'multiple':
                        $('#single').hide();
                        $('#multiple').html(`<div id="multiple">
                                                <div class="form-group">
                                                    <label for="payment-type"></label>
                                                    <select class="form-control" id="payment-type">
                                                        <option value="" disabled selected>Jenis ok</option>
                                                        <option value="1">Limit Bulanan</option>
                                                        <option value="2">Limit Kupon</option>
                                                        <option value="3">Cash/Transfer</option>
                                                        <option value="4">Deposit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="cash-transfer"></div>
                                            </div>`).show();
                        break;
                }
            });

            $(document).on('change', '#payment-type', function(e) {
                e.preventDefault();
                let type = $(this).val();
                let tg = window.location.href;
                tg = tg.split("?")
                tg = tg[0];
                tg = tg.split("/");
                page = tg[tg.length - 1];

                if (type == 3) {
                    $('#cash-transfer').html(
                        ` <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input type="text" min="0"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                    class="form-control number-input input-notzero bayar-input"
                                                    name="bayar" placeholder="Masukkan nominal bayar"
                                                    autocomplete="off">
                                            </div>`
                    ).show();
                } else {
                    $('#cash-transfer').html(
                        ` <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input type="text" min="0"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                    class="form-control number-input input-notzero bayar-input"
                                                    name="bayar" placeholder="Masukkan nominal bayar"
                                                    autocomplete="off">
                                            </div>`
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
                        $('#balance').text(formatIDR(response.price) + ',00');
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
                let type_single = $('#payment-type').val();
                let order_number = $('#order-number').text();
                let tg = window.location.href;
                tg = tg.split("?")
                tg = tg[0];
                tg = tg.split("/");
                page = tg[tg.length - 1];

                let url = "{{ route('invoice.print', ':id') }}";
                url = url.replace(':id', page);

                if (!error) {
                    if (type_single == null) {
                        swal({
                            title: "",
                            type: "error",
                            text: "Silahkan pilih jenis pembayaran",
                            confirmButtonColor: "#01c853",
                        }, function(isConfirm) {});
                    } else {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: {
                                single: type_single,
                                page: parseFloat(page),
                                order_number: order_number
                            },
                            url: "{{ route('pay') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                                    swal({
                                        title: "",
                                        type: "error",
                                        text: response.message,
                                        confirmButtonColor: "#01c853",
                                    });
                                } else {
                                    swal({
                                        title: "",
                                        type: "success",
                                        text: response.message,
                                        confirmButtonColor: "#01c853",
                                    }, function(isConfirm) {
                                        invoice(url, 'Print Invoice');
                                        window.close();
                                    });
                                }
                            }
                        });
                    }
                }
            });

            function invoice(url, title) {
                popupCenter(url, title, 350, 550);
            }

            function popupCenter(url, title, w, h) {
                const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
                const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

                const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ?
                    document
                    .documentElement.clientWidth : screen.width;
                const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ?
                    document
                    .documentElement.clientHeight : screen.height;

                const systemZoom = width / window.screen.availWidth;
                const left = (width - w) / 2 / systemZoom + dualScreenLeft
                const top = (height - h) / 2 / systemZoom + dualScreenTop
                const newWindow = window.open(url, title,
                    `scrollbars=yes,width  = ${w / systemZoom}, height = ${h / systemZoom}, top    = ${top}, left   = ${left}`
                );
                if (window.focus) newWindow.focus();
            }
        });
    </script>
</body>

</html>
