<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokumen Daftar Tamu</title>
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
                <th style="width:220px;"><strong>Email</strong></th>
                <th style="width:150px;"><strong>No Hp</strong></th>
                <th style="width:320px;"><strong>Alamat</strong></th>
                <th style="width:150px;"><strong>Posisi</strong></th>
                <th style="width:220px;"><strong>Perusahaan</strong></th>
                <th style="width:120px;"><strong>Jenis</strong></th>
                <th style="width:120px;"><strong>Kategori</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($visitor as $item)
            <tr>
                @if ($item->tipe_member == 'VVIP')
                    <td>{{ $item->name }}</td>
                @endif
                @if ($item->tipe_member == 'VIP')
                    <td>{{ $item->name }}</td>
                @endif
                <td style="text-align: center">{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->company }}</td>
                @if ($item->tipe_member == 'VVIP')
                    <td>VIP</td>
                @endif
                @if ($item->tipe_member == 'VIP')
                    <td>Member</td>
                @endif
                <td>{{ $item->category }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>