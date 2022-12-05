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
                                                            <span class="mr-2" style="width:40px;">ALT+4</span>
                                                            <span class="text-left text-capitalize"> Aktifkan form tamu</span>
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
                                                        <img src="{{ asset('cash-on-delivery.png') }}" alt="cash" width="30" height="30">
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
                                                        <span class="nilai-total1-td green" data-total="{{ $totalPrice }}">{{ formatrupiah($totalPrice) }}</span>
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
                                                <span style="font-size: small;" id="order-number">{{ $order_number }}</span>
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
                                                        <small>{{ formatrupiah($cart['price']) }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('proses_reguler') }}" class="btn btn-primary btn-sm mt-2" id="back">Kembali</a>
                                    <button id="reset" class="btn btn-sm btn-danger mt-2">Batalkan</button>
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
    <script src="{{ asset('dist/asset_offline/checkout_reguler.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
</body>
</html>
