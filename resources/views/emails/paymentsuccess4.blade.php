<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Cetak Invoice</title>

    <style>
        .invoice {
            font-size: 2.5rem;
            font-weight: 500;
            -webkit-background-clip: text;
            -webkit-text-fill-color: #00000021;
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
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
            padding-left: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;

        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
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
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <h2 class="invoice">INVOICE</h2>
                            </td>
                            <td style="text-align: right">
                                <strong>Order</strong>
                                    {!!$data['order_number'] !!}<br />
                                <strong>Jenis Pembayaran:</strong><br>
                                <p style="color: #616161;">Deposit</p><br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td style="text-align: left">
                                <strong>Nama Tamu:</strong><br />
                                <span class="weight-600">{!! $data['name'] !!}</span>
                                <br />{!! $data['address'] !!}<br>
                                {!! $data['phone'] !!}<br>
                            </td>
                            <td rowspan="4" style="text-align: right">
                                <strong>Tanggal Order:</strong><br>
                                <p style="color: #616161">{!! $data['tanggal'] !!}
                                </p>
                                <br><br>
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="details">
                <td>
                    <strong>Katagori Tamu:</strong><br>
                    <span class="label label-warning">{!! $data['tipe_member'] !!}</span>
                </td>
            </tr>

            <tr class="heading">
                <td>No</td>

                <td>Nama Paket</td>

                <td style="text-align: center">Harga</td>

                <td style="text-align: center">Jumlah</td>

                <td>Total Harga</td>
            </tr>

            
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
				<td class="no-line text-right">{!! $data['qty'] !!}</td>
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
					<span>Rp. {!! formatrupiah($data['total']) !!}</span>
				</td>
			</tr>
            <tr>
				<td class="no-line text-left"><strong>Sisa Saldo :</strong></td>
				<td class="no-line">&nbsp; Rp. {!! formatrupiah($data['sisasaldo']) !!}</td>
                <td class="no-line"></td>
				<td class="no-line"></td>
				<td class="no-line text-right">
				</td>
			</tr>

        </table>
        
    </div>
    <footer class="footer container-fluid pl-30 pr-30">
        <div class="row">
            <div class="col-sm-12">
                <p>2022 &copy; Tritih Golf & Country Club. Cilacap</p>
            </div>
        </div>
    </footer>

</body>

</html>
