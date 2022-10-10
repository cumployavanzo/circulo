
<table>
    <tr>
        <td>N°</td>
        <td>Número de Cuenta</td>
        <td>Nombre de la Cuenta</td>
        <td>Naturaleza</td>
        <td>Tipo</td>
    </tr>
    @php
        $cont = 0;
    @endphp
    @foreach($data as $cuentas)
            @php
            $cont ++;
            @endphp
            <tr>
                <td>{{ $cont }}</td>
                <td>{{ $cuentas->numero_cuenta}}</td>
                <td>{{ $cuentas->nombre_cuenta}}</td>
                <td>{{ $cuentas->naturaleza}}</td>
                <td>{{ $cuentas->tipo}}</td>
            </tr>
           
    @endforeach
   
</table>
