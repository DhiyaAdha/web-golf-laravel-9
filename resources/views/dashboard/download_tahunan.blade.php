<table>
    <thead>
        <tr>
            <th>BULAN</th>
            @foreach($category as $cat)
            <th>{{strtoupper($cat)}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @php
        $forkopimda = 0;
        $umum = 0;
        $pertamina = 0;
        $pensiunan = 0;
        $perpesi = 0;
    @endphp
    @foreach($data as $i => $row)
        @php
        $forkopimda += $row['forkopimda'] ?? 0;
        $umum += $row['umum'] ?? 0;
        $pertamina += $row['pertamina'] ?? 0;
        $pensiunan += $row['pensiunan'] ?? 0;
        $perpesi += $row['perpesi'] ?? 0;
        @endphp
        <tr>
            <td>{{ $row['bulan'] ?? 0 }}</td>
            <td>{{ $row['forkopimda'] ?? 0 }}</td>
            <td>{{ $row['umum'] ?? 0 }}</td>
            <td>{{ $row['pertamina'] ?? 0 }}</td>
            <td>{{ $row['pensiunan'] ?? 0 }}</td>
            <td>{{ $row['perpesi'] ?? 0 }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Jumlah</th>
            <th>{{$forkopimda}}</th>
            <th>{{$umum}}</th>
            <th>{{$pertamina}}</th>
            <th>{{$pensiunan}}</th>
            <th>{{$perpesi}}</th>
        </tr>
    </tfoot>
</table>