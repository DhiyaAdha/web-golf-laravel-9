<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Pembayaran Deposit</title>

    <style>
        .invoice {
            font-size: 2.5rem;
            font-weight: 500;
            -webkit-background-clip: text;
            -webkit-text-fill-color: #01C853;
            margin: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            /* text-align: right; */
        }

        .invoice-box table tr.top table td {
            /* padding-bottom: 20px; */
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
        }

        .invoice-box table tr.information table td {
            /* padding-bottom: 10px; */
            /* padding-left: 20px; */
        }
        .invoice-box table tr.information2 table td {
            /* padding-bottom: 20px; */
            /* padding-left: 20px; */
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;

        }

        .invoice-box table tr.details td {
            padding-bottom: 5px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information2 table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
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
            height: 60px;
            width: 50px;
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
    </style>
</head>

    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
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
                                    <img src={{ $message->embed(public_path() . '/tgcc144.png') }} height="60px" width="50px"> <strong style="vertical-align:75%; font-size: 25px;">TGCC</strong>
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
                            <p style="margin: 0;text-align: left;">Terimakasih telah bermain Golf di <strong>Tritih Golf Country & Club. </strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                            

                            <div class="invoice-box">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr class="top">
                                        <td colspan="5">
                                            <table>
                                                <tr>
                                                    <td class="title">
                                                        <h2 class="invoice">INVOICE</h2>
                                                    </td>
                                                    <td align="right" style="text-align: right">
                                                        <strong>Order</strong>
                                                        {!! $data['order_number'] !!}<br /><br>
                                                        <strong>Jenis Pembayaran:</strong>
                                                        <p style="color: #616161;">{!! $data['payment_type'] !!}</p><br />
                        
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                        
                                    <tr class="information">
                                        <td colspan="5">
                                            <table>
                                                <tr>
                                                    <td style="text-align: left">
                                                        <strong>Nama Tamu:</strong><br />
                                                        <span class="weight-600">Imas</span>
                                                        <br />jl. jhghugy<br>
                                                        087766665655<br>
                                                    </td>
                                                    <td rowspan="4" style="text-align: right">
                                                        <strong>Tanggal Order:</strong><br>
                                                        <p style="color: #616161">27/10/2022
                                                        </p>
                                                    </td>
                        
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                        
                                    <tr class="information2">
                                        <td colspan="5">
                                            <table>
                                                    <td style="text-align: left">
                                                        <strong>Katagori Tamu:</strong><br>
                                                        <span class="label label-warning">VIP</span>
                                                    </td>
                                                    <td style="text-align: right">
                                                        <strong>Sisa Saldo:</strong><br>
                                                        <span style="color: #616161">Rp. 100.000.000
                                                        </span>
                                                    </td>
                                            </table>
                                        </td>
                                    </tr>
                        
                                    <tr class="heading">
                                        <td>No</td>
                        
                                        <td>Nama Paket</td>
                        
                                        <td>Harga</td>
                        
                                        <td>Jumlah</td>
                        
                                        <td>Total Harga</td>
                                    </tr>
                        
                                    
                                    
                                        <tr>
                                            <td style="vertical-align: 50px">1</td>
                                            <td>Car 1 Sheet</td>
                                            <td class="text-right">Rp. 10.000.000</td>
                                            <td class="text-center">7</td>
                                            <td class="text-right">Rp. 100.000.000</td>
                                        </tr>
                                    {{-- <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-right">Total Item</td>
                                        <td class="thick-line text-right">
                                            <span>{!! $data['cart'] !!}</span>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right">Total Order</td>
                                        <td class="no-line text-right">10</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right">Discount</td>
                                        <td class="no-line text-right">Rp. -</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Jumlah Pembayaran</strong></td>
                                        <td class="no-line text-right">
                                            <span>Rp. 100.000.000</span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td class="no-line text-left"><strong>Sisa Saldo :</strong></td>
                                        <td class="no-line">&nbsp; Rp. 999.000.000</td>
                                    </tr> --}}
                        
                                </table>
                                
                            </div>


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
