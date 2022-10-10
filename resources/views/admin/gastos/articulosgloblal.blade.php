
<table>
    <tr>
        <td>Articulo</td>
        <td>Suma de Cantidad</td>
        <td>Suma de Importe</td>
        <td>Suma de IVA</td>
        <td>Suma de Total</td>
    </tr>
            @php
                $total = 0;
                $totalIva = 0;
                $totalImp = 0;
                $totalCantidad = 0;
            @endphp
    @foreach($data as $gasto)
            @php
                $totalCantidad += $gasto->cantidad;
                $total += $gasto->total;
                $totalIva += $gasto->iva;
                $totalImp += $gasto->importe;
            @endphp

            <tr>
                <td>{{ $gasto->nombre_producto}}</td>
                <td>{{ $gasto->cantidad}}</td>
                <td>{{ $gasto->importe}}</td>
                <td>{{ $gasto->iva}}</td>
                <td>{{ $gasto->total}}</td>
            </tr>
    @endforeach
            <tr>
                <td><b>TOTAL GENERAL</b></td>
                <td><b>{{$totalCantidad}}</b></td>
                <td><b>{{$totalImp}}</b></td>
                <td><b>{{$totalIva}}</b></td>
                <td><b>{{$total}}</b></td>
            </tr>
</table>
