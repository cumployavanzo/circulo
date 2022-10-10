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
                                    <th style="width:10%">N° Pago</th>
                                </tr>
                            </thead>  
                                <tr>
                                    <td style="width:15%">{{ $cuentaTipoPago->numero_cuenta }}</td>
                                    <td style="width:40%">{{ $cuentaTipoPago->nombre_cuenta }}</td>
                                    <td style="width:10%">{{$gasto->total}}</td>
                                    <td style="width:15%"></td>
                                    <td style="width:10%">{{ $gasto->id}}</td>
                                </tr>
                                <tr>
                                    <td style="width:15%">100-600-100-005</td>
                                    <td style="width:40%">SOCIOS O ACCIONISTAS</td>
                                    <td style="width:10%"></td>
                                    <td style="width:10%">{{$gasto->total}}</td>
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