<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="" style="text-align:center"><strong>Nama</strong></th>
                <th class="" style="text-align:center"><strong>Kategori Tamu</strong></th>
                <th class="" style="text-align:center"><strong>Metode Pembayaran</strong></th>
                <th class="" style="text-align:center"><strong>Total Bayar</strong></th>
                <th class="" style="text-align:center"><strong>Tanggal Bayar</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($transaction as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td style="text-align: center">{{ $item->tipe_member }}</td>
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
                <td>{{ $item->total }}</td>
                <td>{{ $item->created_at->format('d F Y | H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>