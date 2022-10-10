
<table>
    <tr>
        <td>N°</td>
        <td>Fecha Alta</td>
        <td>Nombre Cliente</td>
        <td>Nombre Asociado</td>
        <td>Telefono</td>
        <td>Monto Autorizado</td>
        <td>Ciclo</td>
        <td>Número de Cuenta</td>
        <td>Nombre Cuenta Contable</td>
        <td>Número Cuenta Contable</td>
        <td>Nombre Aval</td>
        <td>Tel. Aval</td>
    </tr>
    @php
        $cont = 0;
    @endphp
    @foreach($data as $clientes)
            @php
            $cont ++;
            $solicitud = App\Solicitud::where('cliente_id',$clientes->id)->first();
            if($solicitud){
                $ciclo = $solicitud->ciclo;
                if($solicitud->analisis){
                    $montoAutorizado = number_format($solicitud->analisis->monto_autorizado,2);
                }else{
                    $montoAutorizado = 'No tiene Analisis';
                }
            }else{
                $ciclo = '';
                $montoAutorizado = 'No tiene Solicitud';
            }

            if($clientes->cuentas){
                $nameCuenta = $clientes->cuentas->nombre_cuenta;
                $numCuenta = $clientes->cuentas->numero_cuenta;
            }else{
                $nameCuenta = '';
                $numCuenta = '';
            }

            if($clientes->aval){
                $nameAval = $clientes->aval->getFullName();
                $telAval = $clientes->aval->celular;
            }else{
                $nameAval = "";
                $telAval = "";
            }
            @endphp
            <tr>
                <td>{{ $cont }}</td>
                <td>{{ $clientes->fecha_alta}}</td>
                <td>{{ $clientes->getFullName()}}</td>
                <td>{{ $clientes->asociados->getFullName()}}</td>
                <td>{{ $clientes->celular}}</td>
                <td class="monto">{{ $montoAutorizado}}</td>
                <td>{{ $ciclo}}</td>
                <td>{{ $clientes->numero_cuenta}}</td>
                <td>{{ $nameCuenta}}</td>
                <td>{{ $numCuenta}}</td>
                <td>{{ $nameAval}}</td>
                <td>{{ $telAval}}</td>
            </tr>
           
    @endforeach
   
</table>
