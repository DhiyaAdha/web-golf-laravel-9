<table>
    <thead>
        <tr>
            <th style="width:80px;">BULAN</th>
            <th style="width:80px;">PERTAMINA</th>
            <th style="width:80px;">PENSIUNAN</th>
            <th style="width:100px;">FORKOPIMDA</th>
            <th style="width:80px;">PERPESI</th>
            <th style="width:80px;">UMUM</th>
            <th style="width:80px;">JUMLAH</th>
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

        $total = ($row['forkopimda'] ?? 0) + ($row['umum'] ?? 0) + ($row['pertamina'] ?? 0) + ($row['pensiunan'] ?? 0) + ($row['perpesi'] ?? 0)
        @endphp
        <tr>
            <td>{{ $row['bulan'] }}</td>
            <td>{{ $row['pertamina'] ?? 0 }}</td>
            <td>{{ $row['pensiunan'] ?? 0 }}</td>
            <td>{{ $row['forkopimda'] ?? 0 }}</td>
            <td>{{ $row['perpesi'] ?? 0 }}</td>
            <td>{{ $row['umum'] ?? 0 }}</td>
            <td>{{ $total }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>JUMLAH</th>
            <th>{{$pertamina}}</th>
            <th>{{$pensiunan}}</th>
            <th>{{$forkopimda}}</th>
            <th>{{$perpesi}}</th>
            <th>{{$umum}}</th>
            <th>{{$pertamina+$pensiunan+$forkopimda+$perpesi+$umum}}</th>
        </tr>
    </tfoot>
</table>