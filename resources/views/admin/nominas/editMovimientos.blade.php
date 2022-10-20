@extends('layouts.AdminLTE.index')
@section('title', 'Nomina')
@section('header', 'Nomina')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Agregar Detalles
            </h4>
        </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.movNomina.store') }}" autocomplete="off">
                @csrf
                <input type="hidden" id="idDetalle" name="idDetalle" value="{{$detalleNomina->id}}">
                <input type="hidden" id="sueldo" name="sueldo" value="{{$detalleNomina->sueldo}}">
                <input type="hidden" id="idDetallePrestamo" name="idDetallePrestamo">
                <input type="hidden" id="monto_prestamo" name="monto_prestamo">
                <div class="form-group">
                    <div class="card-header">
                        <h5><i class="fas fa-user"></i>&nbsp; {{$detalleNomina->personals->getFullName()}} <small class="float-right">Fecha Alta: {{$detalleNomina->personals->fecha_alta}}</small></h5>
                        <address>
                            <strong>{{$detalleNomina->personals->puestoid->puesto}}</strong><br>
                            Sueldo diario: <b class="text-success">$ {{number_format($detalleNomina->personals->sueldo_mensual / 30, 2, '.', '')}}</b><br>
                            @if ($nomina->modalidad == 'SEMANAL')
                                Sueldo Semanal: <b class="text-success" id="sueldo">$ {{number_format($detalleNomina->sueldo, 2, '.', '')}}</b><br>
                            @elseif ($nomina->modalidad == 'QUINCENAL')
                                Sueldo Quincenal: <b class="text-success" id="sueldo">$ {{number_format($detalleNomina->sueldo, 2, '.', '')}}</b><br>
                            @elseif ($nomina->modalidad == 'MENSUAL')
                                Sueldo Mensual: <b class="text-success" id="sueldo">$ {{number_format($detalleNomina->sueldo, 2, '.', '')}}</b><br>
                            @endif
                        </address>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Concepto</label>
                                            <div class="col-lg-5">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-list"></i></span>
                                                    </div>
                                                    <select type="select" id="txt_concepto_nomina" name="txt_concepto_nomina" class="form-control select2 " required onchange="validarPrestamo({{$detalleNomina->personals_id}})">
                                                        <option value="">Selecciona</option>
                                                        @foreach($conceptoNomina as $conceptoNom)
                                                            <option {{ old('txt_concepto_nomina') == $conceptoNom->id ? 'selected' : '' }} value="{{$conceptoNom->id}}">{{$conceptoNom->conceptos}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('userType')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if (\Session::has('errorMessage'))   
                                                <span id="msjValidacion" class="text-danger"><b> {!! \Session::get('errorMessage') !!}</b></span>
                                            @endif
                                        </div>
                                       
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label" for="txt_monto">Monto</label>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="txt_monto" name="txt_monto">
                                                </div>
                                            </div>
                                            <span id="msjPagos" class="text-success bold"></span>
                                        </div>
                                        
                                        <hr class="m-6">
                                        <button type="submit" class="btn btn-block btn-info">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Concepto</th>
                                    <th>Tipo</th>
                                    <th>Monto Persepción</th>
                                    <th>Monto Deducción</th>
                                    <th>Neto a Pagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SUELDO</td>
                                    <td>Persepción</td>
                                    <td>{{number_format($detalleNomina->sueldo, 2, '.', '')}}</td>
                                    <td>-- --</td>
                                    <td>-- --</td>
                                </tr>
                                @php
                                    $sumaPersepcion = 0;
                                    $sumaDeduccion = 0;
                                    $netoPagar = 0;
                                @endphp
                                @foreach($movDetalles as $detalles)
                                    <tr>
                                        <td>{{$detalles->concepto->conceptos}}</td>
                                        <td>{{$detalles->concepto->tipo}}</td>
                                        @if ($detalles->concepto->tipo == 'Persepcion')
                                            <td>{{$detalles->monto}}</td>
                                            <td></td>
                                            <td></td>
                                            @php
                                                $sumaPersepcion += $detalles->monto;
                                            @endphp
                                        @elseif ($detalles->concepto->tipo == 'Deduccion')
                                            <td></td>
                                            <td>{{$detalles->monto}}</td>
                                            <td></td>
                                            @php
                                                $sumaDeduccion += $detalles->monto;
                                            @endphp
                                        @endif
                                    </tr>
                                    
                                @endforeach
                                    @php
                                       
                                        $totalPersepcion = $detalleNomina->sueldo + $sumaPersepcion;
                                        $totalDeduccion = $sumaDeduccion;
                                        $netoPagar = $totalPersepcion - $totalDeduccion;
                                    @endphp
                                    <tr class="text-bold">
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td class="text-info" id="totalPersepcion">$ {{number_format($totalPersepcion, 2, '.', '')}}</td>
                                        <td class="text-danger" id="totalDeduccion">$ {{number_format($totalDeduccion, 2, '.', '')}}</td>
                                        <td class="text-success" id="netoPagar" name="netoPagar">$ {{number_format($netoPagar, 2, '.', '')}}</td>
                                    </tr>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </form>
            </div><!-- /.card-body -->  
            <div class="card-footer">
                <a href="{{ route('admin.nomina.edit', [$nomina->id]) }}" type="button" class="btn btn-outline-info btn-sm float-right" title="Regresar"><i class="fas fa-arrow-left"></i>&nbsp; Regresar</a>
            </div>                                      
</div>
@endsection
@push('scripts')

<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $("#txt_monto").maskMoney({
        decimal: ".",
        thousands: ","
    })

    $("#txt_concepto_nomina").select2({
        theme:"bootstrap4"
    });
    
    function validarPrestamo(idEmpleado){
        let IDconcepto = document.getElementById("txt_concepto_nomina").value;
        $("#msjValidacion").html("");
        csrfc = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            type: 'POST',
            url: '/admin/movNomina/verificarPrestamos',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            data: {
                _token: csrfc,
                idEmpleado : idEmpleado,
                IDconcepto : IDconcepto,
            },
        
            success: function(data){
               console.log(data);
                $("#msjPagos").val("")
                if(data.pagosP){
                    $('#idDetallePrestamo').val(data.detalles.id);
                    $('#monto_prestamo').val(data.detalles.monto_pago)
                    $('#txt_monto').val(data.detalles.monto_pago).attr('disabled', true)
                    $('#msjPagos').html('Préstamo Personal: <b>'+data.pagosP+' pago(s) pendiente(s).</b>')
                }
            }
        });
       
    }
    
</script>
@endpush