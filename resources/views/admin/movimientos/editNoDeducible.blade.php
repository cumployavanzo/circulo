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
                            <thead>
                                <tr>
                                    <th style="width:15%">Cuenta</th>
                                    <th style="width:40%">Nombre de cuenta</th>
                                    <th style="width:10%">Debe</th>
                                    <th style="width:10%">Haber</th>
                                    <th style="width:15%">Factura</th>
                                    <th style="width:10%">N° compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $totalIsr = 0;
                                    $totalRiva = 0;
                                    $totalIva = 0;
                                    $totalImp = 0;
                                @endphp
                            
                                @foreach($gastoProducto as $producto)
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentas->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentas->nombre_cuenta }}</td>
                                        <td style="width:10%">{{number_format( $producto->importe, 4, '.', '')}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentasIva->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasIva->nombre_cuenta }}</td>
                                        <td style="width:10%">{{number_format($producto->p_iva, 4, '.', '')}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentasRetIva->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasRetIva->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{number_format($totalRiva, 4, '.', '')}}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentasRetIsr->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasRetIsr->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{number_format($totalIsr, 4, '.', '')}}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    @php
                                        $total += $producto->total;
                                        $totalIsr += $producto->p_risr;
                                        $totalRiva += $producto->p_riva;
                                        $totalIva += $producto->p_iva;
                                        $totalImp += $producto->importe;
                                        $sumaIgualDebe = $totalImp + $totalIva;
                                        $sumasIguales = $totalRiva + $totalIsr + $total;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table">
                            <tr>
                                <td style="width:15%">{{ $gasto->proveedor->cuentas->numero_cuenta }}</td>
                                <td style="width:40%">{{ $gasto->proveedor->cuentas->nombre_cuenta }}</td>
                                <td style="width:10%"></td>
                                <td style="width:10%">{{number_format($total, 4, '.', '')}}</td>
                                <td style="width:15%">{{ $gasto->num_factura}}</td>
                                <td style="width:10%">{{ $gasto->id}}</td>
                            </tr>
                            <tr>
                                <td style="width:15%"></td>
                                <td style="width:40%">Sumas Iguales</td>
                                <td style="width:10%">{{number_format($sumaIgualDebe, 4, '.', '')}}</td>
                                <td style="width:10%">{{number_format($sumasIguales, 4, '.', '')}}</td>
                                <td style="width:15%">{{ $gasto->num_factura}}</td>
                                <td style="width:10%">{{ $gasto->id}}</td>
                            </tr>
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