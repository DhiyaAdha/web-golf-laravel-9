<table>
    <thead>
        <tr>
            <th style="width:80px;">No</th>
            @if($category == 'default')
                <th style="width:80px;">Invoice</th>
                <th style="width:80px;">Tanggal</th>
                <th style="width:80px;">Nama Tamu</th>
                <th style="width:80px;">Paket Permainan</th>
                <th style="width:80px;">Jumlah</th>
                <th style="width:80px;">Total Nilai</th>
            @elseif($category == 'additional')
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Nama Paket</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Nilai</th>
            @elseif($category == 'others')
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Nilai</th>
            @elseif($category == 'service')
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Nama Tamu</th>
                <th>Total Nilai</th>
            @elseif($category == 'rental')
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Barang</th>
                <th>Total Nilai</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @php
    $no = 1;
    @endphp
    @foreach($data as $i => $row)
        <tr>
            <td>{{ $no++ }}</td>
            @if($category == 'default')
                <td>{{ $row['inv'] }}</td>
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['username'] }}</td>
                <td>{{ $row['product'] }}</td>
                <td>{{ $row['qty'] }}</td>
                <td>{{ $row['price'] }}</td>
            @elseif($category == 'additional')
                <td>{{ $row['inv'] }}</td>
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['product'] }}</td>
                <td>{{ $row['qty'] }}</td>
                <td>{{ $row['pricesingle'] }}</td>
                <td>{{ $row['price'] }}</td>
            @elseif($category == 'others')
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['product'] }}</td>
                <td>{{ $row['qty'] }}</td>
                <td>{{ $row['pricesingle'] }}</td>
                <td>{{ $row['price'] }}</td>
            @elseif($category == 'service')
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['inv'] }}</td>
                <td>{{ $row['username'] }}</td>
                <td>{{ $row['price'] }}</td>
            @elseif($category == 'rental')
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['inv'] }}</td>
                <td>{{ $row['product'] }}</td>
                <td>{{ $row['qty'] }}</td>
                <td>{{ $row['pricesingle'] }}</td>
                <td>{{ $row['price'] }}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>