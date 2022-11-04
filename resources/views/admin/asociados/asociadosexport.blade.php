
<table>
    <tr>
        <td>ID</td>
        <td>Ruta</td>
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
    @foreach($data as $asociado)
            <tr>
                <td>{{ $asociado->id }}</td>
                <td>{{ $asociado->ruta->nombre_ruta }}</td>
                <td>{{ $asociado->getFullName() }}</td>
                <td>{{ $asociado->fecha_nacimiento }}</td>
                <td>{{ $asociado->genero }}</td>
                <td>{{ $asociado->curp }}</td>
                <td>{{ $asociado->ciudad }}</td>
                <td>{{ $asociado->estado }}</td>
                <td>{{ $asociado->cp }}</td>
                <td>{{ $asociado->direccion }}</td>
                <td>{{ $asociado->celular }}</td>
            </tr>
    @endforeach
   
</table>
