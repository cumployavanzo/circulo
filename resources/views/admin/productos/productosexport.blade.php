
<table>
    <tr>
        <td>#</td>
        <td>Nombre</td>
        <td>Frecuencia de pago</td>
        <td>Tasa</td>
        <td>Plazo</td>
        <td>Cuenta</td>
    </tr>
    @php
        $cont = 0;
    @endphp
    @foreach($data as $producto)
            @php
            $cont ++;
            @endphp
            <tr>
                <td>{{ $cont }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->frecuencia_pago }}</td>
                <td>{{ $producto->tasa }}</td>
                <td>{{ $producto->plazo }}</td>
                <td>{{ $producto->cuentas->nombre_cuenta }}</td>
            </tr>
           
    @endforeach
   
</table>
