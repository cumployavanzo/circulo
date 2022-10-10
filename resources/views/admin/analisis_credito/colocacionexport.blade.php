
<table>
    <tr>
        <td>Nombre Cliente</td>
        <td>Fecha Desembolso</td>
        <td>Total Capital</td>
        <td>Total Intereses</td>
    </tr>
    @php
        $cont = 0;
    @endphp
    @foreach($data as $colocacion)
            @php
                $monto_autorizado = (str_replace(",","",$colocacion->monto_autorizado));
                $tasa = $colocacion->tasa; ////40
                $porcentaje = $tasa * (1/100);
                $interes = ($monto_autorizado * $porcentaje);
                $capital = $monto_autorizado;
            @endphp
            <tr>
                <td>{{ $colocacion->nombre}} {{ $colocacion->apellido_paterno}} {{ $colocacion->apellido_materno}} </td>
                <td>{{ date('d/m/Y', strtotime($colocacion->fecha_desembolso))}}</td>
                <td>{{ $capital}}</td>
                <td>{{ $interes}}</td>
            </tr>
           
    @endforeach
   
</table>
