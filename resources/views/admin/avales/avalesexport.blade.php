
<table>
    <tr>
        <td>ID</td>
        <td>Nombre</td>
        <td>Fecha Nacimiento</td>
        <td>Genero</td>
        <td>Curp</td>
        <td>Ciudad</td>
        <td>Estado</td>
        <td>C.P.</td>
        <td>Dirección</td>
        <td>Telefono</td>
    </tr>
    @foreach($data as $aval)
            <tr>
                <td>{{ $aval->id }}</td>
                <td>{{ $aval->getFullName() }}</td>
                <td>{{ $aval->fecha_nacimiento }}</td>
                <td>{{ $aval->genero }}</td>
                <td>{{ $aval->curp }}</td>
                <td>{{ $aval->ciudad }}</td>
                <td>{{ $aval->estado }}</td>
                <td>{{ $aval->cp }}</td>
                <td>{{ $aval->direccion }}</td>
                <td>{{ $aval->celular }}</td>
            </tr>
    @endforeach
   
</table>
