<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Daftar Tamu</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="" style="text-align:center"><strong>Nama Paket</strong></th>
                <th class="" style="text-align:center"><strong>Kategori</strong></th>
                <th class="" style="text-align:center"><strong>Senin</strong></th>
                <th class="" style="text-align:center"><strong>Selasa - Jumat</strong></th>
                <th class="" style="text-align:center"><strong>Sabtu - Minggu</strong></th>
                <th class="" style="text-align:center"><strong>Status</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($package as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
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