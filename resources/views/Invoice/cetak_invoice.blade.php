<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Cetak Invoice</title>

    <style>
        .invoice {
            font-size: 2.5rem;
            font-weight: 500;
            background: -webkit-linear-gradient(45deg, #82eee5, #01C853 80%);
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

                            <td>
                                <strong>Order
                                    #{{ $transaction->order_number }}</strong><br />
                                <strong>Metode Pembayaran:</strong><br>
                                <p style="color: #616161;">{{ $transaction->payment_type }}</p><br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <strong>Nama Tamu:</strong><br />
                                <span class="weight-500">{{ $visitor->name }}</span>
                                <br />{{ $visitor->email }}<br>
                                {{ $visitor->phone }}<br>
                            </td>

                            <td>
                                <strong>Order Date:</strong><br>
                                <p style="color: #616161">{{ $transaction->created_at->format('d F Y | H:i:s') }}
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
                    @if ($visitor->tipe_member == 'VIP')
                        <span class="label label-success">{{ $visitor->tipe_member }}</span>
                    @else
                        <span class="label label-warning">{{ $visitor->tipe_member }}</span>
                    @endif
                </td>
            </tr>

            <tr class="heading">
                <td>Nama Paket</td>

                <td style="text-align: center">Harga</td>

                <td style="text-align: center">Jumlah</td>

                <td>Total</td>
            </tr>

            <tr class="item">
                <td>{{ $package->name }}</td>

                <td>Rp.{{ formatrupiah($package->price_weekdays) }}</td>

                <td style="text-align: center">{{ $detail->quantity }}</td>

                <td>Rp.{{ formatrupiah($transaction->total) }}</td>
            </tr>

			<tr>
				<td class="thick-line"></td>
				<td class="thick-line"></td>
				<td class="thick-line text-right">Subtotal</td>
				<td class="thick-line text-right">
					<span>Rp. {{ formatrupiah($detail->harga * $detail->quantity * 2) }}</span>
				</td>
			</tr>
			<tr>
				<td class="no-line"></td>
				<td class="no-line"></td>
				<td class="no-line text-right">Limit Bulanan</td>
				<td class="no-line text-right">Rp. -</td>
			</tr>
			<tr>
				<td class="no-line"></td>
				<td class="no-line"></td>
				<td class="no-line text-right">Deposit</td>
				<td class="no-line text-right">Rp. -</td>
			</tr>
			<tr>
				<td class="no-line"></td>
				<td class="no-line"></td>
				<td class="no-line text-right"><strong>Total Bayar</strong></td>
				<td class="no-line text-right">
					<span>Rp. {{ formatrupiah($transaction->total) }}</span>
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