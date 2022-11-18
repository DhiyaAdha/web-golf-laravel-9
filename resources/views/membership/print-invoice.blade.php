<html>
<head>
    <title>{{ $log_transaction->order_number }}</title>
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <style>
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
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        @media print {
            .receipt-template {
                width: 100%;
            }
        }
        .receipt-template {
            margin: 0 auto;
            width: 56mm;
            background: #FFF;
        }

        .receipt-template .text-small {
            font-size: 10px;
        }

        .receipt-template .block {
            display: block;
        }

        .receipt-template .bold {
            font-weight: 700;
        }

        .receipt-template .italic {
            font-style: italic;
        }

        .receipt-template .align-right {
            text-align: right;
        }

        .receipt-template .align-center {
            text-align: center;
        }

        .receipt-template .main-title {
            font-size: 12px;
            font-weight: 700;
            text-align: center;
            margin: 10px 0 5px 0;
            padding: 0;
        }

        .receipt-template .sub-title {
            font-size: 10px;
            font-weight: 700;
            margin: 10px 0 5px 0;
        }

        .receipt-template table {
            width: 100%;
        }

        .receipt-template td,
        .receipt-template th {
            font-size: 10px;
        }

        .receipt-template .info-area {
            font-size: 10px;
            line-height: 1.222;
        }

        .receipt-template .listing-area {
            line-height: 1.222;
        }

        .receipt-template .listing-area table {}

        .receipt-template .listing-area table thead tr {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            font-weight: 700;
        }

        .receipt-template .listing-area table tbody tr:last-child {
            border-bottom: none;
        }

        .receipt-template .listing-area table td {
            vertical-align: top;
        }

        .receipt-template .info-area table thead tr {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .receipt-template .receipt-header {
            text-align: center;
        }

        .receipt-template .receipt-header .logo-area {
            width: 50px;
            height: 50px;
            margin: 0 auto;
        }

        .receipt-template .receipt-header .logo-area img.logo {
            display: inline-block;
            max-width: 100%;
            max-height: 100%;
        }

        .receipt-template .receipt-header .address-area {
            margin-top: 5px;
            margin-bottom: 5px;
            line-height: 1;
        }

        .receipt-template .receipt-header .info {
            font-size: 10px;
        }

        .receipt-template .receipt-header .store-name {
            font-size: 10px;
            font-weight: 700;
            margin: 0;
            padding: 0;
        }

        /*Calculation Area*/
        .receipt-template .calculation-area {
            border-top: 2px solid #000;
            font-weight: bold;
        }

        .receipt-template .calculation-area table td {
            text-align: right;
        }

        .receipt-template .calculation-area table td:nth-child(2) {
            border-bottom: 1px dashed #000;
        }

        .receipt-template .barcode-area {
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .receipt-template .footer-area {
            line-height: 1.222;
            font-size: 10px;
        }

        </style>
        <script>window.console = window.console || function(t) {};</script>
        <script>
            if (document.location.search.match(/type=embed/gi)) {
                window.parent.postMessage("resize", "*");
            }
        </script>
</head>
<body translate="no" id="print">
    <section class="receipt-template">
        <header class="receipt-header">
            <div class="logo-area">
                <img class="logo" src="{{ asset('tgcc.png') }}">
            </div>
            <span class="mt-2 mb-2">Tritih Golf & Country Club</span>
            <div class="address-area">
                <div class="block">
                    <span class="info phone">Jl. Kemuning, Sawah, Tritih Kulon, Kec. Cilacap Utara, Kabupaten Cilacap, Jawa Tengah 53253</span>
                </div>
            </div>
        </header>
        <section class="info-area">
            <table>
                <tbody>
                    <tr>
                        <td class="w-30"><span>Admin:</span></td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="w-30"><span>Invoice ID:</span></td>
                        <td>{{ $log_transaction->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="w-30"><span>Tanggal:</span></td>
                        <td>{{ \Carbon\Carbon::parse($log_transaction->created_at)->format('d M, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="w-30">Nama Tamu:</td>
                        <td>{{ $visitor->name }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <h4 class="main-title">INVOICE</h4>
        <section class="listing-area item-list">
            <table>
                <thead>
                    <tr>
                        <td class="w-10 text-center">No.</td>
                        <td class="w-40">Item</td>
                        <td class="w-15 text-center">Qty</td>
                        <td class="w-15 text-right">Harga</td>
                        <td class="w-20 text-right">Total Harga</td>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" value="{{ $i = 1 }}">
                    @foreach ($cart as $item)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td class="text-center">{{ $item['qty'] }}</td>
                            <td class="text-right">{{ $item['pricesingle'] }}</td>
                            <td class="text-right">{{ $item['price'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="info-area calculation-area">
            <table>
                <tbody>
                    <tr>
                        <td class="w-70">Jumlah Item:</td>
                        <td>{{ count($cart) }}</td>
                    </tr>
                    <tr>
                        <td class="w-70">Jumlah Order:</td>
                        <td>{{ $qty }}</td>
                    </tr>
                    <tr>
                        <td class="w-70">Total Bayar:</td>
                        <td>{{ formatrupiah($transaction_amount) }}</td>
                    </tr>
                    @if ($discount != 0)
                        <tr>
                            <td class="w-70">Diskon:</td>
                            <td>{{ formatrupiah($discount) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="w-70">Total Tagihan:</td>
                        <td>{{ formatrupiah($log_transaction->total) }}</td>
                    </tr>
                    @if ($refund != 0)
                        <tr>
                            <td class="w-70">Kembalian:</td>
                            <td>{{ formatrupiah($refund) }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </section>
        <section class="info-area italic mt-2">
            <span class="text-small"><b>Dalam Teks:</b> {{ $counted }}</span><br>
        </section>
        <section class="listing-area payment-list">
            <h2 class="sub-title">Pembayaran</h2>
            <table>
                <thead>
                    <tr>
                        <td class="w-10 text-center">No.</td>
                        <td class="w-50">Metode</td>
                        <td class="w-50">Transaksi</td>
                        <td class="w-20">Sisa</td>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" value="{{ $i = 1 }}">
                    @foreach ($payment_type as $type)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{ $type['payment_type'] }}</td>
                            <td>{{ $type['transaction_amount'] }}</td>
                            <td>{{ $type['balance'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="info-area barcode-area">
            {{ QrCode::size(50)->eye('circle')->style('round')->generate($log_transaction->order_number) }}
        </section>
        <section class="info-area align-center footer-area">
            <span class="block">Yuk kita hidupkan lagi kebiasaan berolahraga untuk pola hidup yang lebih sehat</span>
            <span class="block bold">Terima kasih telah bermain di tgcc!</span>
        </section>
    </section>
    <script src="{{ asset('dist/asset_offline/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/dist/js/printThis.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#print').printThis({
                printContainer: true,
            });
        });
    </script>
</body>
</html>
