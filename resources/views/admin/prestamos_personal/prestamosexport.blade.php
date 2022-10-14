
<table>
    <tr>
        <td>Fecha Prestamo</td>
        <td>Nombre Empleado</td>
        <td>Concepto</td>
        <td>Monto Prestamo</td>
        <td>Monto Descontado</td>
        <td>Saldo</td>
        <td>Plazo</td>
        <td>Pagos Descontados</td>
    </tr>
    @foreach($data as $prestamos)
            @php
             \DB::statement("SET SQL_MODE=''");
                $monto_descontado =  App\DetallePrestamo::selectRaw('SUM(monto_pago) as monto')
                    ->where('detalle_prestamos.prestamo_personal_id', $prestamos->id)
                    ->where('detalle_prestamos.estatus','=','Descontado')
                    ->groupBy('detalle_prestamos.prestamo_personal_id')
                    ->first(); 

                if($monto_descontado){
                    $monto = round($monto_descontado->monto, 2);
                    $saldo = ($prestamos->total_prestamo - $monto);
                }else{
                    $monto = '';
                    $saldo = '';
                }   
            @endphp
            <tr>
                <td>{{ date('d/m/Y', strtotime($prestamos->fecha_prestamo))}}</td>
                <td>{{ $prestamos->nombre}} {{ $prestamos->apellido_paterno}} {{ $prestamos->apellido_materno}}</td>
                <td>{{ $prestamos->concepto->conceptos }}</td>
                <td align="right"> {{number_format($prestamos->total_prestamo, 2, '.', '')}}</td>
                <td>{{ $monto }}</td>
                <td>{{ $saldo }}</td>
                <td align="center">{{ $prestamos->num_pagos }}</td>
                <td align="center">{{ $prestamos->detallesPrestamo->where('estatus','Descontado')->count() }}</td>
            </tr>
           
    @endforeach
   
</table>
