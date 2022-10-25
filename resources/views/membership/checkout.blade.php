<!DOCTYPE html>
<html lang="en">
<head>
    <title>Metode Pembayaran</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                                <span class="flex-grow-1 text-big">Rp</span>
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
                                                <span class=" text-big" id="kupon" data-kupon="{{ $log_limit->quota_kupon }}">{{ $log_limit->quota_kupon ?? '0' }}</span>
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
                                            <span class="text-capitalize">Limit</span>
                                            <div class="d-flex">
                                                <span class="text-big" id="limit" data-limit="{{ $log_limit->quota }}">{{ $log_limit->quota ?? '0' }}</span>
                                                <span></span>
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
                                                                        <strong>Cash/Transfer</strong>
                                                                        <small class="text-muted">Tunjukan bukti transfer</small>
                                                                        <div class="form-group mt-2 mb-2" id="cash-transfer">
                                                                        </div>
                                                                        {{-- <div class="d-flex flex-wrap justify-content-around mb-2 ">
                                                                            <input type="button" value="500" onclick="cal(500)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="1000" onclick="cal(1000)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="2000" onclick="cal(2000)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="5000" onclick="cal(5000)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="10000" onclick="cal(10000)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="20000" onclick="cal(20000)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="50000" onclick="cal(50000)" class="btn btn-sm btn-default">
                                                                            <input type="button" value="100000" onclick="cal(100000)" class="btn btn-sm btn-default">
                                                                        </div> --}}
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
                                                                            @if ($log_limit->quota_kupon != 0)
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
                                                                @if ($log_limit->quota != 0 || $log_limit->quota_kupon != 0)
                                                                    {{-- @if ($totalPrice != $price_single) --}}
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
                                                                    {{-- @else
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="customCheck8" disabled>
                                                                        <label class="custom-control-label"
                                                                            for="customCheck8"
                                                                            style="width: 100%; cursor:no-drop;">
                                                                            <div
                                                                                class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Deposit</strong>
                                                                                <small class="text-muted mb-2"><i>Saldo
                                                                                        tidak dapat
                                                                                        digunakan</i></small>
                                                                            </div>
                                                                        </label>
                                                                    @endif --}}
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
                                                                @if ($log_limit->quota != 0 || $log_limit->quota_kupon != 0)
                                                                    {{-- @if ($totalPrice != $price_single) --}}
                                                                    <input type="checkbox" name="payment-type[]" value="cash/transfer" class="custom-control-input" id="customCheck7">
                                                                    <label class="custom-control-label" for="customCheck7" style="width: 100%; cursor:pointer;">
                                                                        <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Cash/Transfer</strong>
                                                                            <small class="text-muted">Tunjukan bukti transfer</small>
                                                                            <div class="form-group mt-2 mb-2" id="cashtransfer">
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <div class="input-group-text">Rp.</div>
                                                                                    </div>
                                                                                    <input type="number" class="form-control number-input input-notzero bayar-input" name="bayar" placeholder="Masukkan nominal bayar" autocomplete="on">
                                                                                    </div>
                                                                            </div>
                                                                            {{-- <div class="d-flex flex-wrap justify-content-around mb-2 ">
                                                                                <input type="button" value="500" onclick="cal(500)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="1000" onclick="cal(1000)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="2000" onclick="cal(2000)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="5000" onclick="cal(5000)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="10000" onclick="cal(10000)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="20000" onclick="cal(20000)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="50000" onclick="cal(50000)" class="btn btn-sm btn-default">
                                                                                <input type="button" value="100000" onclick="cal(100000)" class="btn btn-sm btn-default">
                                                                            </div> --}}
                                                                        </div>
                                                                    </label>
                                                                    {{-- @else
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="customCheck7" disabled>
                                                                        <label class="custom-control-label"
                                                                            for="customCheck7"
                                                                            style="width: 100%; cursor:no-drop;">
                                                                            <div
                                                                                class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Cash/Transfer</strong>
                                                                                <small class="text-muted"><i>Cash/transfer
                                                                                        tidak dapat
                                                                                        digunakan</i></small>
                                                                            </div>
                                                                        </label>
                                                                    @endif --}}
                                                                @else
                                                                    <input type="checkbox" name="payment-type[]" value="cash/transfer" class="custom-control-input" id="customCheck7">
                                                                    <label class="custom-control-label" for="customCheck7" style="width: 100%; cursor:pointer;">
                                                                        <div class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Cash/Transfer</strong>
                                                                            <small class="text-muted">Tunjukan bukti transfer</small>
                                                                            <div class="form-group mt-2 mb-2" id="cashtransfer">
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                @endif
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
                                                                        @if ($log_limit->quota_kupon != 0)
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
                                                        <span class="nilai-total1-td green" data-total="{{ $totalPrice }}">Rp. {{ formatrupiah($totalPrice) }}</span>
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
                                                <span style="font-size: small;" id="order-number">#{{ $order_number }}</span>
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
                                            <div class="items-default">
                                                @foreach ($orders as $cart)
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">{{ $cart['name'] }} {{ $cart['category'] == 'default' ? '| game' : '' }} x {{ $cart['qty'] }}</span>
                                                        <small>Rp. {{ formatrupiah($cart['price']) }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="items-replace"></div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="card mt-2 summary d-none">
                                    <div class="card-body">
                                        <strong>Ringkasan Pembayaran</strong>
                                        <div id="summary"></div>
                                    </div>
                                </div> --}}
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
                                    <a href="{{ URL::signedRoute('order.cart', ['id' => $visitor->id]) }}" class="btn btn-primary btn-sm mt-2">Kembali</a>
                                    <button type="submit" id="pay" class="btn btn-sm btn-success mt-2">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
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

        function remaining() {
            var audio = new Audio('../sound/remaining.mp3');
            audio.play();
        }

        // function cal(price) {
        //     if ($('.bayar-input').val() == '') {
        //         $('.bayar-input').val(price);
        //     } else {
        //         let result = parseInt($('.bayar-input').val());
        //         $('.bayar-input').val(result + price);
        //     }
        // }
        
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
                        click();
                        $("input[name='payment-type[]']").prop('checked', false);
                        $('#single').show();
                        $('#multiple').hide().addClass('d-none');
                        $('#balance').text(formatIDR($('#balance').data('balance') + ',00'));
                        $('.items-default').removeClass('d-none');
                        $('.items-replace').addClass('d-none');
                        $('.discount').hide();
                        $('.refund').addClass('d-none');
                        $('.remaining').addClass('d-none');
                        break;
                    case 'multiple':
                        click();
                        $('.discount').hide();
                        $('.refund').addClass('d-none');
                        $("input[name=payment-type]").prop('checked', false);
                        $('.items-default').removeClass('d-none');
                        $('.items-replace').addClass('d-none');
                        $('#single').hide();
                        $('#multiple').show().removeClass('d-none');
                        $('.bayar-input').val(null);
                        $('#cash-transfer').hide();
                        $('#balance').text(formatIDR($('#balance').data('balance') + ',00'));
                        $('.nilai-total1-td').text('Rp. ' + formatIDR($('.nilai-total1-td').data('total')) +
                            ',00');
                        break;
                }
            });

            $(document).on('change', '#customSwitch2', function(e) {
                click();
                let data_bill = $('#customCheck8').data('bill');
                let data_deposit = $('#customCheck8').data('deposit');
                let price_single = $('.kmt').data('pricesingle');
                let type_multiple = $('input[name="payment-type[]"]:checked')
                    .map(function() {
                        return $(this).val();
                    }).get();
                let minus_deposit = data_bill - data_deposit;
                let discount = '';

                if ($(this).is(':checked')) {
                    $('#hide-limit').removeClass('d-none');
                } else {
                    $("#customRadioInline5").prop('checked', false);
                    $("#customRadioInline6").prop("checked", false);
                    $('#hide-limit').addClass('d-none');
                    if(data_deposit < data_bill) {
                        if(type_multiple.length == 1) {
                            type_multiple.splice(0,1);
                            $('.discount').hide();
                            $('.remaining').addClass('d-none');
                            $('#remaining').text('Rp. 0');
                        } else if (type_multiple.length == 2) {
                            type_multiple.splice(1,1);
                            $('.discount').hide();
                            if(type_multiple[0] == 'deposit') {
                                $('.bayar-input').val('');
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                                $('.nilai-total1-td').data('total', data_bill);
                                $('#remaining').text('Rp. ' + formatIDR(data_bill - data_deposit));
                            } else if (type_multiple[0] == 'cash/transfer') {
                                $('#remaining').text('Rp. 0');
                                $('.bayar-input').val(data_bill);
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                                $('.nilai-total1-td').data('total', data_bill);
                            }
                        } else if (type_multiple.length == 3) {
                            type_multiple.splice(2,1);
                            $('.discount').hide();
                            $('.bayar-input').val(data_bill - data_deposit);
                            $('#remaining').text('Rp. 0');
                            $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                            $('.nilai-total1-td').data('total', data_bill);
                        }
                    } else {
                        if(type_multiple.length == 2) {
                            if(type_multiple[0] == 'deposit') {
                                type_multiple.splice(1,1);
                                $('.deposit').addClass('d-none');
                                $('#deposit').text('Rp. 0');
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                                $('.discount').hide();
                            } else if (type_multiple[0] == 'cash/transfer') {
                                $('.discount').removeClass();
                                $('.bayar-input').val(data_bill).removeClass('is-invalid');
                                $('#return').text('-').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                }).data('refund', 0);
                            }
                        } else if (type_multiple.length == 3) {
                            type_multiple.splice(2,1);
                            $('.discount').hide();
                            $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00').data('total', data_bill);
                        }
                    }
                }
            });

            $(document).on('input', '.bayar-input', function(e) {
                e.preventDefault();
                let total = $('.nilai-total1-td').data('total');
                let return_pay = parseInt($(this).val()) - parseInt(total);
                let remaining = parseInt(total) - parseInt($(this).val());
                let split = $('.nilai-total1-td').data('split') - parseInt($(this).val());
                let return_split = parseInt($(this).val()) - $('.nilai-total1-td').data('split');
                let data_deposit = $('#customCheck8').data('deposit');
                let price_single = $('.kmt').data('pricesingle');
                let type_multiple = $('input[name="payment-type[]"]:checked')
                    .map(function() {
                        return $(this).val();
                    }).get();

                if ($('input[type=radio][name=payment]:checked').val() == 'single') {
                    if ($(this).val() < total) {
                        if ($(this).val() == '') {
                            $(this).removeClass('is-invalid');
                            $('#return').text('-').css({
                                "background-color": "rgba(25, 216, 149, 0.2)",
                                "color": "#19d895"
                            }).data('refund', return_pay);
                        } else {
                            $(this).addClass('is-invalid');
                            $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                                "background-color": "rgba(216, 25, 25, 0.2)",
                                "color": "#d81c19d1"
                            }).data('refund', return_pay);
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        }).data('refund', return_pay);
                    }
                } else {
                    if(data_deposit < total) {
                        let minus_deposit = total - data_deposit;
                        if(type_multiple.length == 1) {
                            if (type_multiple[0] == 'cash/transfer') {
                                if ($(this).val() < total) {
                                    if ($(this).val() == '') {
                                        $(this).removeClass('is-invalid');
                                        $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', return_pay);
                                        $('#remaining').text('Rp. ' + formatIDR(total));
                                    } else {
                                        $(this).addClass('is-invalid');
                                        $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                                            "background-color": "rgba(216, 25, 25, 0.2)",
                                            "color": "#d81c19d1"
                                        }).data('refund', return_pay);
                                        $('#remaining').text('Rp. ' + formatIDR(remaining));
                                    }
                                } else {
                                    $(this).removeClass('is-invalid');
                                    $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', return_pay);
                                    $('#remaining').text('Rp. ' +0);
                                }
                            }
                        } else if (type_multiple.length == 2 ) {
                            if (type_multiple[0] == 'cash/transfer') {
                                if ($(this).val() < $('.nilai-total1-td').data('split')) {
                                    if ($(this).val() == '') {
                                        $(this).removeClass('is-invalid');
                                        $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', return_split);
                                        $('#remaining').text('Rp. ' + formatIDR($('.nilai-total1-td').data('split')));
                                    } else {
                                        $(this).addClass('is-invalid');
                                        $('#return').text(' Rp. ' + formatIDR(return_split) + ',00').css({
                                            "background-color": "rgba(216, 25, 25, 0.2)",
                                            "color": "#d81c19d1"
                                        }).data('refund', return_split);
                                        $('#remaining').text('Rp. ' + formatIDR(split));
                                    }
                                } else {
                                    $(this).removeClass('is-invalid');
                                    $('#return').text(' Rp. ' + formatIDR(return_split) + ',00').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', return_split);
                                    $('#remaining').text('Rp. ' +0);
                                }
                            } else if (type_multiple[1] == 'cash/transfer') {
                                if ($(this).val() < minus_deposit) {
                                    if ($(this).val() == '') {
                                        $(this).removeClass('is-invalid');
                                        $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', parseInt($(this).val()) - minus_deposit);
                                        $('#remaining').text('Rp. ' + formatIDR(minus_deposit));
                                    } else {
                                        $(this).addClass('is-invalid');
                                        $('#return').text(' Rp. ' + formatIDR(parseInt($(this).val()) - minus_deposit) + ',00').css({
                                            "background-color": "rgba(216, 25, 25, 0.2)",
                                            "color": "#d81c19d1"
                                        }).data('refund', parseInt($(this).val()) - minus_deposit);
                                        $('#remaining').text('Rp. ' + formatIDR(parseInt(minus_deposit) - parseInt($(this).val())));
                                    }
                                } else {
                                    $(this).removeClass('is-invalid');
                                    $('#return').text(' Rp. ' + formatIDR(parseInt($(this).val()) - minus_deposit) + ',00').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', parseInt($(this).val()) - minus_deposit);
                                    $('#remaining').text(0);
                                }
                            }
                        } else if (type_multiple.length == 3) {
                            if (type_multiple[1] == 'cash/transfer') {
                                if ($(this).val() < (total - data_deposit)) {
                                    if ($(this).val() == '') {
                                        $(this).removeClass('is-invalid');
                                        $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', parseInt($(this).val()) - (total - data_deposit));
                                        $('#remaining').text('Rp. ' + formatIDR(total - data_deposit));
                                    } else {
                                        $(this).addClass('is-invalid');
                                        $('#return').text(' Rp. ' + formatIDR(parseInt($(this).val()) - (total - data_deposit)) + ',00').css({
                                            "background-color": "rgba(216, 25, 25, 0.2)",
                                            "color": "#d81c19d1"
                                        }).data('refund', parseInt($(this).val()) - (total - data_deposit));
                                        $('#remaining').text('Rp. ' + formatIDR(parseInt(total - data_deposit) - parseInt($(this).val())));
                                    }
                                } else {
                                    $(this).removeClass('is-invalid');
                                    $('#return').text(' Rp. ' + formatIDR(parseInt($(this).val()) - (total - data_deposit)) + ',00').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', parseInt($(this).val()) - (total - data_deposit));
                                    $('#remaining').text('Rp. ' +0);
                                }
                            }
                        }
                    } else {
                        if(type_multiple.length == 1) {
                            if (type_multiple[0] == 'cash/transfer') {
                                if ($(this).val() < total) {
                                    if ($(this).val() == '') {
                                        $(this).removeClass('is-invalid');
                                        $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', return_pay);
                                        $('#remaining').text('Rp. ' + formatIDR(total));
                                    } else {
                                        $(this).addClass('is-invalid');
                                        $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                                            "background-color": "rgba(216, 25, 25, 0.2)",
                                            "color": "#d81c19d1"
                                        }).data('refund', return_pay);
                                        $('#remaining').text('Rp. ' + formatIDR(remaining));
                                    }
                                } else {
                                    $(this).removeClass('is-invalid');
                                    $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', return_pay);
                                    $('#remaining').text('Rp. ' +0);
                                }
                            }
                        } else if (type_multiple.length == 2) {
                            if (type_multiple[0] == 'cash/transfer') {
                                let remain = total - price_single;;
                                if($(this).val() > remain) {
                                    $(this).removeClass('is-invalid');
                                    $('#return').text(' Rp. ' + formatIDR($(this).val() - remain) + ',00').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', $(this).val() - remain);
                                } else {
                                    if($(this).val() == '') {
                                        $(this).removeClass('is-invalid');
                                        $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', 0);
                                    } else {
                                        $(this).addClass('is-invalid');
                                        $('#return').text(' Rp. ' + formatIDR($(this).val() - remain) + ',00').css({
                                            "background-color": "rgba(216, 25, 25, 0.2)",
                                            "color": "#d81c19d1"
                                        }).data('refund', $(this).val() - remain);
                                    }
                                }
                            } else if (type_multiple[1] == 'cash/transfer') {
                                let remain = total - $(this).val();
                                if($(this).val() > total) {
                                    $('#deposit').text('Rp. 0');
                                    $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', return_pay);
                                } else {
                                    if($(this).val() == '') {
                                        $('#return').text('-').css({
                                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                                    "color": "#19d895"
                                                }).data('refund', 0);
                                        $('#deposit').text('Rp. 0');
                                    } else {
                                        $('#return').text('0').css({
                                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                                    "color": "#19d895"
                                                }).data('refund', 0);
                                        $('#deposit').text('Rp. -' + formatIDR(remain));
                                    }
                                }
                            }
                        } else if (type_multiple.length == 3) {
                            if (type_multiple[1] == 'cash/transfer') {
                                let remain = total - price_single;
                                if($(this).val() > remain) {
                                    $('#deposit').text('Rp. 0');
                                    $('#return').text(' Rp. ' + formatIDR($(this).val() - remain) + ',00').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', $(this).val() - remain);
                                } else {
                                    if($(this).val() == '') {
                                        $('#return').text('-').css({
                                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                                    "color": "#19d895"
                                                }).data('refund', 0);
                                        $('#deposit').text('Rp. 0');
                                    } else {
                                        $('#return').text('0').css({
                                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                                    "color": "#19d895"
                                                }).data('refund', 0);
                                        $('#deposit').text('Rp. -' + formatIDR(remain - $(this).val()));
                                    }
                                }
                            }
                        }
                    }
                }
            });

            $(document).on('change', 'input[name="payment-type[]"]', function(e) {
                click();
                let data_bill = $('#customCheck8').data('bill');
                let data_deposit = $('#customCheck8').data('deposit');
                let price_single = $('.kmt').data('pricesingle');
                let type_multiple = $('input[name="payment-type[]"]:checked')
                    .map(function() {
                        return $(this).val();
                    }).get();
                    console.log(type_multiple)
                let minus_deposit = data_bill - data_deposit;
                let discount = '';
                let deposit = '';
                let cash_transfer = '';
                
                if ($(this).is(':checked')) {
                    // $('.summary').removeClass('d-none');
                    if(data_deposit < data_bill) {
                        $('.remaining').removeClass('d-none');
                        if(type_multiple.length == 1) {
                            if (type_multiple[0] == 'deposit') {
                                $.toast({
                                    text: 'Deposit ditambahkan',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 700,
                                });
                                $('#remaining').text('Rp. ' + formatIDR(minus_deposit));
                            } else if (type_multiple[0] == 'cash/transfer') {
                                $.toast({
                                    text: 'Cash/transfer ditambahkan',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 700,
                                });

                                $('.refund').removeClass('d-none');
                                $('#return').addClass('green').text(0);
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                                $('.bayar-input').val(data_bill);
                                $('#remaining').text('Rp. ' + 0);
                            } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                                $.toast({
                                    text: 'Kupon/limit ditambahkan',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 700,
                                });
                                
                                discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${formatIDR(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();

                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                $('#remaining').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                            }
                        } else if (type_multiple.length == 2) {
                            if (type_multiple[0] == 'deposit') {
                                if (type_multiple[1] == 'cash/transfer') {
                                    $.toast({
                                        text: 'Cash/transfer ditambahkan',
                                        position: 'top-right',
                                        loaderBg: '#fec107',
                                        icon: 'success',
                                        hideAfter: 700,
                                    });

                                    $('.refund').removeClass('d-none');
                                    $('#return').addClass('green').text(0);
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                                    $('.bayar-input').val(minus_deposit);
                                    $('#remaining').text('Rp. ' + formatIDR(minus_deposit - minus_deposit));
                                } else if (type_multiple[1] == 'kupon' || type_multiple[1] == 'limit') {
                                    if (((data_bill - price_single) - data_deposit) < price_single) {
                                        type_multiple.splice(0,1)
                                        $("#customRadioInline6").prop("checked", false);
                                        $("#customRadioInline5").prop('checked', false);
                                        sword();
                                        swal({
                                            title: "",
                                            type: "error",
                                            text: 'Harga satuan limit/kupon tidak terpenuhi',
                                            confirmButtonColor: "#01c853",
                                        });
                                        return false;
                                    } else {
                                        $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                        $('.nilai-total1-td').data('total', data_bill - price_single);
                                        $('#remaining').text('Rp. ' + formatIDR((data_bill - price_single) - data_deposit));
                                        $('.bayar-input').val((data_bill - price_single) - data_deposit);
                                        discount += `<div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Diskon</span>
                                                        <span>Rp. ${formatIDR(price_single)},00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                        $('.discount').html(discount).show();
    
                                        if((data_bill - price_single) > data_deposit) {
                                            remaining();
                                            swal({
                                                title: "",
                                                type: "error",
                                                text: "Gunakan cash/transfer untuk sisa pembayaran",
                                                confirmButtonColor: "#01c853",
                                            });
                                            return false;
                                        }
                                    }
                                }
                            } else if (type_multiple[0] == 'cash/transfer') {
                                if (type_multiple[1] == 'kupon') {
                                    $.toast({
                                        text: 'Kupon ditambahkan',
                                        position: 'top-right',
                                        loaderBg: '#fec107',
                                        icon: 'success',
                                        hideAfter: 700,
                                    });
                                    $('#kupon').text($('#kupon').data('kupon') - 1);

                                    discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${formatIDR(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.refund').removeClass('d-none');
                                    $('.discount').html(discount).show();
                                    $('.bayar-input').val(data_bill - price_single);
                                    $('#return').addClass('green').text(0);
                                    $('#remaining').text('Rp. 0');
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                    $('.nilai-total1-td').data('split', data_bill - price_single);
                                } else if (type_multiple[1] == 'limit') {
                                    $('#limit').text($('#limit').data('limit') - 1);
                                    $.toast({
                                        text: 'Limit ditambahkan',
                                        position: 'top-right',
                                        loaderBg: '#fec107',
                                        icon: 'success',
                                        hideAfter: 700,
                                    });

                                    discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${formatIDR(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();

                                    $('.bayar-input').val(data_bill - price_single);
                                    $('#return').addClass('green').text(0);
                                    $('#remaining').text('Rp. 0');
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                    $('.nilai-total1-td').data('split', data_bill - price_single);
                                }
                            }
                        } else if (type_multiple.length == 3) {
                            if (type_multiple[2] == 'kupon' || type_multiple[2] == 'limit') {
                                if (((data_bill - price_single) - data_deposit) < price_single) {
                                    type_multiple.splice(0,1)
                                    $("#customRadioInline6").prop("checked", false);
                                    $("#customRadioInline5").prop('checked', false);
                                    sword();
                                    swal({
                                        title: "",
                                        type: "error",
                                        text: 'Harga satuan limit/kupon tidak terpenuhi',
                                        confirmButtonColor: "#01c853",
                                    });
                                    return false;
                                } else {
                                    $('.refund').removeClass('d-none');
                                    $('#return').addClass('green').text(0);
                                    $('.bayar-input').val((data_bill - price_single) - data_deposit);
                                    $('.nilai-total1-td').data('total', data_bill - price_single);
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                    discount += `<div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Diskon</span>
                                                        <span>Rp. ${formatIDR(price_single)},00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                        $('.discount').html(discount).show();
                                    $.toast({
                                        text: 'Kupon/limit ditambahkan',
                                        position: 'top-right',
                                        loaderBg: '#fec107',
                                        icon: 'success',
                                        hideAfter: 700,
                                    });
                                    $('#remaining').text('Rp. 0');
                                }
                            }
                        }
                    } else {
                        if(type_multiple.length == 1) {
                            if (type_multiple[0] == 'deposit') {
                                $.toast({
                                    text: 'Deposit ditambahkan',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 700,
                                });
                                // $('#balance').text(formatIDR($('#balance').data('balance') - data_bill));
                                $('#remaining').text('Rp. 0');
                            } else if (type_multiple[0] == 'cash/transfer') {
                                $.toast({
                                    text: 'Cash/transfer ditambahkan',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 700,
                                });
                                $('.refund').removeClass('d-none');
                                $('#return').addClass('green').text(0);
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00');
                                $('.bayar-input').val(data_bill);
                                $('#remaining').text('Rp. ' + 0);
                            } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                                $.toast({
                                    text: 'Kupon/limit ditambahkan',
                                    position: 'top-right',
                                    loaderBg: '#fec107',
                                    icon: 'success',
                                    hideAfter: 700,
                                });
                                
                                discount += `<div class="card mt-2">
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex">
                                                    <span class="flex-grow-1">Diskon</span>
                                                    <span>Rp. ${formatIDR(price_single)},00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                    $('.discount').html(discount).show();

                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                $('#remaining').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                            }
                        } else if (type_multiple.length == 2) {
                            if (type_multiple[0] == 'deposit') {
                                if(type_multiple[1] == 'cash/transfer') {
                                    $('.refund').removeClass('d-none');
                                    $('#return').text('-').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', 0).addClass('green');
                                    $('.deposit').removeClass('d-none');
                                    $('#deposit').text('Rp. 0');
                                    $('.bayar-input').val('');
                                } else if (type_multiple[1] == 'kupon' || type_multiple[1] == 'limit') {
                                    $('.deposit').removeClass('d-none');
                                    $('#deposit').text('Rp. -' + formatIDR(data_bill - price_single));
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                    discount += `<div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Diskon</span>
                                                        <span>Rp. ${formatIDR(price_single)},00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                        $('.discount').html(discount).show();
                                }
                            } else if (type_multiple[0] == 'cash/transfer') {
                                if(type_multiple[1] == 'kupon' || type_multiple[1] == 'limit') {
                                    $('.bayar-input').val(data_bill - price_single).removeClass('is-invalid');
                                    $('#return').text('0').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0);
                                    discount += `<div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Diskon</span>
                                                        <span>Rp. ${formatIDR(price_single)},00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                        $('.discount').html(discount).show();
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                                }
                            }
                        } else if (type_multiple.length == 3) {
                            if(type_multiple[2] == 'kupon' || type_multiple[2] == 'limit') {
                                $('.deposit').removeClass('d-none');
                                $('#deposit').text('Rp. 0');
                                $('.refund').removeClass('d-none');
                                $('#return').addClass('green').text('-');
                                discount += `<div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex">
                                                        <span class="flex-grow-1">Diskon</span>
                                                        <span>Rp. ${formatIDR(price_single)},00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                        $('.discount').html(discount).show();
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill - price_single) + ',00');
                            }
                        }
                    }
                } else {
                    if(data_deposit < data_bill) {
                        if(type_multiple.length == 0) {
                            $('.remaining').addClass('d-none');
                            // $('.summary').addClass('d-none');
                            if ((type_multiple[0] == 'cash/transfer') == false) {
                                $('.refund').addClass('d-none');
                                $('.bayar-input').val('').removeClass('is-invalid');
                                $('#return').text('-').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', 0);
                                $('#return').text('0')
                            }
                        } else if (type_multiple.length == 1) {
                            if((type_multiple[0] == 'deposit') == false) {
                                if(type_multiple[0] == 'cash/transfer') {
                                    $('.bayar-input').val(data_bill);
                                    $('#return').addClass('green').text('0');
                                    $('#remaining').text('Rp. 0');
                                } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                                    $('#remaining').text('Rp. ' + formatIDR(data_bill - price_single));
                                    $('.refund').addClass('d-none');
                                    $('.bayar-input').val('').removeClass('is-invalid');
                                    $('#return').text('-').css({
                                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                                    "color": "#19d895"
                                                }).data('refund', 0);
                                    $('#return').text('0');
                                }
                            } else if (((type_multiple[0] || type_multiple[1]) == 'cash/transfer') == false) {
                                $('.bayar-input').val('').removeClass('is-invalid');
                                $('.refund').addClass('d-none');
                                $('#remaining').text('Rp. ' + formatIDR(data_bill - data_deposit));
                                $('#return').text('-').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', 0);
                                $('#return').text('0')
                            } 
                        } else if (type_multiple.length == 2) {
                            if((type_multiple[0] == 'deposit') == false) {
                                $('.bayar-input').val(data_bill - price_single);
                                $('.nilai-total1-td').data('split', data_bill - price_single);
                            } else if ((type_multiple[1] == 'cash/transfer') == false) {
                                $('.bayar-input').val('').removeClass('is-invalid');
                                $('.refund').addClass('d-none');
                                $('#return').text('-').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', 0);
                                $('#remaining').text('Rp. ' + formatIDR((data_bill - price_single) - data_deposit));
                            }
                        }
                    } else {
                        if (type_multiple.length == 0) {
                            if((type_multiple[0] == 'cash/transfer') == false) {
                                $('.bayar-input').val('').removeClass('is-invalid');
                                $('.refund').addClass('d-none');
                                $('#return').text('-').css({
                                            "background-color": "rgba(25, 216, 149, 0.2)",
                                            "color": "#19d895"
                                        }).data('refund', 0).addClass('green');
                            }
                        } else if(type_multiple.length == 1) {
                            if(type_multiple[0] == 'deposit') {
                                if((type_multiple[1] == 'cash/transfer') == false) {
                                    $('.refund').addClass('d-none');
                                    $('#return').text('-').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', 0).addClass('green');
                                    $('.bayar-input').val('');
                                    $('.deposit').addClass('d-none');
                                    $('#deposit').text('Rp. 0');
                                }
                            } else if (type_multiple[0] == 'cash/transfer') {
                                if((type_multiple[0] == 'deposit') == false) {
                                    $('.deposit').addClass('d-none');
                                    $('#deposit').text('Rp. 0');
                                    $('.bayar-input').val(data_bill);
                                    $('#return').text('0').css({
                                        "background-color": "rgba(25, 216, 149, 0.2)",
                                        "color": "#19d895"
                                    }).data('refund', 0).addClass('green');
                                }
                            } else if (type_multiple[0] == 'kupon' || type_multiple[0] == 'limit') {
                                if((type_multiple[0] == 'deposit') == false) {
                                    $('.deposit').addClass('d-none');
                                    $('#deposit').text('Rp. 0');
                                    $('.nilai-total1-td').text('Rp. ' + formatIDR(data_bill) + ',00').data('total', data_bill);
                                } else if ((type_multiple[0] == 'cash/transfer') == false) {
                                    alert('jkj');
                                }
                            }
                        } else if (type_multiple.length == 2) {
                            if((type_multiple[0] == 'deposit') == false) {
                                $('.deposit').addClass('d-none');
                                $('#deposit').text('Rp. 0');
                            } else if ((type_multiple[1] == 'cash/transfer') == false) {
                                $('.bayar-input').val('');
                                $('.refund').addClass('d-none');
                                $('#return').text('-').css({
                                                "background-color": "rgba(25, 216, 149, 0.2)",
                                                "color": "#19d895"
                                            }).data('refund', 0);
                                $('#deposit').text('Rp. ' + formatIDR((data_bill - price_single)));
                            }
                        }
                    }
                }
            });

            $(document).on('change', 'input[name="payment-type"]', function(e) {
                e.preventDefault();
                click();
                let type_single = $(this).val();
                let tg = window.location.href;
                tg = tg.split("?")
                tg = tg[0];
                tg = tg.split("/");
                page = tg[tg.length - 1];

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    async: true,
                    type: 'GET',
                    data: {
                        type: type_single,
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
                        if (response.status == "VALID") {
                            $('#balance').text(formatIDR(response.price) + ',00');
                            $('#kupon').text(formatIDR(parseInt(response.kupon)));
                            $('#limit').text(formatIDR(parseInt(response.limit)));

                            let html = '';
                            let discount = '';
                            let price_discount = 0;
                            let price = 0;
                            if (type_single == 1) {
                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                <span class="flex-grow-1">${val.name} ${response.orders[b].category == 'default' ? '| game' : ''} x ${val.qty}</span>
                                                <small>${response.orders[b].category == 'default' ? 'limit gratis' : 'Rp. ' + formatIDR(val.pricesingle) + ',00'}</small>
                                            </div>`;
                                    price_discount += val.pricesingle;
                                    price += val.price;
                                });
                                $('.items-replace').html(html).removeClass('d-none');
                                $('.items-default').addClass('d-none');
                                $('.refund').addClass('d-none');

                                discount += `<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${formatIDR(price_discount)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $('.discount').html(discount).show();
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response.total_price - response.price_default) + ',00');

                                $('#return').text('-').addClass('green').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                });

                                $('#cash-transfer').html(
                                    `<div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" min="0"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            class="form-control number-input input-notzero bayar-input"
                                            name="bayar" placeholder="Masukkan nominal bayar"
                                            autocomplete="off">
                                    </div>`
                                ).hide().prev().addClass('mb-2');
                            } else if (type_single == 2) {
                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                <span class="flex-grow-1">${val.name} ${response.orders[b].category == 'default' ? '| game' : ''} x ${val.qty}</span>
                                                <small>${response.orders[b].category == 'default' ? 'kupon gratis' : 'Rp. ' + formatIDR(val.pricesingle) + ',00'}</small>
                                            </div>`;
                                    price_discount += val.pricesingle;
                                    price += val.price;
                                });
                                $('.items-replace').html(html).removeClass('d-none');
                                $('.items-default').addClass('d-none');
                                $('.refund').addClass('d-none');

                                discount += `<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${formatIDR(price_discount)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $('.discount').html(discount).show();

                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response.total_price - response.price_default) + ',00');

                                $('#return').text('-').addClass('green').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                });
                                $('#cash-transfer').html(
                                    `<div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" min="0"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            class="form-control number-input input-notzero bayar-input"
                                            name="bayar" placeholder="Masukkan nominal bayar"
                                            autocomplete="off">
                                    </div>`
                                ).hide().prev().addClass('mb-2');
                            } else if (type_single == 4) {
                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                                <small>${'Rp. ' + formatIDR(val.price) + ',00'}</small>
                                            </div>`;
                                });
                                $('.items-replace').html(html).removeClass('d-none');
                                $('.items-default').addClass('d-none');
                                $('.discount').hide();
                                $('.refund').addClass('d-none');
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response.total_price) + ',00');

                                $('#return').text('-').addClass('green').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                });
                                $('#cash-transfer').html(
                                    `<div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input type="text" min="0"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            class="form-control number-input input-notzero bayar-input"
                                            name="bayar" placeholder="Masukkan nominal bayar"
                                            autocomplete="off">
                                    </div>`
                                ).hide().prev().addClass('mb-2');
                            } else {
                                $('#cash-transfer').html(
                                    `<div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" min="0"
                                                onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                class="form-control number-input input-notzero bayar-input"
                                                name="bayar" placeholder="Masukkan nominal bayar"
                                                autocomplete="off">
                                        </div>`
                                ).show().prev().removeClass('mb-2');
                                $('#return').text('-').addClass('green').css({
                                    "background-color": "rgba(25, 216, 149, 0.2)",
                                    "color": "#19d895"
                                });

                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                    <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                                    <small>${'Rp. ' + formatIDR(val.price) + ',00'}</small>
                                                </div>`;
                                });

                                $('.items-replace').html(html).removeClass('d-none');
                                $('.items-default').addClass('d-none');
                                $('.discount').hide();
                                $('.refund').removeClass('d-none');
                                $('#return').text('Rp. ' + 0);
                                $('.bayar-input').val(response.total_price);
                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response.total_price) + ',00');
                            }

                            $.toast({
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });
                        } else {
                            $.toast({
                                text: response.message,
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'error',
                                hideAfter: 700,
                            });
                            return false;
                        }
                    }
                });
            });

            $(document).on('click', '#pay', function(e) {
                e.preventDefault();
                let type = $('input[type=radio][name=payment]:checked').val();
                let type_single = $("input[name='payment-type']:checked").val();
                let type_multiple = $("input[name='payment-type[]']:checked")
                    .map(function() {
                        return $(this).val();
                    }).get();
                    console.log(type_multiple.length)
                let order_number = $('#order-number').text();
                let bayar_input = $('.bayar-input').val();
                let refund = $('#return').data('refund');
                let tg = window.location.href;
                tg = tg.split("?");
                tg = tg[0];
                tg = tg.split("/");
                page = tg[tg.length - 1];

                let url = "{{ route('invoice.print', ':id') }}";
                url = url.replace(':id', page);
                let data_deposit = $('#customCheck8').data('deposit');
                let data_bill = $('#customCheck8').data('bill');
                let pay_deposit = data_bill - data_deposit;
                let pay_cash = pay_deposit - bayar_input;

                if (type_multiple[0] == 'cash/transfer') {
                    if (!bayar_input) {
                        sword();
                        swal({
                            title: "",
                            type: "error",
                            text: "Nominal wajib diisi",
                            confirmButtonColor: "#01c853",
                        });
                        return false;
                    }
                } else if (type_multiple[1] == 'cash/transfer') {
                    if (!bayar_input) {
                        sword();
                        swal({
                            title: "",
                            type: "error",
                            text: "Nominal wajib diisi",
                            confirmButtonColor: "#01c853",
                        });
                        return false;
                    }
                }

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
                                type: type,
                                type_single: type_single,
                                type_multiple: type_multiple,
                                page: parseFloat(page),
                                order_number: order_number,
                                bayar_input: bayar_input,
                                pay_deposit: pay_deposit,
                                refund: refund
                            },
                            url: "{{ route('pay') }}",
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
                                if (response.status == "VALID") {
                                    bell();
                                    swal({
                                        title: '',
                                        type: "success",
                                        text: response.message,
                                        confirmButtonColor: "#01c853",
                                    }, function(isConfirm) {
                                        invoice(url,
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
