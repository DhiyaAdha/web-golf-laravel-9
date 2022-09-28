<!DOCTYPE html>
<html>

<head>
    <title></title>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> --}}


    <link rel="apple-touch-icon" href="{{ asset('tgcc144.PNG') }}">
    <link rel="icon" href="{{ asset('tgcc144.PNG') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet"type="text/css">


    <style type="text/css">

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

        a,
        .no-print,
        .modal-open.wrapper,
        .main-footer,
        .view-link,
        .dataTables_length,
        .dataTables_filter {
            display: none !important;
        }

        .box {
            border-top: none !important;
        }

        .box-header.with-border {
            border-bottom: none;
        }

        .close,
        .btn {
            display: none !important
        }

        .print-btn {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 30px;
            z-index: 1251;
            background: #81ECFF;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
        }

        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        /* email invoice */
        .receipt-template .main-title {
                font-size: 14px;
                font-weight: 700;
                text-align: center;
                margin: 10px 0 5px 0;
                padding: 0;
            }

    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;" id="print">
        <style id="styles" type="text/css">
            /*Common CSS*/
            .receipt-template {
                width: 302px;
                margin: 0 auto;
            }

            .receipt-template .text-small {
                font-size: 10px;
            }

            .receipt-template .block {
                display: block;
            }

            .receipt-template .inline-block {
                display: inline-block;
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
                font-size: 14px;
                font-weight: 700;
                text-align: center;
                margin: 10px 0 5px 0;
                padding: 0;
            }

            .receipt-template .heading {
                position: relation;
            }

            .receipt-template .title {
                font-size: 16px;
                font-weight: 700;
                margin: 10px 0 5px 0;
            }

            .receipt-template .sub-title {
                font-size: 12px;
                font-weight: 700;
                margin: 10px 0 5px 0;
            }

            .receipt-template table {
                width: 100%;
            }

            .receipt-template td,
            .receipt-template th {
                font-size: 12px;
            }

            .receipt-template .info-area {
                font-size: 12px;
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

            .receipt-template .listing-area table tbody tr {
                border-top: 1px dashed #000;
                border-bottom: 1px dashed #000;
            }

            .receipt-template .listing-area table tbody tr:last-child {
                border-bottom: none;
            }

            .receipt-template .listing-area table td {
                vertical-align: top;
            }

            .receipt-template .info-area table {}

            .receipt-template .info-area table thead tr {
                border-top: 1px solid #000;
                border-bottom: 1px solid #000;
            }

            /*Receipt Heading*/
            .receipt-template .receipt-header {
                text-align: center;
            }

            .receipt-template .receipt-header .logo-area {
                width: 80px;
                height: 80px;
                margin: 0 auto;
            }

            .receipt-template .receipt-header .logo-area img.logo {
                display: inline-block;
                max-width: 100%;
                max-height: 100%;
            }

            .receipt-template .receipt-header .address-area {
                margin-bottom: 5px;
                line-height: 1;
            }

            .receipt-template .receipt-header .info {
                font-size: 12px;
            }

            .receipt-template .receipt-header .store-name {
                font-size: 24px;
                font-weight: 700;
                margin: 0;
                padding: 0;
            }


            /*Invoice Info Area*/
            .receipt-template .invoice-info-area {}

            /*Customer Customer Area*/
            .receipt-template .customer-area {
                margin-top: 10px;
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

            /*Item Listing*/
            .receipt-template .item-list table tr {}

            /*Barcode Area*/
            .receipt-template .barcode-area {
                margin-top: 10px;
                text-align: center;
            }

            .receipt-template .barcode-area img {
                max-width: 100%;
                display: inline-block;
            }

            /*Footer Area*/
            .receipt-template .footer-area {
                line-height: 1.222;
                font-size: 10px;
            }

            /*Media Query*/
            @media print {
                .receipt-template {
                    width: 100%;
                }
            }

            @media all and (max-width: 215px) {}
        </style>
    <!-- HIDDEN PREHEADER TEXT -->
    <div
        style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        We're thrilled to have you here! Get ready to dive into your new account.
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#01C853" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#01C853" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="padding: 1px 20px 20px 20px; border-radius: 1px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 1px; font-weight: 10; letter-spacing: 4px; line-height: 1px;">
                            {{-- <img src="{{ $message->embed(public_path() . '/img/icon-logo.svg') }}" width="90"
                                height="90" style="display: block; border: 0px;" /> --}}
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="justify-content: center; padding: 0px 20px 0px 20px; border-radius: 4px 4px 0px 0px; color: #01C853; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 25px; font-weight: 600; letter-spacing: 4px; line-height: 48px;">
                            {{-- <div style="display:flex;justify-content: center;">
                                <img class="brand-img" src="{{ asset('dist/img/tgcc_icon.svg') }}" alt="brand"
                                    width="30" height="30">
                                <span class="brand-text" style="color: #111111">TGGC</span>
                            </div> --}}
                        </td>
                        <tr>
                            <td bgcolor="#ffffff" align="center"
                            style="padding: 
                            1.1px 0px 50px 1.11px; color: #000000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                                <img src="{{ $message->embed(public_path().'/tgcc144.PNG') }}" height="
                                60px" width="30px"> <strong style="vertical-align:25%; font-size: 25px;">TGCC</strong>
                            </td>
                        </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="center"
                            style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;text-align: center;">Hallo, <strong>{!! $data['name'] !!}</strong></p>
                        </td>
                    </tr>
        </tr>
    </table>
    </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="center"
                        style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;text-align: left;">Terimakasih telah bermain Golf di <strong>Tritih
                                Golf Country & Club. </strong>Berikut detail kartu anda :</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left"
                        style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                        {{-- <div style="display:flex;">
                            <p style="margin: 0;">Nama: </p>
                            <p style="margin: 0;">&nbsp; {!! $data['name'] !!}</p>
                        </div>
                        <div style="display:flex;">
                            <p style="margin: 0;">Saldo Deposit Sebelumnya: </p>
                            <p style="margin: 0;">&nbsp; Rp. {!! formatrupiah($data['sebelumdeposit']) !!}</p>
                        </div> --}}
                        <div style="display:flex;">
                            <p style="margin: 0;">Sisa Saldo: </p>
                            <p style="margin: 0;">&nbsp; Rp. {!! formatrupiah($data['sisasaldo']) !!}</p>
                        </div>
                        <div style="display:flex;">
                            <p style="margin: 0;">Jumlah Pembayaran: </p>
                            <p style="margin: 0;">&nbsp; Rp. {!! formatrupiah($data['total']) !!}</p>
                        </div>
                        <div style="display:flex;">
                            <p style="margin: 0;">Order Invoice: </p>
                            <p style="margin: 0;">&nbsp; </p>
                        </div>
                        <div style="display:flex;">
                            <p style="margin: 0;">Jumlah item order: </p>
                            <p style="margin: 0;">&nbsp; </p>
                        </div>
                        <div style="display:flex;">
                            <p style="margin: 0;">Waktu Transaksi: </p>
                            <p style="margin: 0;">&nbsp; </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="main-title">INVOICE</h4>
            <section class="listing-area item-list">
                <table>
                    <thead>
                        <tr>
                            <td class="w-10 text-center">Sl.</td>
                            <td class="w-40">Name</td>
                            <td class="w-15 text-center">Qty</td>
                            <td class="w-15 text-right">Harga</td>
                            <td class="w-20 text-right">Total Harga</td>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" value="{!! $i = 1 !!}">
                        @foreach ($data['cart'] as $item)
                            <tr>
                                <td class="text-center">{!! $i++ !!}</td>
                                <td>{!! $item['name'] !!}</td>
                                <td class="text-center">{!! $item['qty'] !!}</td>
                                <td class="text-right">{!! $item['pricesingle'] !!}</td>
                                <td class="text-right">{!! $item['price'] !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            {{-- <section class="info-area calculation-area">
                <table>
                    <tbody>
                        <tr>
                            <td class="w-70">Total Item:</td>
                            <td>{!! count($cart) !!}</td>
                        </tr>
                        <tr>
                            <td class="w-70">Total Order:</td>
                            <td>{!! $qty !!}</td>
                        </tr>
                        <tr>
                            <td class="w-70">Discount:</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td class="w-70">Jumlah Pembayaran:</td>
                            <td>{!! formatrupiah($total) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </section> --}}
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="justify"
                        style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">Demikian kami sampaikan, Stay Healty dan jangan lupa luangkan waktu
                            untuk bermain Golf.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#FFE600" align="justify"
                        style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">Disclaimer : Berhati-hatilah dengan lampiran ini. Pesan ini berisi 1
                            lampiran terenkripsi yang tidak dapat dipindai untuk mengetahui adanya konten berbahaya.
                            Jangan download lampiran tersebut kecuali Anda mengenal pengirimnya dan yakin email
                            tersebut sah.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="content-cell" align="center"
            style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;">
            <p class="f-fallback sub align-center"
                style="font-size: 13px; line-height: 1.625; text-align: center; color: #A8AAAF; margin: .4em 0 1.1875em;"
                align="center">© 2022 Tritih Golf & Country Club. Cilacap.</p>
        </td>
    </tr>
    </table>
</body>

</html>
