@extends('layouts.AdminLTE.index')
@section('title', 'Movimientos')
@section('header', 'Movimientos')
@section('content')
 <div class="card card-gray">
            <div class="card-header">Contabilidad</div>
            <form method="POST" action="{{action('MovimientoGastoController@update', $movimientoGastos->id)}}" autocomplete="off">
                @method('PUT')	
                @csrf
            <div class="card-body">           
                <div class="row">
                    <div class="col-12 table-responsive">
                        <p class="lead text-center"><b>Contabilidad</b></p>
                        <table class="table"> 
                            @if ($gasto->concepto == 'NO APLICA')
                                <thead>
                                    <tr>
                                        <th style="width:15%">Cuenta</th>
                                        <th style="width:40%">Nombre de cuenta</th>
                                        <th style="width:10%">Debe</th>
                                        <th style="width:10%">Haber</th>
                                        <th style="width:15%">Factura</th>
                                        <th style="width:10%">N° Pago</th>
                                    </tr>
                                </thead>  
                                <tr> {{-- CUENTA DEL PROVEEDOR --}}
                                    <td style="width:15%">{{ $gasto->proveedor->cuentas->numero_cuenta }}</td>
                                    <td style="width:40%">{{ $gasto->proveedor->cuentas->nombre_cuenta }}</td>
                                    <td style="width:10%">{{ $gasto->total }}</td> 
                                    <td style="width:10%"></td>
                                    <td style="width:15%">{{ $gasto->num_factura}}</td>
                                    <td style="width:10%">{{ $pago->id}}</td>
                                </tr>
                                <tr> {{-- CUENTA DEL TIPO PAGO --}}
                                    <td style="width:15%">{{ $pago->cuentas->numero_cuenta }}</td>
                                    <td style="width:40%">{{ $pago->cuentas->nombre_cuenta }}</td>
                                    <td style="width:10%"></td>
                                    <td style="width:10%">{{ $gasto->total }}</td>
                                    <td style="width:15%">{{ $gasto->num_factura}}</td>
                                    <td style="width:10%">{{ $pago->id}}</td>
                                </tr>
                                @php
                                    $totalI = 0;
                                    $totalIva = 0;
                                @endphp
                                @foreach($gastoProducto as $producto)
                                    <tr> {{-- CUENTA DEL IVA ACREDITABLE PENDIENTE --}}
                                        <td style="width:15%">{{ $producto->articulo->cuentasIva->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasIva->nombre_cuenta }}</td>
                                        <td style="width:10%">{{number_format($producto->p_iva, 4, '.', '')}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $pago->id}}</td>
                                    </tr>
                                    <tr>  {{-- CUENTA DEL IVA ACREDITABLE PAGADO --}}
                                        <td style="width:15%">{{ $cuentaIvaPagado->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $cuentaIvaPagado->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{number_format($producto->p_iva, 4, '.', '')}}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $pago->id}}</td>
                                    </tr>
                                    @php
                                        $totalI += $producto->total;
                                    
                                        $totalIva += $producto->p_iva;
                                        $sumaIgualDebe = $totalI + $totalIva;
                                        $sumasIguales = $totalI + $totalIva;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td style="width:15%"></td>
                                    <td style="width:40%">Sumas Iguales</td>
                                    <td style="width:10%">{{number_format($sumaIgualDebe, 4, '.', '')}}</td>
                                    <td style="width:10%">{{number_format($sumasIguales, 4, '.', '')}}</td>
                                    <td style="width:15%">{{ $gasto->num_factura}}</td>
                                    <td style="width:10%">{{ $pago->id}}</td>
                                </tr>
                            @elseif($gasto->concepto == 'RETIRO DE CAPITAL' || $gasto->concepto == 'VENTA DE ACCIONES')
                            <thead>
                                <tr>
                                    <th style="width:15%">Cuenta</th>
                                    <th style="width:40%">Nombre de cuenta</th>
                                    <th style="width:10%">Debe</th>
                                    <th style="width:10%">Haber</th>
                                    <th style="width:10%">N° Pago</th>
                                </tr>
                            </thead>  
                                
                                <tr>
                                    <td style="width:15%">100-600-100-005</td>
                                    <td style="width:40%">SOCIOS, ACCIONISTAS O REPRESENTANTE LEGAL</td>
                                    <td style="width:10%">{{$gasto->total}}</td>
                                    <td style="width:10%"></td>
                                    <td style="width:10%">{{ $gasto->id}}</td>
                                </tr>
                                <tr>
                                    <td style="width:15%">{{ $cuentaTipoPago->numero_cuenta }}</td>
                                    <td style="width:40%">{{ $cuentaTipoPago->nombre_cuenta }}</td>
                                    <td style="width:10%"></td>
                                    <td style="width:15%">{{$gasto->total}}</td>
                                    <td style="width:10%">{{ $gasto->id}}</td>
                                </tr>
                                
                           @endif
                            
                        </table>
                    
                    </div>
                </div>   
                <div class="card-footer">
                    <a type="button" href="{{ route('admin.movimiento.index') }}" class="btn btn-danger float-right">Cancelar</a>
                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Contabilizar</button>
                </div>  
            </div><!-- /.card-body -->   
        </form>                                    
</div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });
    
</script>
@endpush