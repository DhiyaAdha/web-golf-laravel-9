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
                <th class="" style="text-align:center"><strong>Nama</strong></th>
                <th class="" style="text-align:center"><strong>Email</strong></th>
                <th class="" style="text-align:center"><strong>Phone</strong></th>
                <th class="" style="text-align:center"><strong>Alamat</strong></th>
                <th class="" style="text-align:center"><strong>Posisi</strong></th>
                <th class="" style="text-align:center"><strong>Perusahaan</strong></th>
                <th class="" style="text-align:center"><strong>Jenis</strong></th>
                <th class="" style="text-align:center"><strong>Kategori</strong></th>
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