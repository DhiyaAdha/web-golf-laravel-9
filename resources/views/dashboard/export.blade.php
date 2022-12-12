<table>
    <thead>
    <tr>
        <th>No {{ $category }}</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Jumlah Barang</th>
        <th>Harga Barang</th>
        <th>Total Nilai</th>
    </tr>
    </thead>
    <tbody>
    @php
    $no = 1;
    @endphp
    @foreach($data as $i => $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row['inv'] }}</td>
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['product'] }}</td>
            <td>{{ $row['qty'] }}</td>
            <td>{{ $row['pricesingle'] }}</td>
            <td>{{ $row['price'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>