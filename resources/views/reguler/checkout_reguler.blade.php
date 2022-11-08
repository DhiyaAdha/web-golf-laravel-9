<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Metode Pembayaran</title>
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/jquery.dataTables.min.css') }}">
    <link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/font-awesome.min.css') }}">
    <style>
        .panel-green {
            color: #fff;
            border-radius: 4px;
            background: linear-gradient(to right, #82eee5, #01c853) !important;
        }

        #calculator .screen {
            width: 161px;
            height: 36px;
            border-radius: 3px;
            padding: 10px;
            margin: 2px 24px;
            font-size: 15px;
            font-weight: 700;
            background: #8e9eab;
        }

        .over-products {
            height: 100px; 
            overflow-y: scroll;
        }
        #calculator input {
            border: none;
        }

        #calculator .qt {
            margin: 4px 10px;
            display: flex;
            justify-content: space-between;
        }

        #calculator button {
            height: 35px;
            width: 35px;
            margin: 2px 1px;
            border: none!important;
            padding: 6px 7px;
        }

        #allClear {
            box-shadow: inset 1px 1px 50px #900;
            border: none;
        }

        .btn-default {
            background: #eeeeee;
        }

        .return-true {
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            padding: 0px 5px;
        }

        .custom-control-inline {
            margin-right: 0px !important;
        }

        .green {
            background-color: rgba(25, 216, 149, 0.2);
            color: #19d895;
            border-radius: 5px;
            font-weight: bold;
            padding: 5px;
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

        .custom-control-input:checked~.custom-control-label::before {
            border-color: #01C813 !important;
            background-color: #01C813 !important;
        }

        .custom-radio .custom-control-input:checked~.custom-control-label::after {
            background-image: none !important;
        }

        .table th {
            border-top: 1px solid #dee2e6 !important;
        }

        .cursor {
            cursor: pointer;
        }

        .choose:hover {
            background-color: #f4f4f4;
        }

        body {
            background: #efefef;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
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
                    <div class="card" style="border: none !important;">
                        <div class="d-flex flex-wrap pd-1">
                            <div class="col-md-7 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Metode Pembayaran</span>
                                                <button tabindex="0" type="button" class="btn btn-success btn-flat" title="Calculator" data-popover-content="#unique-id" data-toggle="popover" data-placement="bottom">
                                                    <i class="fa fa-calculator fa-lg" aria-hidden="true"></i>
                                                </button>
                                                <div id="unique-id" style="display:none;">
                                                    <h3 class="popover-header text-center">Calculator</h3>
                                                    <div class="popover-body">
                                                        <div id="calculator">
                                                            <div class="row text-center" id="calc">
                                                                <div class="calcBG col-md-12 text-center">
                                                                    <div class="row" id="result">
                                                                    <form name="calc">
                                                                        <input type="text" class="screen text-right inputDisplay" readonly>
                                                                    </form>
                                                                    </div>
                                                                    <div class="row qt">
                                                                        <button id="allClear" type="button" class="btn btn-danger" onclick="clearInput()">AC</button>
                                                                        <button id="clear" type="button" class="btn btn-warning" onclick="deleteCharacter()">CE</button>
                                                                        <button id="." type="button" class="btn btn-default" onclick="insertCharacter('.')">.</button>
                                                                        <button id="/" type="button" class="btn btn-default" onclick="insertCharacter('/')">÷</button>
                                                                    </div>
                                                                    <div class="row qt">
                                                                        <button id="7" type="button" class="btn btn-default" onclick="insertCharacter(7)">7</button>
                                                                        <button id="8" type="button" class="btn btn-default" onclick="insertCharacter(8)">8</button>
                                                                        <button id="9" type="button" class="btn btn-default" onclick="insertCharacter(9)">9</button>
                                                                        <button id="*" type="button" class="btn btn-default" onclick="insertCharacter('*')">x</button>
                                                                    </div>
                                                                    <div class="row qt">
                                                                        <button id="4" type="button" class="btn btn-default" onclick="insertCharacter(4)">4</button>
                                                                        <button id="5" type="button" class="btn btn-default" onclick="insertCharacter(5)">5</button>
                                                                        <button id="6" type="button" class="btn btn-default" onclick="insertCharacter(6)">6</button>
                                                                        <button id="-" type="button" class="btn btn-default" onclick="insertCharacter('-')">-</button>
                                                                    </div>
                                                                    <div class="row qt">
                                                                        <button id="1" type="button" class="btn btn-default" onclick="insertCharacter(1)">1</button>
                                                                        <button id="2" type="button" class="btn btn-default" onclick="insertCharacter(2)">2</button>
                                                                        <button id="3" type="button" class="btn btn-default" onclick="insertCharacter(3)">3</button>
                                                                        <button id="+" type="button" class="btn btn-default" onclick="insertCharacter('+')">+</button>
                                                                    </div>
                                                                    <div class="row qt">
                                                                        <button id="0" style="width: 75px;" type="button" class="btn btn-default" onclick="insertCharacter(0)">0</button>
                                                                        <button id="equals" style="width: 75px;" type="button" class="btn btn-success d-flex justify-content-center align-items-center" onclick="result()">=</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center"
                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                        <div class="d-flex flex-column flex-grow-1">
                                                            <div class="d-flex align-items-center">
                                                                <div class="d-flex flex-column flex-grow-1">
                                                                    <strong>Cash/Transfer</strong>
                                                                    <small class="text-muted">Tunjukan bukti transfer</small>
                                                                </div>
                                                                <a href="javascript:void(0)" onclick="refreshInput();" data-toggle="tooltip" title="Refresh" style="color: #bababa;"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                                                            </div>
                                                            <div class="input-group mb-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp.</div>
                                                                </div>
                                                                <input type="number" value="{{ $totalPrice }}" data-bill="{{ $totalPrice }}" class="form-control bayar-input" name="bayar" placeholder="Masukkan nominal bayar">
                                                            </div>
                                                            <div class="d-flex flex-wrap mb-2 ">
                                                                <input type="button" value="500" onclick="cal(500)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="1000" onclick="cal(1000)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="2000" onclick="cal(2000)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="5000" onclick="cal(5000)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="10000" onclick="cal(10000)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="20000" onclick="cal(20000)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="50000" onclick="cal(50000)" class="btn mr-2 btn-sm btn-default">
                                                                <input type="button" value="100000" onclick="cal(100000)" class="btn mr-2 btn-sm btn-default">
                                                            </div>
                                                        </div>
                                                        <img src="{{ asset('cash-on-delivery.png') }}" alt="cash"
                                                            width="30" height="30">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column">
                                                        <span>Uang kembali</span>
                                                        <span class="green" id="return">Rp. 0,00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Total tagihan</span>
                                                        <span class="nilai-total1-td green"
                                                            data-total="{{ $totalPrice }}">Rp.
                                                            {{ formatrupiah($totalPrice) }}</span>
                                                    </div>
                                                </div>
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
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Invoice</span>
                                                <span style="font-size: small;"
                                                    id="order-number">#{{ $order_number }}</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Tamu</span>
                                                <div data-toggle="tooltip" title="Tambahkan nama tamu"><i class="fa fa-plus-square add-name"></i></div>
                                            </div>
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Jumlah Item</span>
                                                <span>{{ count($orders) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <strong class="flex-grow-1">Item</strong>
                                                <strong style="font-size: small;">Harga</strong>
                                            </div>
                                            <div class="items"></div>
                                            <div class="items-default {{ count($orders) >= 4 ? 'over-products' : '' }}">
                                                @foreach ($orders as $cart)
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">{{ $cart['name'] }} {{ $cart['category'] == 'default' ? '| game' : '' }} x {{ $cart['qty'] }}</span>
                                                        <small>Rp. {{ formatrupiah($cart['price']) }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('proses_reguler') }}" class="btn btn-primary btn-sm mt-2">Kembali</a>
                                    <button type="submit" id="pay" class="btn btn-sm btn-success mt-2">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/asset_offline/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/popper2.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/a076d05399.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/asset_offline/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function deleteCharacter() {
            dlt();
            let currentValue = $('.inputDisplay').val();
            $('.inputDisplay').val(currentValue.substring(0, currentValue.length - 1));
        }

        function insertCharacter(char) {
            click();
            let currentValue = $('.inputDisplay').val();
            let length = currentValue.length;
            let flag = false;
            if(char == '+' || char == '-' || char == '*' || char == '/')
                flag = true;
            if(length == 0) {
                if(flag)
                return;
            }
            let flagNew = false;
            let lastCharacter = currentValue[length-1];
            if(lastCharacter == '+' || lastCharacter == '-' || lastCharacter == '*' || lastCharacter == '/')
            flagNew = true;
            if(flag && flagNew)
                $('.inputDisplay').val(currentValue.substring(0,length-1) + char);
            else
                $('.inputDisplay').val($('.inputDisplay').val() + char);
        }

        function clearInput() {
            dlt();
            $('.inputDisplay').val('');
        }

        function result() {
            dlt();
            let currentValue = $('.inputDisplay').val();
            let length = currentValue.length;
            let flag = false;
            let char = currentValue[length-1];
            if(char == '+' || char == '-' || char == '*' || char == '/')
            flag = true;
            if(flag)
                $('.inputDisplay').val("ERROR!");
            else
                $('.inputDisplay').val(eval($('.inputDisplay').val()));
        }

        function add() {
            var audio = new Audio('../sound/add.mp3');
            audio.play();
        }

        function beep() {
            var audio = new Audio('../sound/beep.mp3');
            audio.play();
        }
        function click() {
            var audio = new Audio('../sound/click.mp3');
            audio.play();
        }

        function dlt() {
            var audio = new Audio('../sound/remove.mp3');
            audio.play();
        }

        function rst() {
            var audio = new Audio('../sound/reset.mp3');
            audio.play();
        }

        function sword() {
            var audio = new Audio('../sound/sword.mp3');
            audio.play();
        }

        function bell() {
            var audio = new Audio('../sound/bell.mp3');
            audio.play();
        }

        function cal(price) {
            let total = $('.nilai-total1-td').data('total');
            if ($('.bayar-input').val() == '') {
                $('.bayar-input').val(price);
                let return_pay = parseInt($('.bayar-input').val()) - parseInt(total);
                if($('.bayar-input').val() > total) {
                    $('.bayar-input').removeClass('is-invalid');
                    $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                        "background-color": "rgba(25, 216, 149, 0.2)",
                        "color": "#19d895"
                    }).data('refund', return_pay);
                } else {
                    $('.bayar-input').addClass('is-invalid');
                    $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                        "background-color": "rgba(216, 25, 25, 0.2)",
                        "color": "#d81c19d1"
                    }).data('refund', return_pay);
                }
            } else {
                let result = parseInt($('.bayar-input').val());
                $('.bayar-input').val(result + price);
                let return_pay = parseInt($('.bayar-input').val()) - parseInt(total);
                if($('.bayar-input').val() > total) {
                    $('.bayar-input').removeClass('is-invalid');
                    $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                        "background-color": "rgba(25, 216, 149, 0.2)",
                        "color": "#19d895"
                    }).data('refund', return_pay);
                } else {
                    $('.bayar-input').addClass('is-invalid');
                    $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                        "background-color": "rgba(216, 25, 25, 0.2)",
                        "color": "#d81c19d1"
                    }).data('refund', return_pay);
                }
            }
        }

        var format = function(num){
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(".");
                }
                i++;
                }
            }
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

        function refreshInput() {
            $('.bayar-input').val($('.bayar-input').data('bill')).removeClass('is-invalid');
            $('#return').text('Rp. 0,00').css({
                "background-color": "rgba(25, 216, 149, 0.2)",
                "color": "#19d895"
            }).data('refund', 0);
        }
        
        $(document).ready(function() {
            $("[data-toggle=popover]").popover({
                html : true,
                sanitize: false,
                content: function() {
                    var content = $(this).attr("data-popover-content");
                    return $(content).children(".popover-body").html();
                },
                title: function() {
                    var title = $(this).attr("data-popover-content");
                    return $(title).children(".popover-header").html();
                }
            });
    
            $(document).on('input', '.bayar-input', function(e) {
                e.preventDefault();
                let total = $('.nilai-total1-td').data('total');
                let return_pay = $(this).val() - total;
    
                if ($(this).val() < total) {
                    if ($(this).val() == '') {
                        $(this).removeClass('is-invalid');
                        $('#return').text('-').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', return_pay);
                    } else {
                        $(this).addClass('is-invalid');
                        $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                            "background-color": "rgba(216, 25, 25, 0.2)",
                            "color": "#d81c19d1"
                        }).data('refund', return_pay);
                    }
                } else {
                    $(this).removeClass('is-invalid');
                    $('#return').text(' Rp. ' + format(return_pay) + ',00').css({
                        "background-color": "rgba(25, 216, 149, 0.2)",
                        "color": "#19d895"
                    }).data('refund', return_pay);
                }
            });
    
            $(document).on('click', '.add-name', function(e) {
                click();
                e.preventDefault();
                $('.add-name').hide();
                $(`<div class="d-flex align-items-center">
                    <input type="text" class="name" placeholder="Masukkan nama">
                </div>`).insertAfter($('.add-name'));
            });
    
            $(document).on('click', '#pay', function(e) {
                e.preventDefault();
                let refund = $('#return').data('refund');
                let pay_amount = $('.bayar-input').val();
                let order_number = $('#order-number').text();
                let total_payment = $('.nilai-total1-td').data('total');
                let name = '';
                let url = "{{ route('invoice.print.reguler') }}";
    
                if (!pay_amount) {
                    sword();
                    swal({
                        title: "",
                        type: "error",
                        text: "Nominal wajib diisi",
                        confirmButtonColor: "#01c853",
                    });
                    return false;
                } else {
                    if ($('.name').val() == '' || $('.name').val() == null) {
                        name = 'reguler';
                    } else {
                        name = $('.name').val();
                    }
                }
    
                if (pay_amount < total_payment) {
                    sword();
                    swal({
                        title: "",
                        type: "error",
                        text: "Nominal tidak terpenuhi",
                        confirmButtonColor: "#01c853",
                    });
                    return false;
                } else {
                    swal({
                        title: "",
                        text: "Lakukan pembayaran?",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#01c853",
                        confirmButtonText: "Bayar",
                        cancelButtonText: "Batal",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                async: true,
                                type: 'POST',
                                data: {
                                    refund: refund,
                                    order_number: order_number,
                                    pay_amount: pay_amount,
                                    name: name
                                },
                                url: "{{ route('pay_reguler') }}",
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
                                    if (response.status == "VALID") {
                                        bell();
                                        swal({
                                            title: '',
                                            type: "success",
                                            text: response.message,
                                            confirmButtonColor: "#01c853",
                                        }, function(isConfirm) {
                                            invoice("{{ route('invoice.print.reguler') }}",
                                                'Print Invoice');
                                            history.go(0);
                                        });
                                    } else {
                                        sword();
                                        swal({
                                            title: "",
                                            type: "error",
                                            text: response.message,
                                            confirmButtonColor: "#01c853",
                                        });
                                        return false;
                                    }
                                }
                            });
                        } else {
                            swal("Dibatalkan", "", "info");
                        }
                    });
                    return false;
                }
    
            });
    
            function invoice(url, title) {
                popupCenter(url, title, 340, 550);
            }
    
            function popupCenter(url, title, w, h) {
                const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window
                    .screenX;
                const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window
                    .screenY;
                const width = window.innerWidth ? window.innerWidth : document.documentElement
                    .clientWidth ?
                    document
                    .documentElement.clientWidth : screen.width;
                const height = window.innerHeight ? window.innerHeight : document.documentElement
                    .clientHeight ?
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
