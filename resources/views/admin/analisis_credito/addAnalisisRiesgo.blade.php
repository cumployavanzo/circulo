@extends('layouts.AdminLTE.index')
@section('title', 'Analisis de Credito')
@section('header', 'Solicitud')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('mensaje')}}
            </div>  
        @endif  
        <div class="card-header">
            <h4 class="card-title">
                Analisis de Credito
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.analisis_credito.store') }}" autocomplete="off">
        @csrf
    
        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-address-card"></i> {{$solicitud->cliente->getFullname()}}
                      <small class="float-right">Fecha Solicitud: {{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y')}}</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    <address>
                      <strong>{{$solicitud->cliente->ciudad_nacimiento}}</strong><br>
                      {{ $solicitud->cliente->colonia}}, {{ $solicitud->cliente->estado}}<br>
                      Telefono: {{ $solicitud->cliente->celular}}<br>
                      Dirección: {{ $solicitud->cliente->direccion}}<br>
                      Codigo Postal : {{ $solicitud->cliente->cp}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <address>
                        Asociado: {{$solicitud->asociado->getFullname()}}<br>
                        Operador: {{$solicitud->asociado->operadores->getFullname()}}<br>
                        Producto: <b>{{ $solicitud->producto->nombre}}</b><br>
                        Tasa: <b>{{ $solicitud->tasa}} %</b><br>
                        Plazo: <b>{{ $solicitud->plazo}}</b>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <input type="hidden" id="txt_idSolicitud" name="txt_idSolicitud" value="{{$solicitud->id}}">
                    <input type="hidden" id="txt_cuota" name="txt_cuota" value="{{$solicitud->cuota}}">
                    <input type="hidden" id="txt_plazo" name="txt_plazo" value="{{$solicitud->plazo}}">
                    <input type="hidden" id="txt_frecuencia_pago" name="txt_frecuencia_pago" value="{{$solicitud->frecuencia_pago}}">
                    <input type="hidden" id="txt_tasa" name="txt_tasa" value="{{$solicitud->tasa}}">
                    <input type="hidden" id="txt_fdesembolso" name="txt_fdesembolso" value="{{$solicitud->fecha_desembolso}}">
                    <input type="hidden" id="txt_monto_solicitado" name="txt_monto_solicitado" value="{{$solicitud->monto_solicitado}}">
                    <input type="hidden" id="txt_gasto_mensual" name="txt_gasto_mensual" value="{{$solicitud->gasto_mensual}}">
                    <input type="hidden" id="txt_ingreso_mensual" name="txt_ingreso_mensual" value="{{$solicitud->ingreso_mensual}}">
                    <input type="hidden" id="txt_fecha_desembolso" name="txt_fecha_desembolso" value="{{$solicitud->ingreso_mensual}}">
                    <b>Monto Solicitado: {{ number_format($solicitud->monto_solicitado,2,'.',',') }}</b><br>
                    Ingreso Mensual: <b>{{ number_format($solicitud->ingreso_mensual,2,'.',',') }}</b><br>
                    Gasto Mensual: <b>{{ number_format($solicitud->gasto_mensual,2,'.',',') }}</b><br>
                    Capacidad de pago: <b>{{ $solicitud->capacidad_pago}}</b><br>
                    Frecuencia de pago: <b>{{ $solicitud->frecuencia_pago}}</b>
                    
                  </div>
                  
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label" for="txt_monto_autorizado">Monto Autorizado</label>
                                <input type="text" name="txt_monto_autorizado" class="form-control is-valid" id="txt_monto_autorizado" placeholder="0.00" onchange="verMontoAutorizado()">
                            </div>
                        </div>
                      <button type="button" class="btn btn-primary float-right" onclick="calcularTablaAmortizacionRiesgo()"><i class="fas fa-calculator"></i> Calcular</button>
                    </div>
                  </div>
                <!-- /.row -->
                <br>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha de Pago</th>
                                <th>Pago</th>
                                <th>Capital</th>
                                <th>Interes</th>
                                <th>Saldo Pendiente</th>
                                <th>Gasto por cobranza</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAmortizacion">
                        </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <br>
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Constante</th>
                                <th>Variable</th>
                                <th>Calificacion</th>
                                <th>Severidad de Pago</th>
                                <th>Beta</th>
                                <th>Z</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Edad</td>
                            <td>{{ $solicitud->cliente->edad}}</td>
                            <td class="text-right py-0 align-middle">
                            <input type="hidden" id="txt_cal_edad" name="txt_cal_edad" value="">
                            <input type="hidden" id="txt_zeta_edad" name="txt_zeta_edad" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_edad" name="txt_var_edad" class="form-control select2 " onchange="variablesDeRiesgoEdad()">
                                        <option value="">Selecciona</option>
                                        @foreach($varEdad as $edad)
                                            <option {{ old('txt_var_edad') == $edad->id ? 'selected' : '' }} value="{{$edad->id}}">{{$edad->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_edad" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Sexo</td>
                            <td>{{ $solicitud->cliente->genero}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_genero" name="txt_cal_genero" value="">
                                <input type="hidden" id="txt_zeta_sex" name="txt_zeta_sex" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_sexo" name="txt_var_sexo" class="form-control select2 " onchange="variablesDeRiesgoGenero()">
                                        <option value="">Selecciona</option>
                                        @foreach($varSexo as $sexo)
                                            <option {{ old('txt_var_sexo') == $sexo->id ? 'selected' : '' }} value="{{$sexo->id}}">{{$sexo->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>  
                            <td id="txt_calificacion_sex" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_sex" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_sex" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_sex" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Entidad Federativa</td>
                            <td>{{ $solicitud->cliente->ciudad_nacimiento}}</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Tipo de Vivienda</td>
                            <td>{{ $solicitud->cliente->tipo_vivienda}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_viv" name="txt_cal_viv" value="">
                                <input type="hidden" id="txt_zeta_viv" name="txt_zeta_viv" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_vivienda" name="txt_var_vivienda" class="form-control select2 "  onchange="variablesDeRiesgoVivienda()">
                                        <option value="">Selecciona</option>
                                        @foreach($varVivienda as $vivienda)
                                            <option {{ old('txt_var_vivienda') == $vivienda->id ? 'selected' : '' }} value="{{$vivienda->id}}">{{$vivienda->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion_viv" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_viv" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_viv" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_viv" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Estado Civil</td>
                            <td>{{ $solicitud->cliente->estado_civil}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_edcivil" name="txt_cal_edcivil" value="">
                                <input type="hidden" id="txt_zeta_civil" name="txt_zeta_civil" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_edo_civil" name="txt_var_edo_civil" class="form-control select2 " onchange="variablesDeRiesgoEdoCivil()">
                                        <option value="">Selecciona</option>
                                        @foreach($varEstadoC as $edoCivil)
                                            <option {{ old('txt_var_edo_civil') == $edoCivil->id ? 'selected' : '' }} value="{{$edoCivil->id}}">{{$edoCivil->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion_civil" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_civil" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_civil" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_civil" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Dependientes Economicos</td>
                            <td>{{ $solicitud->dependientes_economicos}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_dep" name="txt_cal_dep" value="">
                                <input type="hidden" id="txt_zeta_dep" name="txt_zeta_dep" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_depEc" name="txt_var_depEc" class="form-control select2 " onchange="variablesDeRiesgoDepEc()">
                                        <option value="">Selecciona</option>
                                        @foreach($varDepEcon as $dependientes)
                                            <option {{ old('txt_var_depEc') == $dependientes->id ? 'selected' : '' }} value="{{$dependientes->id}}">{{$dependientes->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion_dep" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_dep" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_dep" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_dep" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Escolaridad</td>
                            <td>{{ $solicitud->cliente->escolaridad}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_escol" name="txt_cal_escol" value="">
                                <input type="hidden" id="txt_zeta_esc" name="txt_zeta_esc" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_esc" name="txt_var_esc" class="form-control select2 " onchange="variablesDeRiesgoEsc();">
                                        <option value="">Selecciona</option>
                                        @foreach($varEscolaridad as $escolaridad)
                                            <option {{ old('txt_var_esc') == $escolaridad->id ? 'selected' : '' }} value="{{$escolaridad->id}}">{{$escolaridad->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion_esc" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_esc" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_esc" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_esc" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Ciclo</td>
                            <td>{{ $solicitud->ciclo}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_ciclo" name="txt_cal_ciclo" value="">
                                <input type="hidden" id="txt_zeta_ciclo" name="txt_zeta_ciclo" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_ciclo" name="txt_var_ciclo" class="form-control select2 " onchange="variablesDeRiesgoCiclo()">
                                        <option value="">Selecciona</option>
                                        @foreach($varCiclo as $ciclo)
                                            <option {{ old('txt_var_ciclo') == $ciclo->id ? 'selected' : '' }} value="{{$ciclo->id}}">{{$ciclo->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion_ciclo" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_ciclo" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_ciclo" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_ciclo" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Profesion</td>
                            <td>{{ $solicitud->cliente->profesion}}</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                            <td class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        <tr>
                            <td>Ingreso Mensual</td>
                            <td>{{ $solicitud->ingreso_mensual}}</td>
                            <td class="text-right py-0 align-middle">
                                <input type="hidden" id="txt_cal_ingreso" name="txt_cal_ingreso" value="">
                                <input type="hidden" id="txt_zeta_ingreso" name="txt_zeta_ingreso" value="">
                                <div class="btn-group btn-group-sm">
                                    <select type="select" id="txt_var_ingreso" name="txt_var_ingreso" class="form-control select2 " onchange="variablesDeRiesgoIngreso()">
                                        <option value="">Selecciona</option>
                                        @foreach($varIngreso as $ingreso)
                                            <option {{ old('txt_var_ingreso') == $ingreso->id ? 'selected' : '' }} value="{{$ingreso->id}}">{{$ingreso->nombre_variable }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td id="txt_calificacion_ingreso" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_severidad_ingreso" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_beta_ingreso" class="text-right py-0 align-middle">0.00</td>
                            <td id="txt_z_ingreso" class="text-right py-0 align-middle">0.00</td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                  
                  <div class="col-5">
                  </div>
                  <div class="col-7">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Total:</th>
                          <input type="hidden" id="txt_total_val" name="txt_total_val" value="">
                          <td id="txt_total">$ 0.00</td>
                        </tr>
                        <tr>
                          <th>Pago Semanal</th>
                          <input type="hidden" id="txt_pago_val" name="txt_pago_val" value="">
                          <td id="txt_pago_semanal">$ 0.00</td>
                        </tr>
                        <tr>
                            <th>Capacidad de Pago</th>
                            <input type="hidden" id="txt_cal_capPago" name="txt_cal_capPago" value="">
                            <td id="txt_cap_pago">$0.00</td>
                          </tr>
                        <tr>
                          <th>Score de Riesgo</th>
                          <input type="hidden" id="txt_score_val" name="txt_score_val" value="">
                          <td id="txt_score">0</td>
                        </tr>
                        <tr>
                          <th>Z</th>
                          <input type="hidden" id="txt_zeta_val" name="txt_zeta_val" value="">
                          <td id="txt_z">0</td>
                        </tr>
                        <tr>
                          <th>Probabilidad de Incumplimiento</th>
                          <input type="hidden" id="txt_incumplimi_val" name="txt_incumplimi_val" value="">
                          <td id="txt_probabilidad_incumplimiento">0</td>
                        </tr>
                        <tr>
                          <th>Indice de Severidad</th>
                          <input type="hidden" id="txt_indice_val" name="txt_indice_val" value="">
                          <td id="txt_indice_sev">0</td>
                        </tr>
                        <tr>
                          <th>Calculo de Severidad</th>
                          <input type="hidden" id="txt_calculo_val" name="txt_calculo_val" value="">
                          <td id="txt_calculo_sev">0</td>
                        </tr>
                        <tr>
                          <th>Perdida Esperada</th>
                          <input type="hidden" id="txt_perdida_val" name="txt_perdida_val" value="">
                          <td id="txt_perdida_esperada">0</td>
                        </tr>
                        <tr>
                          <th>Monto Aprobado</th>
                          <td id="txt_monto_aprobado">0</td>
                        </tr>
                        <tr>
                          <th>VAR</th>
                          <input type="hidden" id="txt_var_val" name="txt_var_val" value="">
                          <td id="txt_var_rsult">0</td>
                        </tr>
                       
                      </table>
                    </div>
                    <div class="col-sm-6 float-right">
                        <div class="form-group">
                            <label for="txt_estatus_analisis">Estatus</label>
                            <select class="form-control" id="txt_estatus_analisis" name="txt_estatus_analisis">
                                <option value="Autorizado" >Autorizado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
  
                <!-- this row will not appear when printing -->
                {{-- <div class="row">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Guardar
                    </button>
                  </div>
                </div> --}}
            </div>
        </div>   
                   
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('scripts/js/riesgo.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });
    
    calculoTotal()
    
    cargarDetalles({{ $solicitud->id}})
    

    function cargarDetalles(id){
    $.ajax({
        type: "get",
        url: "{{ asset('admin/analisis_credito/detalleCliente') }}/" + id,
        type: 'get',
        success: function(data){
            console.log(data);
            $('#idCliente').val(data.cliente.id);
            $('#idAsociado').val(data.asociado.id);
            $('#idOperador').val(data.operador.id);
            $('#txt_asociado').val(data.asociado.nombre+" "+data.asociado.apellido_paterno+" "+data.asociado.apellido_materno).attr('disabled', true);
            $('#txt_operador').val(data.operador.nombre+" "+data.operador.apellido_paterno+" "+data.operador.apellido_materno).attr('disabled', true);
            $('#txt_edad').val(data.cliente.edad+" "+"Año(s)").attr('disabled', true);
            $('#txt_genero').val(data.cliente.genero).attr('disabled', true);
            $('#txt_celular').val(data.cliente.celular).attr('disabled', true);
            $('#txt_estado_civil').val(data.cliente.estado_civil).attr('disabled', true);
            $('#txt_escolaridad').val(data.cliente.escolaridad).attr('disabled', true);
            $('#txt_profesion').val(data.cliente.profesion).attr('disabled', true);
            $('#txt_tipo_vivienda').val(data.cliente.tipo_vivienda).attr('disabled', true);
            $('#txt_direccion').val(data.cliente.direccion).attr('disabled', true);
            $('#txt_codigo_postal').val(data.cliente.cp).attr('disabled', true);
            $('#txt_colonia').val(data.cliente.colonia).attr('disabled', true);
            $('#txt_ciudad').val(data.cliente.ciudad).attr('disabled', true);
            $('#txt_estado').val(data.cliente.estado).attr('disabled', true);
            $('#txt_tipo_cliente').val(data.cliente.tipo_cliente).attr('disabled', true);
        },
    })
    return false;
}

    $("#txt_nombre_cliente").select2({
        theme:"bootstrap4"
        
    });

    $("#txt_ingreso_mensual").maskMoney({
        decimal: ".",
        thousands: ","
    })
    $("#txt_gasto_mensual").maskMoney({
        decimal: ".",
        thousands: ","
    })
    $("#txt_monto_solicitado").maskMoney({
        decimal: ".",
        thousands: ","
    })
    
    $("#txt_cuota").maskMoney({
        decimal: ".",
        thousands: ","
    })

    $("#txt_monto_autorizado").maskMoney({
        decimal: ".",
        thousands: ","
    })

</script>




@endpush