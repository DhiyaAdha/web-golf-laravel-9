<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Metode Pembayaran</title>
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.PNG') }}">
    <link rel="icon" href="{{ asset('tgcc144.PNG') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet"type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
                                                <span class=" text-big" id="balance"
                                                    data-balance="{{ $deposit->balance }}">{{ formatrupiah($deposit->balance) ?? '0' }}</span>
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
                                            <span class="text-capitalize">Kupon</span>
                                            <div class="d-flex">
                                                <span class=" text-big" id="kupon"
                                                    data-kupon="{{ $log_limit->quota_kupon }}">{{ $log_limit->quota_kupon ?? '0' }}</span>
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
                                                <span class="text-big" id="limit"
                                                    data-limit="{{ $log_limit->quota }}">{{ $log_limit->quota ?? '0' }}</span>
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
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Metode Pembayaran</span>
                                                <div class="d-flex">
                                                    <div class="custom-control custom-radio mr-2">
                                                        <input type="radio" name="payment" id="wk"
                                                            class="custom-control-input" value="single" checked>
                                                        <label class="custom-control-label cursor"
                                                            for="wk">Single</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="payment" id="kw"
                                                            class="custom-control-input" value="multiple">
                                                        <label class="custom-control-label cursor"
                                                            for="kw">Split</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="single">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center choose"
                                                            style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                style="width:100%;">
                                                                <input type="radio" id="customRadioInline4"
                                                                    name="payment-type" value="4"
                                                                    class="custom-control-input">
                                                                <label class="custom-control-label"
                                                                    for="customRadioInline4"
                                                                    style="width: 100%;cursor:pointer;">
                                                                    <div
                                                                        class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                        <strong>Deposit</strong>
                                                                        <small class="text-muted mb-2">Deposit akan
                                                                            berkurang sesuai dengan tagihan</small>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <img src="{{ asset('deposit.png') }}" alt="deposit"
                                                                width="26" height="26">
                                                        </div>
                                                        <div class="d-flex align-items-center mt-2 choose"
                                                            style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                style="width:100%;">
                                                                <input type="radio" id="customRadioInline3"
                                                                    name="payment-type" value="3"
                                                                    class="custom-control-input">
                                                                <label class="custom-control-label"
                                                                    for="customRadioInline3"
                                                                    style="width: 100%;cursor:pointer;">
                                                                    <div
                                                                        class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                        <strong>Cash/Transfer</strong>
                                                                        <small class="text-muted">Tunjukan bukti
                                                                            transfer</small>
                                                                        <div class="form-group mt-2 mb-2"
                                                                            id="cash-transfer">
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <img src="{{ asset('cash-on-delivery.png') }}"
                                                                alt="cash" width="30" height="30">
                                                        </div>

                                                        @if (count($package_default) == 1)
                                                            @if ($item_default == 1)
                                                                @if (count($package_additional) == 0 && count($package_others) == 0)
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline2"
                                                                                name="payment-type" value="2"
                                                                                class="custom-control-input">
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline2"
                                                                                style="width: 100%;cursor:pointer;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <small class="text-muted">Kupon
                                                                                        otomatis
                                                                                        akan
                                                                                        berkurang</small>
                                                                                    <small
                                                                                        class="text-muted mb-2">Kupon
                                                                                        berlaku
                                                                                        hanya untuk 1 game</small>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('coupon.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline1"
                                                                                name="payment-type" value="1"
                                                                                class="custom-control-input">
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline1"
                                                                                style="width: 100%;cursor:pointer;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <small class="text-muted">Limit
                                                                                        otomatis akan
                                                                                        berkurang</small>
                                                                                    <small
                                                                                        class="text-muted mb-2">Limit
                                                                                        berlaku hanya untuk 1
                                                                                        game</small>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('credit-limit.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline2"
                                                                                class="custom-control-input" disabled>
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline2"
                                                                                style="width: 100%;cursor:no-drop;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <small class="mb-2">
                                                                                        <i
                                                                                            class="text-muted text-justify">
                                                                                            Satu kupon hanya berlaku
                                                                                            untuk satu jenis permainan
                                                                                            golf</i>
                                                                                    </small>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('coupon.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline1"
                                                                                class="custom-control-input" disabled>
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline1"
                                                                                style="width: 100%;cursor:no-drop;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <small class="mb-2">
                                                                                        <i
                                                                                            class="text-muted text-justify">
                                                                                            Satu limit hanya berlaku
                                                                                            untuk satu jenis permainan
                                                                                            golf</i>
                                                                                    </small>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('credit-limit.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="d-flex align-items-center mt-2 choose"
                                                                    style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                    <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                        style="width:100%;">
                                                                        <input type="radio" id="customRadioInline2"
                                                                            class="custom-control-input" disabled>
                                                                        <label class="custom-control-label"
                                                                            for="customRadioInline2"
                                                                            style="width: 100%;cursor:no-drop;">
                                                                            <div
                                                                                class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Kupon</strong>
                                                                                <small class="mb-2">
                                                                                    <i class="text-muted text-justify">
                                                                                        Satu kupon hanya berlaku
                                                                                        untuk satu jenis permainan
                                                                                        golf</i>
                                                                                </small>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <img src="{{ asset('coupon.png') }}"
                                                                        alt="cash" width="30" height="30">
                                                                </div>
                                                                <div class="d-flex align-items-center mt-2 choose"
                                                                    style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                    <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                        style="width:100%;">
                                                                        <input type="radio" id="customRadioInline1"
                                                                            class="custom-control-input" disabled>
                                                                        <label class="custom-control-label"
                                                                            for="customRadioInline1"
                                                                            style="width: 100%;cursor:no-drop;">
                                                                            <div
                                                                                class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Limit</strong>
                                                                                <small class="mb-2">
                                                                                    <i class="text-muted text-justify">
                                                                                        Satu limit hanya berlaku
                                                                                        untuk satu jenis permainan
                                                                                        golf</i>
                                                                                </small>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <img src="{{ asset('credit-limit.png') }}"
                                                                        alt="cash" width="30" height="30">
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="d-flex align-items-center mt-2 choose"
                                                                style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                    style="width:100%;">
                                                                    <input type="radio" id="customRadioInline2"
                                                                        class="custom-control-input" disabled>
                                                                    <label class="custom-control-label"
                                                                        for="customRadioInline2"
                                                                        style="width: 100%;cursor:no-drop;">
                                                                        <div
                                                                            class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Kupon</strong>
                                                                            <small class="mb-2">
                                                                                <i class="text-muted text-justify">
                                                                                    Satu kupon hanya berlaku
                                                                                    untuk satu jenis permainan
                                                                                    golf</i>
                                                                            </small>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <img src="{{ asset('coupon.png') }}" alt="cash"
                                                                    width="30" height="30">
                                                            </div>
                                                            <div class="d-flex align-items-center mt-2 choose"
                                                                style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                    style="width:100%;">
                                                                    <input type="radio" id="customRadioInline1"
                                                                        class="custom-control-input" disabled>
                                                                    <label class="custom-control-label"
                                                                        for="customRadioInline1"
                                                                        style="width: 100%;cursor:no-drop;">
                                                                        <div
                                                                            class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Limit</strong>
                                                                            <small class="mb-2">
                                                                                <i class="text-muted text-justify">
                                                                                    Satu limit hanya berlaku
                                                                                    untuk satu jenis permainan
                                                                                    golf</i>
                                                                            </small>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <img src="{{ asset('credit-limit.png') }}"
                                                                    alt="cash" width="30" height="30">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="multiple" class="d-none">
                                                <div class="card mt-2">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center choose"
                                                            style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-checkbox"
                                                                style="width:100%;">
                                                                <input type="checkbox" name="payment-type[]"
                                                                    value="deposit"
                                                                    data-deposit="{{ $deposit->balance }}"
                                                                    data-bill="{{ (int) ceil($totalPrice) }}"
                                                                    class="custom-control-input" id="customCheck8">
                                                                <label class="custom-control-label" for="customCheck8"
                                                                    style="width: 100%; cursor:pointer;">
                                                                    <div
                                                                        class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                        <strong>Deposit</strong>
                                                                        <small class="text-muted mb-2">Deposit akan
                                                                            berkurang sesuai dengan tagihan</small>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <img src="{{ asset('deposit.png') }}" alt="deposit"
                                                                width="26" height="26">
                                                        </div>
                                                        {{-- @if ($deposit->balance < (int) ceil($totalPrice)) --}}
                                                        <div class="d-flex align-items-center mt-2 choose"
                                                            style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                            <div class="flex-grow-1 custom-control custom-checkbox"
                                                                style="width:100%;">
                                                                <input type="checkbox" name="payment-type[]"
                                                                    value="cash/transfer" class="custom-control-input"
                                                                    id="customCheck7">
                                                                <label class="custom-control-label" for="customCheck7"
                                                                    style="width: 100%; cursor:pointer;">
                                                                    <div
                                                                        class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                        <strong>Cash/Transfer</strong>
                                                                        <small class="text-muted">Tunjukan bukti
                                                                            transfer</small>
                                                                        <div class="form-group mt-2 mb-2"
                                                                            id="cashtransfer">
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <img src="{{ asset('cash-on-delivery.png') }}"
                                                                alt="cash" width="30" height="30">
                                                        </div>
                                                        {{-- @else
                                                            <div class="d-flex align-items-center mt-2 choose"
                                                                style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                <div class="flex-grow-1 custom-control custom-checkbox"
                                                                    style="width:100%;">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input" id="customCheck7"
                                                                        disabled>
                                                                    <label class="custom-control-label"
                                                                        for="customCheck7"
                                                                        style="width: 100%; cursor:no-drop;">
                                                                        <div
                                                                            class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                            <strong>Cash/Transfer</strong>
                                                                            <small><i class="text-muted">Saldo
                                                                                    mencukupi</i></small>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <img src="{{ asset('cash-on-delivery.png') }}"
                                                                    alt="cash" width="30" height="30">
                                                            </div>
                                                        @endif --}}
                                                    </div>
                                                </div>
                                                @if (count($package_default) == 1)
                                                    @if ($item_default >= 1)
                                                        <div class="card mt-2">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <strong class="flex-grow-1">Gunakan
                                                                        Limit/Kupon</strong>
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="customSwitch2" checked>
                                                                        <label class="custom-control-label cursor"
                                                                            for="customSwitch2"></label>
                                                                    </div>
                                                                </div>
                                                                <div id="hide-limit">
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline6"
                                                                                name="payment-type[]" value="kupon"
                                                                                class="custom-control-input">
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline6"
                                                                                style="width: 100%; cursor:pointer;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <div
                                                                                        class="message-limit d-flex flex-column">
                                                                                        <small class="text-muted">Kupon
                                                                                            otomatis akan
                                                                                            berkurang</small>
                                                                                        <small
                                                                                            class="text-muted mb-2">Kupon
                                                                                            berlaku hanya
                                                                                            untuk 1 game</small>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('coupon.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline5"
                                                                                name="payment-type[]" value="limit"
                                                                                class="custom-control-input">
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline5"
                                                                                style="width: 100%; cursor:pointer;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <div
                                                                                        class="message-kupon d-flex flex-column">
                                                                                        <small class="text-muted">Kupon
                                                                                            otomatis akan
                                                                                            berkurang</small>
                                                                                        <small
                                                                                            class="text-muted mb-2">Kupon
                                                                                            berlaku hanya
                                                                                            untuk 1 game</small>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('credit-limit.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="card mt-2">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <strong class="flex-grow-1">Gunakan
                                                                        Limit/Kupon</strong>
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            id="customSwitch2">
                                                                        <label class="custom-control-label cursor"
                                                                            for="customSwitch2"></label>
                                                                    </div>
                                                                </div>
                                                                <div id="hide-limit" class="d-none">
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline6"
                                                                                class="custom-control-input" disabled>
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline6"
                                                                                style="width: 100%; cursor:pointer;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Kupon</strong>
                                                                                    <small class="text-muted">Kupon
                                                                                        otomatis akan
                                                                                        berkurang</small>
                                                                                    <small
                                                                                        class="text-muted mb-2">Kupon
                                                                                        berlaku hanya
                                                                                        untuk 1 game</small>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <img src="{{ asset('coupon.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                    <div class="d-flex align-items-center mt-2 choose"
                                                                        style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                        <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                            style="width:100%;">
                                                                            <input type="radio"
                                                                                id="customRadioInline5"
                                                                                class="custom-control-input" disabled>
                                                                            <label class="custom-control-label"
                                                                                for="customRadioInline5"
                                                                                style="width: 100%; cursor:pointer;">
                                                                                <div
                                                                                    class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                    <strong>Limit</strong>
                                                                                    <small class="text-muted">Limit
                                                                                        otomatis akan
                                                                                        berkurang</small>
                                                                                    <small
                                                                                        class="text-muted mb-2">Limit
                                                                                        berlaku hanya
                                                                                        untuk 1 game</small>
                                                                                </div>
                                                                            </label>
                                                                            <small><i class="text-muted">Limit hanya
                                                                                    berlaku
                                                                                    untuk satu jenis
                                                                                    permainan</i></small>
                                                                        </div>
                                                                        <img src="{{ asset('credit-limit.png') }}"
                                                                            alt="cash" width="30"
                                                                            height="30">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="card mt-2">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <strong class="flex-grow-1">Gunakan
                                                                    Limit/Kupon</strong>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input"
                                                                        id="customSwitch2">
                                                                    <label class="custom-control-label cursor"
                                                                        for="customSwitch2"></label>
                                                                </div>
                                                            </div>
                                                            <div id="hide-limit" class="d-none">
                                                                <div class="d-flex align-items-center mt-2 choose"
                                                                    style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                    <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                        style="width:100%;">
                                                                        <input type="radio" id="customRadioInline6"
                                                                            class="custom-control-input" disabled>
                                                                        <label class="custom-control-label"
                                                                            for="customRadioInline6"
                                                                            style="width: 100%; cursor:no-drop;">
                                                                            <div
                                                                                class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Kupon</strong>
                                                                                <small><i class="text-muted">Kupon
                                                                                        hanya berlaku
                                                                                        untuk satu jenis
                                                                                        permainan</i></small>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <img src="{{ asset('coupon.png') }}"
                                                                        alt="cash" width="30" height="30">
                                                                </div>
                                                                <div class="d-flex align-items-center mt-2 choose"
                                                                    style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                                                    <div class="flex-grow-1 custom-control custom-radio custom-control-inline"
                                                                        style="width:100%;">
                                                                        <input type="radio" id="customRadioInline5"
                                                                            class="custom-control-input" disabled>
                                                                        <label class="custom-control-label"
                                                                            for="customRadioInline5"
                                                                            style="width: 100%; cursor:no-drop;">
                                                                            <div
                                                                                class="d-flex flex-column flex-grow-1 justify-content-center">
                                                                                <strong>Limit</strong>
                                                                                <small><i class="text-muted">Limit
                                                                                        hanya berlaku
                                                                                        untuk satu jenis
                                                                                        permainan</i></small>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <img src="{{ asset('credit-limit.png') }}"
                                                                        alt="cash" width="30" height="30">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card mt-2 d-none">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column">
                                                        <span>Uang kembali</span>
                                                        <span class="green" id="return">-</span>
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
                                                        <span class="flex-grow-1">{{ $cart['name'] }} x
                                                            {{ $cart['qty'] }}</span>
                                                        <small>Rp. {{ formatrupiah($cart['price']) }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="pay"
                                    class="btn btn-sm btn-success btn-block mt-2">Bayar</button>
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
    <script src="https://unpkg.com/@popperjs/core@2"></script>
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
                        $("input[name='payment-type[]']").prop('checked', false);
                        $('#single').show();
                        $('#multiple').hide().addClass('d-none');
                        $('.summary').hide();
                        $('.remainder-hide').hide();
                        $('#balance').text(formatIDR($('#balance').data('balance') + ',00'));
                        break;
                    case 'multiple':
                        $("input[name=payment-type]").prop('checked', false);
                        $('#single').hide();
                        $('#multiple').show().removeClass('d-none');
                        $('.bayar-input').val(null);
                        $('.card:nth-child(4)').addClass('d-none');
                        $('#cash-transfer').hide();
                        $(`<div class="card mt-2 summary">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Ringkasan Pembayaran</span>
                                            </div>
                                            <div id="point-summary"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2 remainder-hide">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Sisa Pembayaran</span>
                                                <span class="remainder"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`).insertAfter('.card:nth-child(3)');
                        $('#balance').text(formatIDR($('#balance').data('balance') + ',00'));
                        $('.nilai-total1-td').text('Rp. ' + formatIDR($('.nilai-total1-td').data('total')) +
                            ',00');
                        break;
                }
            });

            $(document).on('change', '#customSwitch2', function(e) {
                if ($(this).prop('checked')) {
                    $('#hide-limit').show().removeClass('d-none');
                } else {
                    $('#hide-limit').hide().addClass('d-none');
                    $("#customRadioInline6").prop('checked', false).val(null);
                    $("#customRadioInline5").prop('checked', false).val(null);
                }
            });

            $(document).on('input', '.bayar-input', function(e) {
                e.preventDefault();
                let total = $('.nilai-total1-td').data('total');
                let return_pay = parseInt($(this).val()) - parseInt(total);
                let data_deposit = $('#customCheck8').data('deposit');

                if ($('input[type=radio][name=payment]:checked').val() == 'single') {
                    if ($(this).val() < total) {
                        $(this).addClass('is-invalid');
                        $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                            "background-color": "rgba(216, 25, 25, 0.2)",
                            "color": "#d81c19d1"
                        });
                    } else {
                        $(this).removeClass('is-invalid');
                        $('#return').text(' Rp. ' + formatIDR(return_pay) + ',00').css({
                            "background-color": "rgba(25, 216, 149, 0.2)",
                            "color": "#19d895"
                        });
                    }
                } else {
                    $('.cash-split').text('- ' + formatIDR($(this).val()));
                    if ($("input[name='payment-type[]']:checked").val() == 'cash/transfer') {
                        $('.remainder').text($(this).val() - total);
                        if ($(this).val() < total) {
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                            swal({
                                title: "",
                                type: "error",
                                text: "Nominal sisa pembayaran Rp. " + total,
                                confirmButtonColor: "#01c853",
                            });
                            return false;
                        }
                    } else if ($("input[name='payment-type[]']:checked").val() == 'deposit') {
                        $('.remainder').text($(this).val() - (total - data_deposit));
                        if ($(this).val() < (total - data_deposit)) {
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                            swal({
                                title: "",
                                type: "error",
                                text: "Nominal sisa pembayaran Rp. " + (total - data_deposit),
                                confirmButtonColor: "#01c853",
                            });
                            return false;
                        }
                    }
                }
            });

            $(document).on('change', 'input[name="payment-type[]"]', function(e) {
                let html = '';
                let data_deposit = $('#customCheck8').data('deposit');
                let data_bill = $('#customCheck8').data('bill');
                let price_single = $('.kmt').data('pricesingle');
                if ($(this).is(':checked')) {
                    if ($(this).val() == 'cash/transfer') {
                        $('#cashtransfer').html(
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
                        html += `<div class="d-flex">
                                            <small class="flex-grow-1">Cash/Transfer</small>
                                            <span class="cash-split"></span>
                                        </div>`;
                        $('#point-summary').html(html).show();
                        $.toast({
                            text: 'Cash/transfer telah dipilih',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'success',
                            hideAfter: 700,
                        });
                        return true;
                    } else if ($(this).val() == 'deposit') {
                        if (data_deposit != 0) {
                            if (data_deposit > data_bill) {
                                $('#balance').text(formatIDR(data_deposit - data_bill) + ',00');
                                html += `<div class="d-flex">
                                            <small class="flex-grow-1">Deposit</small>
                                            <span >- ${formatIDR(data_bill)}</span>
                                        </div>`;
                                $('#point-summary').html(html).show();
                            } else {
                                if ((data_bill - data_deposit) < price_single) {
                                    $('.message-kupon').addClass('d-none').html(
                                        `<small><i class="text-muted">Harga satuan permainan tidak memenuhi kupon</i></small>`
                                    );
                                    $('.message-limit').addClass('d-none').html(
                                        `<small><i class="text-muted">Harga satuan permainan tidak memenuhi limit</i></small>`
                                    );
                                    $('#customRadioInline6').attr('disabled', true).next().css('cursor',
                                        'no-drop !important');
                                    $('#customRadioInline5').attr('disabled', true).next().css('cursor',
                                        'no-drop !important');
                                } else {
                                    $('#balance').text(formatIDR(data_deposit - data_deposit) + ',00');
                                    html += `<div class="d-flex">
                                                <small class="flex-grow-1">Deposit</small>
                                                <span >- ${formatIDR(data_deposit)}</span>
                                            </div>`;
                                    $('#point-summary').html(html).show();
                                    $('.remainder').text('- ' + (data_bill - data_deposit));
                                }
                            }
                            $.toast({
                                text: 'Deposit telah dipilih',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });
                            return true;
                        } else {
                            $.toast({
                                text: 'Saldo tidak mencukupi',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'error',
                                hideAfter: 700,
                            });
                            return false;
                        }
                        console.log('wqwq');
                    } else if ($(this).val() == 'limit') {
                        if ($('#limit').data('limit') == 0) {
                            $.toast({
                                text: 'Limit tidak mencukupi',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'error',
                                hideAfter: 700,
                            });
                            return false;
                        } else {
                            $('#limit').text($('#limit').data('limit') - 1);
                            $.toast({
                                text: 'Limit telah dipilih',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });
                            return true;
                        }

                        $('#cashtransfer').html(
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
                        ).show().prev().addClass('mb-2');
                    } else {
                        if ($('#kupon').data('kupon') == 0) {
                            $.toast({
                                text: 'Kupon tidak mencukupi',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'error',
                                hideAfter: 700,
                            });
                            return false;
                        } else {
                            $('#kupon').text($('#kupon').data('kupon') - 1);
                            $.toast({
                                text: 'Kupon telah dipilih',
                                position: 'top-right',
                                loaderBg: '#fec107',
                                icon: 'success',
                                hideAfter: 700,
                            });
                            return true;
                        }

                        $('#cashtransfer').html(
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
                        ).show().prev().addClass('mb-2');
                    }
                } else {
                    $('#balance').text(formatIDR(data_deposit) + ',00');
                    $('#point-summary').hide();
                    $('.remainder').text('- ' + formatIDR(data_bill));
                    $('#return').text('-').css({
                        "background-color": "rgba(25, 216, 149, 0.2)",
                        "color": "#19d895"
                    });
                    $('#cashtransfer').html(
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
                }
            });

            $(document).on('change', 'input[name="payment-type"]', function(e) {
                e.preventDefault();
                let type = $(this).val();
                let tg = window.location.href;
                tg = tg.split("?")
                tg = tg[0];
                tg = tg.split("/");
                page = tg[tg.length - 1];

                if (type == 3) {
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
                    $('.card:nth-child(4)').removeClass('d-none');
                } else {
                    $('.card:nth-child(4)').addClass('d-none');
                    $('#return').text('-').css({
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
                        if (response.status == "VALID") {
                            $('#balance').text(formatIDR(response.price) + ',00');
                            $('#kupon').text(formatIDR(parseInt(response.kupon)));
                            $('#limit').text(formatIDR(parseInt(response.limit)));

                            let html = '';
                            let price_discount = 0;
                            let price = 0;
                            if (type == 1) {
                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                                <small>${response.orders[b].category == 'default' ? 'limit gratis' : 'Rp. ' + formatIDR(val.pricesingle) + ',00'}</small>
                                            </div>`;
                                    price_discount += val.pricesingle;
                                    price += val.price;
                                });
                                $('.items-default').html(html);
                                $(`<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${formatIDR(price_discount)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`).insertAfter('.card:nth-child(3)');

                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response
                                    .total_price - response
                                    .price_default) + ',00');
                            } else if (type == 2) {
                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                                <small>${response.orders[b].category == 'default' ? 'kupon gratis' : 'Rp. ' + formatIDR(val.pricesingle) + ',00'}</small>
                                            </div>`;
                                });
                                $('.items-default').html(html);

                                $(`<div class="card mt-2">
                                    <div class="card-body">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <span class="flex-grow-1">Diskon</span>
                                                <span>Rp. ${formatIDR(price_discount)},00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>`).insertAfter('.card:nth-child(3)');

                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response
                                    .total_price - response
                                    .price_default) + ',00');
                            } else {
                                $.each(response.orders, function(b, val) {
                                    html += `<div class="d-flex">
                                                <span class="flex-grow-1">${val.name} x ${val.qty}</span>
                                                <small>${'Rp. ' + formatIDR(val.pricesingle) + ',00'}</small>
                                            </div>`;
                                });
                                $('.items-default').html(html);

                                $('.nilai-total1-td').text('Rp. ' + formatIDR(response
                                    .total_price) + ',00');
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

            $(document).on('click', '#pay', function(e) {
                e.preventDefault();
                let type = $('input[type=radio][name=payment]:checked').val();
                let type_single = $("input[name='payment-type']:checked").val();
                let type_multiple = $("input[name='payment-type[]']:checked")
                    .map(function() {
                        return $(this).val();
                    }).get();
                console.log(type_multiple);
                let order_number = $('#order-number').text();
                let bayar_input = $('.bayar-input').val();
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
                let price_single = $('.items-default').data('pricesingle');

                if (type_multiple[0] == 'cash/transfer') {
                    if (!bayar_input) {
                        swal({
                            title: "",
                            type: "error",
                            text: "Nominal wajib diisi",
                            confirmButtonColor: "#01c853",
                        });
                        return false;
                    } else {
                        // if (bayar_input < data_bill) {
                        //     swal({
                        //         title: "",
                        //         type: "error",
                        //         text: "Nominal tidak terpenuhi",
                        //         confirmButtonColor: "#01c853",
                        //     });
                        //     return false;
                        // }
                    }
                } else if (type_multiple[1] == 'cash/transfer') {
                    if (!bayar_input) {
                        swal({
                            title: "",
                            type: "error",
                            text: "Nominal wajib diisi",
                            confirmButtonColor: "#01c853",
                        });
                        return false;
                    } else {
                        // if (bayar_input < pay_deposit) {
                        //     swal({
                        //         title: "",
                        //         type: "error",
                        //         text: "Nominal tidak terpenuhi",
                        //         confirmButtonColor: "#01c853",
                        //     });
                        //     return false;
                        // }
                    }
                }

                swal({
                    title: "",
                    text: "Lakukan pembayaran ?",
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
                                if (response.status == "INVALID") {
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
                                        invoice(url,
                                            'Print Invoice');
                                        window.close();
                                    });
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
