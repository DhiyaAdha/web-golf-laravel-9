<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokumen Daftar Paket</title>
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
                <th style="width:220px;"><strong>Nama Paket</strong></th>
                <th style="width:170px;"><strong>Kategori</strong></th>
                <th style="width:170px;"><strong>Senin</strong></th>
                <th style="width:170px;"><strong>Selasa-Jumat</strong></th>
                <th style="width:170px;"><strong>Sabtu-Minggu</strong></th>
                <th style="width:50px;"><strong>Status</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($package as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category == 'default' ? 'Permainan' : ($item->category == 'additional' ? 'Proshop & Fasilitas' : ($item->category == 'others' ? 'Kantin' : ($item->category == 'rental' ? 'Penyewaan' : 'Service Fee'))) }}</td>
                <td>Rp.{{ number_format($item->price_discount, 0, ',', '.') }}</td>
                <td>Rp.{{ number_format($item->price_weekdays, 0, ',', '.') }}</td>
                <td>Rp.{{ number_format($item->price_weekend, 0, ',', '.') }}</td>
                @if ($item->status == 0)
                    <td>Aktif</td>
                @else
                    <td>Tidak Aktif</td>
                @endif
        @endforeach
        </tbody>
    </table>
</body>

</html>