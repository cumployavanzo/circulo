
<table>
    <tr>
        <td>Proveedor</td>
        <td>Rfc</td>
        <td>Suma de Importe</td>
        <td>Suma de IVA</td>
        <td>Suma de Total</td>
    </tr>
            @php
                $total = 0;
                $totalIva = 0;
                $totalImp = 0;
            @endphp
    @foreach($data as $gasto)
            @php
                $total += $gasto->total;
                $totalIva += $gasto->iva;
                $totalImp += $gasto->importe;
            @endphp

            <tr>
                <td>{{ $gasto->nombre_proveedor}}</td>
                <td>{{ $gasto->rfc}}</td>
                <td>{{ $gasto->importe}}</td>
                <td>{{ $gasto->iva}}</td>
                <td>{{ $gasto->total}}</td>
            </tr>
    @endforeach
            <tr>
                <td><b>TOTAL GENERAL</b></td>
                <td></td>
                <td><b>{{$totalImp}}</b></td>
                <td><b>{{$totalIva}}</b></td>
                <td><b>{{$total}}</b></td>
            </tr>
</table>
