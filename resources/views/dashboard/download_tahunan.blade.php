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
        $forkopimda += $row['forkopimda'];
        $umum += $row['umum'];
        $pertamina += $row['pertamina'];
        $pensiunan += $row['pensiunan'];
        $perpesi += $row['perpesi'];
        @endphp
        <tr>
            <td>{{ $row['bulan'] }}</td>
            <td>{{ $row['forkopimda'] }}</td>
            <td>{{ $row['umum'] }}</td>
            <td>{{ $row['pertamina'] }}</td>
            <td>{{ $row['pensiunan'] }}</td>
            <td>{{ $row['perpesi'] }}</td>
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