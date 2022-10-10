@extends('layouts.AdminLTE.index')
@section('title', 'Movimientos')
@section('header', 'Movimientos')
@section('content')
 <div class="card card-gray">
            <div class="card-header">Contabilidad</div>
            <form method="POST" action="{{action('MovimientoGastoController@update', $detalle->id)}}" autocomplete="off">
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
                                    <th style="width:10%">N° Analisis</th>
                                </tr>
                            </thead>  
                                <tr>
                                    <td style="width:15%">{{$cuentaCliente->numero_cuenta}}</td>
                                    <td style="width:40%">{{$cuentaCliente->nombre_cuenta}}</td>
                                    <td style="width:10%">{{$credito->monto_autorizado}}</td>
                                    <td style="width:15%"></td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>
                                <tr>
                                    <td style="width:15%">{{ $cuentaTipoPago->numero_cuenta }}</td>
                                    <td style="width:40%">{{ $cuentaTipoPago->nombre_cuenta }}</td>
                                    <td style="width:10%"></td>
                                    <td style="width:15%">{{$credito->monto_autorizado}}</td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>     
                                @php
                                    $porcentaje = $producto->tasa * (1/100);
                                    $interes = ($credito->monto_autorizado * $porcentaje) / $producto->plazo;
                                    $interesOrdinario = $interes * $producto->plazo
                                @endphp
                                <tr>
                                    <td style="width:15%">800-400-100-000</td>
                                    <td style="width:40%">INTERESES ORDINARIOS CONSUMO</td>
                                    <td style="width:10%">{{number_format($interesOrdinario, 2)}}</td>
                                    <td style="width:15%"></td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>     
                               
                                <tr>
                                    <td style="width:15%">900-400-100-000</td>
                                    <td style="width:40%">INTERESES ORDINARIOS CONSUMO</td>
                                    <td style="width:10%"></td>
                                    <td style="width:15%">{{number_format($interesOrdinario, 2)}}</td>
                                    <td style="width:10%">{{ $credito->id}}</td>
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