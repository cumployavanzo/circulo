
<table>
    <tr>
        <td>#</td>
        <td>Nombre</td>
        <td>Numero ruta</td>
        <td>Dirección</td>
        <td>Ciudad</td>
        <td>Telefono</td>
        <td>Estatus</td>
    </tr>
    @php
        $cont = 0;
    @endphp
    @foreach($data as $sucursal)
            @php
            $cont ++;
            @endphp
            <tr>
                <td>{{ $cont }}</td>
                <td>{{ $sucursal->nombre_ruta }}</td>
                <td>{{ $sucursal->numero_ruta }}</td>
                <td>{{ $sucursal->direccion }}</td>
                <td>{{ $sucursal->ciudad }}</td>
                <td>{{ $sucursal->telefono }}</td>
                <td>{{ $sucursal->state }}</td>
            </tr>
           
    @endforeach
   
</table>
