<!DOCTYPE html>
<html lang="en">
<head>
    <title>TGCC | Metode Pembayaran</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/jquery.dataTables.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/font-awesome.min.css') }}" type="text/css">
    <style>
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
        .panel-green {
            color: #fff;
            border-radius: 4px;
            background: linear-gradient(to right, #82eee5, #01c853) !important;
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

        .over-products {
            height: 100px; 
            overflow-y: scroll;
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
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body panel-green">
                                        <div class="d-flex-flex-column">
                                            <span class="text-capitalize">Saldo</span>
                                            <div class="d-flex">
                                                <span class=" text-big" id="balance" data-balance="{{ $deposit->balance }}">{{ formatrupiah($deposit->balance) ?? '0' }}</span>
                                            </div>
                                        </div>
                                        <img src="{{ asset('img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body panel-black">
                                        <div class="d-flex-flex-column">
                                            <span class="text-capitalize">Kupon</span>
                                            <div class="d-flex">
                                                <span class=" text-big" id="kupon" data-kupon="{{ $log_coupon->quota_kupon }}">{{ $log_coupon->quota_kupon ?? '0' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body panel-black">
                                        <div class="d-flex-flex-column">
                                            <span class="text-capitalize">Limit</span>
                                            <div class="d-flex">
                                                <span class="text-big" id="limit" data-limit="{{ $log_limit->quota }}">{{ $log_limit->quota ?? '0' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap pd-1">
                            <div class="col-md-7 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <input type="hidden" value="{{ $get_id }}">
                                            <input type="hidden" class="package-default" value="{{ $package_default }}">
                                            <div class="d-flex align-items-center">
                                                <span class="flex-grow-1">Metode Pembayaran</span>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-control custom-radio mr-2">
                                                        <input type="radio" name="payment" id="wk" class="custom-control-input" value="single" checked>
                                                        <label class="custom-control-label cursor" for="wk">Single</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mr-2">
                                                        <input type="radio" name="payment" id="kw" class="custom-control-input" value="multiple">
                                                        <label class="custom-control-label cursor" for="kw">Split</label>
                                                    </div>
                                                    <div data-toggle="tooltip" title="Akses keyboard">
                                                        <button tabindex="0" type="button" id="shortcut" class="btn btn-success btn-flat mr-2" data-popover-content="#shortcut-id" data-toggle="popover" data-placement="left">
                                                            <i class="fa fa-key" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div data-toggle="tooltip" title="Kalkulator">
                                                        <button tabindex="0" type="button" id="calculator" class="btn btn-success btn-flat" data-popover-content="#unique-id" data-toggle="popover" data-placement="left">
                                                            <i class="fa fa-calculator" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div id="shortcut-id" style="display:none;">
                                                        <h3 class="popover-header text-center">Shortcut keyboard</h3>
                                                        <div class="popover-body">
                                                            <div class="d-flex mb-2">
                                                                <span class="mr-2" style="width:40px;">ALT+1</span>
                                                                <span class="text-left text-capitalize">kalkulator popup</span>
                                                            </div>
                                                            <div class="d-flex mb-2">
                                                                <span class="mr-2" style="width:40px;">ALT+2</span>
                                                                <span class="text-left text-capitalize"> akses keyboard popup</span>
                                                            </div>
                                                            <div class="d-flex mb-2">
                                                                <span class="mr-2" style="width:40px;">ALT+3</span>
                                                                <span class="text-left text-capitalize"> refresh form bayar </span>
                                                            </div>
                                                            <div class="d-flex mb-2">
                                                                <span class="mr-2" style="width:40px;">ALT+5</span>
                                                                <span class="text-left text-capitalize"> kembali ke keranjang</span>
                                                            </div>
                                                            <div class="d-flex mb-2">
                                                                <span class="mr-2" style="width:40px;">ALT+6</span>
                                                                <span class="text-left text-capitalize"> bayar sekarang</span>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                            </div>
                                            <div id="single">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-radio custom-control-inline" style="width:100%;">
                                                                @if ($deposit->balance != 0)
                                                                    @if($deposit->balance > $totalPrice)
                                                                        <input type="radio" id="customRadioInline4" name="payment-type" value="4" class="custom-control-input">
                                                                        <label class="custom-control-label" for="customRadioInline4" style="width: 100%;cursor:pointer;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Deposit</strong>
                                                                                <small class="text-muted mb-2">Deposit akan berkurang sesuai dengan tagihan</small>
                                                                            </div>
                                                                        </label>
                                                                    @else
                                                                        <input type="radio" id="customRadioInline4" name="payment-type" value="4" class="custom-control-input" disabled>
                                                                        <label class="custom-control-label" for="customRadioInline4" style="width: 100%;cursor:no-drop;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Deposit</strong>
                                                                                <small class="text-muted mb-2"><i>Saldo tidak mencukupi</i></small>
                                                                            </div>
                                                                        </label>
                                                                    @endif
                                                                @else
                                                                    <input type="radio" id="customRadioInline4" name="payment-type" value="4" class="custom-control-input" disabled>
                                                                    <label class="custom-control-label" for="customRadioInline4" style="width: 100%;cursor:no-drop;">
                                                                        <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Deposit</strong>
                                                                            <small class="text-muted mb-2"><i>Saldo kosong</i></small>
                                                                        </div>
                                                                    </label>
                                                                @endif
                                                            </div>
                                                            <img src="{{ asset('deposit.png') }}" alt="deposit" width="26" height="26">
                                                        </div>
                                                        <div class="d-flex align-items-center mt-2 choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-radio custom-control-inline" style="width:100%;">
                                                                <input type="radio" id="customRadioInline3" name="payment-type" value="3" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadioInline3" style="width: 100%;cursor:pointer;">
                                                                    <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="d-flex flex-column flex-grow-1">
                                                                                <strong>Cash/Transfer</strong>
                                                                                <small class="text-muted">Tunjukan bukti transfer</small>
                                                                            </div>
                                                                            <a href="javascript:void(0)" onclick="refreshInput();" data-toggle="tooltip" title="Refresh" style="color: #bababa;"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                                                                        </div>
                                                                        <div class="form-group mt-2 mb-2">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp.</div>
                                                                                </div>
                                                                                <input type="number" data-bill="{{ $totalPrice }}" class="form-control number-input input-notzero bayar-cash"
                                                                                    name="bayar" placeholder="Masukkan nominal bayar" autocomplete="on">
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-wrap mb-2 ">
                                                                            <input type="button" value="500" onclick="cal(500)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="1000" onclick="cal(1000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="2000" onclick="cal(2000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="5000" onclick="cal(5000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="10000" onclick="cal(10000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="20000" onclick="cal(20000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="50000" onclick="cal(50000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="100000" onclick="cal(100000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <img src="{{ asset('cash-on-delivery.png') }}" alt="cash" width="30" height="30">
                                                        </div>
                                                        <div class="d-flex align-items-center mt-2 choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-radio custom-control-inline" style="width:100%;">
                                                                @if (count($package_default) == 1)
                                                                    @if ($item_default == 1)
                                                                        @if (count($package_additional) == 0 && count($package_others) == 0)
                                                                            @if ($log_coupon->quota_kupon != 0)
                                                                                <input type="radio" id="customRadioInline2" name="payment-type" value="2" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadioInline2" style="width: 100%;cursor:pointer;">
                                                                                    <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                        <strong>Kupon</strong>
                                                                                        <small class="text-muted">Kupon otomatis akan berkurang</small>
                                                                                        <small class="text-muted mb-2">Kupon berlaku hanya untuk 1 game</small>
                                                                                    </div>
                                                                                </label>
                                                                            @else
                                                                                <input type="radio" id="customRadioInline2" name="payment-type" value="2" class="custom-control-input" disabled>
                                                                                <label class="custom-control-label" for="customRadioInline2" style="width: 100%;cursor:no-drop;">
                                                                                    <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                        <strong>Kupon</strong>
                                                                                        <small class="text-muted"><i>Tidak ada kupon</i></small>
                                                                                    </div>
                                                                                </label>
                                                                            @endif
                                                                        @else
                                                                            <input type="radio" id="customRadioInline2" name="payment-type" value="2" class="custom-control-input" disabled>
                                                                            <label class="custom-control-label" for="customRadioInline2" style="width: 100%;cursor:no-drop;">
                                                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <small class="mb-2">
                                                                                        <i class="text-muted text-justify">
                                                                                            Satu kupon hanya berlaku untuk satu jenis permainan golf</i>
                                                                                    </small>
                                                                                </div>
                                                                            </label>
                                                                        @endif
                                                                    @else
                                                                        <input type="radio" id="customRadioInline2" name="payment-type" value="2" class="custom-control-input" disabled>
                                                                        <label class="custom-control-label" for="customRadioInline2" style="width: 100%;cursor:no-drop;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Kupon</strong>
                                                                                <small class="mb-2">
                                                                                    <i class="text-muted text-justify">
                                                                                        Satu kupon hanya berlaku untuk satu jenis permainan golf</i>
                                                                                </small>
                                                                            </div>
                                                                        </label>
                                                                    @endif
                                                                @else
                                                                    <input type="radio" id="customRadioInline2" name="payment-type" value="2" class="custom-control-input" disabled>
                                                                    <label class="custom-control-label" for="customRadioInline2" style="width: 100%;cursor:no-drop;">
                                                                        <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Kupon</strong>
                                                                            <small class="mb-2">
                                                                                <i class="text-muted text-justify">
                                                                                    Satu kupon hanya berlaku untuk satu jenis permainan golf</i>
                                                                            </small>
                                                                        </div>
                                                                    </label>
                                                                @endif
                                                            </div>
                                                            <img src="{{ asset('coupon.png') }}" alt="cash" width="30" height="30">
                                                        </div>
                                                        <div class="d-flex align-items-center mt-2 choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-radio custom-control-inline" style="width:100%;">
                                                                @if (count($package_default) == 1)
                                                                    @if ($item_default == 1)
                                                                        @if (count($package_additional) == 0 && count($package_others) == 0)
                                                                            @if ($log_limit->quota != 0)
                                                                                <input type="radio" id="customRadioInline1" name="payment-type" value="1" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadioInline1" style="width: 100%;cursor:pointer;">
                                                                                    <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                        <strong>Limit</strong>
                                                                                        <small class="text-muted">Limit otomatis akan berkurang</small>
                                                                                        <small class="text-muted mb-2">Limit berlaku hanya untuk 1 game</small>
                                                                                    </div>
                                                                                </label>
                                                                            @else
                                                                                <input type="radio" id="customRadioInline1" name="payment-type" value="1" class="custom-control-input" disabled>
                                                                                <label class="custom-control-label" for="customRadioInline1" style="width: 100%;cursor:pointer;">
                                                                                    <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                        <strong>Limit</strong>
                                                                                        <small class="text-muted"><i>Tidak ada limit</i></small>
                                                                                    </div>
                                                                                </label>
                                                                            @endif
                                                                        @else
                                                                            <input type="radio" id="customRadioInline1" name="payment-type" value="1" class="custom-control-input" disabled>
                                                                            <label class="custom-control-label" for="customRadioInline1" style="width: 100%;cursor:no-drop;">
                                                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <small class="mb-2">
                                                                                        <i class="text-muted text-justify">
                                                                                            Satu limit hanya berlaku untuk satu jenis permainan golf</i>
                                                                                    </small>
                                                                                </div>
                                                                            </label>
                                                                        @endif
                                                                    @else
                                                                        <input type="radio" id="customRadioInline1" name="payment-type" value="1" class="custom-control-input" disabled>
                                                                        <label class="custom-control-label" for="customRadioInline1" style="width: 100%;cursor:no-drop;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Limit</strong>
                                                                                <small class="mb-2">
                                                                                    <i class="text-muted text-justify">
                                                                                        Satu limit hanya berlaku untuk satu jenis permainan golf</i>
                                                                                </small>
                                                                            </div>
                                                                        </label>
                                                                    @endif
                                                                @else
                                                                    <input type="radio" id="customRadioInline1" name="payment-type" value="1" class="custom-control-input" disabled>
                                                                    <label class="custom-control-label" for="customRadioInline1" style="width: 100%;cursor:no-drop;">
                                                                        <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Limit</strong>
                                                                            <small class="mb-2">
                                                                                <i class="text-muted text-justify">
                                                                                    Satu limit hanya berlaku untuk satu jenis permainan golf</i>
                                                                            </small>
                                                                        </div>
                                                                    </label>
                                                                @endif
                                                            </div>
                                                            <img src="{{ asset('credit-limit.png') }}" alt="cash" width="30" height="30">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="multiple" class="d-none">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-checkbox" style="width:100%;">
                                                                @if ($log_limit->quota != 0 || $log_coupon->quota_kupon != 0)
                                                                    @if ($deposit->balance != 0)
                                                                        <input type="checkbox" name="payment-type[]" value="deposit" data-deposit="{{ $deposit->balance }}" data-bill="{{ (int) ceil($totalPrice) }}" class="custom-control-input" id="customCheck8">
                                                                        <label class="custom-control-label" for="customCheck8" style="width: 100%; cursor:pointer;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Deposit</strong>
                                                                                <small class="text-muted mb-2"> Deposit akan berkurang sesuai dengan tagihan</small>
                                                                            </div>
                                                                        </label>
                                                                    @else
                                                                        <input type="checkbox" name="payment-type[]" value="deposit" data-deposit="{{ $deposit->balance }}" data-bill="{{ (int) ceil($totalPrice) }}" class="custom-control-input" id="customCheck8" disabled>
                                                                        <label class="custom-control-label" for="customCheck8" style="width: 100%; cursor:no-drop;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Deposit</strong>
                                                                                <small class="text-muted mb-2"><i>Saldo kosong</i></small>
                                                                            </div>
                                                                        </label>
                                                                    @endif
                                                                @else
                                                                    <input type="checkbox" name="payment-type[]" value="deposit" data-deposit="{{ $deposit->balance }}" data-bill="{{ (int) ceil($totalPrice) }}" class="custom-control-input" id="customCheck8">
                                                                    <label class="custom-control-label" for="customCheck8" style="width: 100%; cursor:pointer;">
                                                                        <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Deposit</strong>
                                                                            <small class="text-muted mb-2">Deposit akan berkurang sesuai dengan tagihan</small>
                                                                        </div>
                                                                    </label>
                                                                @endif
                                                            </div>
                                                            <img src="{{ asset('deposit.png') }}" alt="deposit" width="26" height="26">
                                                        </div>
                                                        <div class="d-flex align-items-center mt-2 choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-checkbox" style="width:100%;">
                                                                <input type="checkbox" name="payment-type[]" value="cash/transfer" class="custom-control-input" id="customCheck7">
                                                                <label class="custom-control-label" for="customCheck7" style="width: 100%; cursor:pointer;">
                                                                    <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="d-flex flex-column flex-grow-1">
                                                                                <strong>Cash/Transfer</strong>
                                                                                <small class="text-muted">Tunjukan bukti transfer</small>
                                                                            </div>
                                                                            <a href="javascript:void(0)" onclick="refreshInput();" data-toggle="tooltip" title="Refresh" style="color: #bababa;"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                                                                        </div>
                                                                        <div class="form-group mt-2 mb-2">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp.</div>
                                                                                </div>
                                                                                <input type="number" data-bill="{{ $totalPrice }}" class="form-control number-input input-notzero bayar-input" name="bayar" placeholder="Masukkan nominal bayar" autocomplete="on">
                                                                                </div>
                                                                        </div>
                                                                        {{-- <div class="d-flex flex-wrap mb-2 ">
                                                                            <input type="button" value="500" onclick="call(500)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="1000" onclick="call(1000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="2000" onclick="call(2000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="5000" onclick="call(5000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="10000" onclick="call(10000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="20000" onclick="call(20000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="50000" onclick="call(50000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                            <input type="button" value="100000" onclick="call(100000)" class="btn mr-2 mb-2 btn-sm btn-default">
                                                                        </div> --}}
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <img src="{{ asset('cash-on-delivery.png') }}" alt="cash" width="30" height="30">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <strong class="flex-grow-1">Gunakan Limit/Kupon</strong>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                                <label class="custom-control-label cursor" for="customSwitch2"></label>
                                                            </div>
                                                        </div>
                                                        <div id="hide-limit" class="d-none">
                                                            <div class="d-flex align-items-center mt-2 choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                <div class="flex-grow-1 custom-control custom-radio custom-control-inline" style="width:100%;">
                                                                    @if (count($package_default) == 1)
                                                                        @if ($log_coupon->quota_kupon != 0)
                                                                            <input type="radio" id="customRadioInline6" name="payment-type[]" value="kupon" class="custom-control-input">
                                                                            <label class="custom-control-label" for="customRadioInline6" style="width: 100%; cursor:pointer;">
                                                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <div class="message-limit d-flex flex-column">
                                                                                        <small class="text-muted">Kupon otomatis akan berkurang</small>
                                                                                        <small class="text-muted mb-2">Kupon berlaku hanya untuk 1 game</small>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        @else
                                                                            <input type="radio" id="customRadioInline6" name="payment-type[]" value="kupon" class="custom-control-input" disabled>
                                                                            <label class="custom-control-label" for="customRadioInline6" style="width: 100%; cursor:no-drop;">
                                                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <small class="text-muted"><i>Tidak ada kupon</i></small>
                                                                                </div>
                                                                            </label>
                                                                        @endif
                                                                    @else
                                                                        <input type="radio" id="customRadioInline6" name="payment-type[]" value="kupon" class="custom-control-input" disabled>
                                                                        <label class="custom-control-label" for="customRadioInline6" style="width: 100%; cursor:no-drop;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Kupon</strong>
                                                                                <small class="text-muted"><i>Kupon hanya berlaku satu jenis permainan</i></small>
                                                                            </div>
                                                                        </label>
                                                                    @endif
                                                                </div>
                                                                <img src="{{ asset('coupon.png') }}" alt="cash" width="30" height="30">
                                                            </div>
                                                            <div class="d-flex align-items-center mt-2 choose" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                <div class="flex-grow-1 custom-control custom-radio custom-control-inline" style="width:100%;">
                                                                    @if (count($package_default) == 1)
                                                                        @if ($log_limit->quota != 0)
                                                                            <input type="radio" id="customRadioInline5" name="payment-type[]" value="limit" class="custom-control-input">
                                                                            <label class="custom-control-label" for="customRadioInline5" style="width: 100%; cursor:pointer;">
                                                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <div class="message-kupon d-flex flex-column">
                                                                                        <small class="text-muted">Limit otomatis akan berkurang</small>
                                                                                        <small class="text-muted mb-2">Limit berlaku hanya untuk 1 game</small>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        @else
                                                                            <input type="radio" id="customRadioInline5" name="payment-type[]" value="limit" class="custom-control-input" disabled>
                                                                            <label class="custom-control-label" for="customRadioInline5" style="width: 100%; cursor:no-drop;">
                                                                                <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <div class="message-kupon d-flex flex-column">
                                                                                        <small class="text-muted"><i>Tidak ada limit</i></small>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        @endif
                                                                    @else
                                                                        <input type="radio" id="customRadioInline5" name="payment-type[]" value="limit" class="custom-control-input" disabled>
                                                                        <label class="custom-control-label" for="customRadioInline5" style="width: 100%; cursor:no-drop;">
                                                                            <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Limit</strong>
                                                                                <div class="message-kupon d-flex flex-column">
                                                                                    <small class="text-muted"><i>Limit hanya berlaku satu jenis permainan</i></small>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    @endif
                                                                </div>
                                                                <img src="{{ asset('credit-limit.png') }}" alt="cash" width="30" height="30">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Total tagihan</span>
                                                        <span class="nilai-total1-td green" data-total="{{ $totalPrice }}">{{ formatrupiah($totalPrice) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex justify-content-center" style="background: url(/img/pattern-1.svg) no-repeat center bottom; background-size: cover;">
                                    <lottie-player src="{{ asset('dist/asset_offline/lf20_yzoqyyqf.json') }}"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay></lottie-player>
                                </div>
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
                                                <span style="font-size: small;" id="order-number">{{ $order_number }}</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Tamu</span>
                                                <span>{{ $visitor->name }}</span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Jumlah Item</span>
                                                <span>{{ count($orders) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2 kmt" data-pricesingle="{{ $price_single }}">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <strong class="flex-grow-1">Item</strong>
                                                <strong style="font-size: small;">Harga</strong>
                                            </div>
                                            <div class="items-default {{ count($orders) >= 4 ? 'over-products' : '' }}">
                                                @foreach ($orders as $cart)
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">{{ $cart['name'] }} {{ $cart['category'] == 'default' ? '| game' : '' }} x {{ $cart['qty'] }}</span>
                                                        <small>{{ formatrupiah($cart['price']) }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="items-replace"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="discount"></div>
                                <div class="card mt-2 deposit d-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Deposit</span>
                                            <span id="deposit"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2 remaining d-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Sisa Pembayaran</span>
                                            <span id="remaining"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2 refund d-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <span class="flex-grow-1">Uang kembali</span>
                                            <span id="return">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ URL::signedRoute('order.cart', ['id' => $visitor->id]) }}" data-route="{{ URL::signedRoute('order.cart', ['id' => $visitor->id]) }}" class="btn btn-primary btn-sm mt-2" id="back">Kembali</a>
                                    <button id="reset" data-member={{ $visitor->id }} class="btn btn-sm btn-danger mt-2">Batalkan</button>
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
    <script defer src="{{ asset('dist/asset_offline/lottie-player.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('dist/asset_offline/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script defer src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script defer src="{{ asset('dist/asset_offline/checkout_member.js') }}"></script>
</body>
</html>
