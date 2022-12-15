<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="width:220px;"><strong>Nama</strong></th>
                <th style="width:100px;"><strong>Jenis Member</strong></th>
                <th style="width:130px;"><strong>Metode Pembayaran</strong></th>
                <th style="width:220px;"><strong>Total Bayar</strong></th>
                <th style="width:220px;"><strong>Tanggal Bayar</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($transaction as $item)
            <tr>
                <td>{{ $item->name }}</td>
                @if ($item->tipe_member == 'VVIP')
                    <td style="text-align: center">VIP</td>
                @elseif($item->tipe_member == 'VIP')
                    <td style="text-align: center">Member</td>
                @else 
                    <td style="text-align: center">Reguler</td>
                @endif
                <td>
                    @php
                        $un = unserialize($item->payment_type);
                        $datax = array();
                        foreach ($un as $i => $t) {
                            $datax[$i] = $t['payment_type'];
                        }
                        $method_payment = implode(", ", $datax);
                        echo $method_payment;
                    @endphp
                </td>
                <td>Rp.{{ number_format($item->total, 0, ',', '.') }}</td>
                <td>{{ $item->created_at->format('d F Y | H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>