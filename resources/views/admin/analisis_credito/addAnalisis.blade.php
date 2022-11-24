@extends('layouts.AdminLTE.index')
@section('title', 'Solicitud')
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
                Editar Solicitud
            </h4>
        </div>
        <form method="POST" action="{{action('SolicitudAdminController@update', $solicitud->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
    
        <div class="card-body">
            <input type="hidden" id="idCliente" name="idCliente">
            <input type="hidden" id="idAsociado" name="idAsociado">
            <input type="hidden" id="idOperador" name="idOperador">
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nombre_cliente" class="">Nombre del Cliente</label>
                        <select type="select" id="txt_nombre_cliente" name="txt_nombre_cliente" class="form-control select2 " required>
                            <option value="">Seleccionar</option>
                            @foreach($clientes as $cliente)
                                <option {{ old('txt_nombre_cliente') == $cliente->id ? 'selected' : ($opcionCliente != "N/A" ? ($opcionCliente == $cliente->id ? 'selected' : '')  : '') }} value="{{$cliente->id}}">{{$cliente->getFullname()}}</option>
                            @endforeach
                        </select>
                        @error('userType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_asociado">Asociado</label>
                        <input type="text" id="txt_asociado" name="txt_asociado" class="form-control text-uppercase" placeholder="Nombre del asociado">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_operador">Operador</label>
                        <input type="text" id="txt_operador" name="txt_operador" class="form-control text-uppercase" placeholder="Nombre del operador">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="txt_edad" class="">Edad</label>
                        <input name="txt_edad" id="txt_edad" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_genero">Género</label>
                        <select class="form-control" id="txt_genero" name="txt_genero">
                            <option value="MASCULINO" >Masculino</option>
                            <option value="FEMENINO">Femenino</option>
                            <option value="INDISTINTO">Indistinto</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_celular">Celular</label>
                        <input type="text" id="txt_celular" name="txt_celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                </div>
               
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado_civil">Estado Civil</label>
                        <select class="form-control" id="txt_estado_civil" name="txt_estado_civil">
                            <option value="SOLTERO(A)">Soltero(a)</option>
                            <option value="CASADO(A)">Casado(a)</option>
                            <option value="UNION LIBRE">Union Libre</option>
                            <option value="DIVORCIADO(A)">Divorciado(a)</option>
                            <option value="VIUDO(A)">Viuda(a)</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_escolaridad">Escolaridad</label>
                        <select class="form-control" id="txt_escolaridad" name="txt_escolaridad">
                            <option value="NINGUNA">Ninguna</option>
                            <option value="LEER Y ESCRIBIR">Leer y Escribir</option>
                            <option value="PREESCOLAR">Preescolar</option>
                            <option value="PRIMARIA">Primaria</option>
                            <option value="SECUNDARIA">Secundaria</option>
                            <option value="PREPARATORIA">Preparatoria</option>
                            <option value="LICENCIATURA">Licenciatura</option>
                            <option value="MAESTRIA">Maestria</option>
                            <option value="DOCTORADO">Doctorado</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_profesion">Profesión</label>
                        <input type="text" id="txt_profesion" name="txt_profesion" class="form-control text-uppercase" placeholder="Profesión">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_tipo_vivienda">Tipo Vivienda</label>
                        <select class="form-control" id="txt_tipo_vivienda" name="txt_tipo_vivienda">
                            <option value="PROPIA">Propia</option>
                            <option value="RENTADA">Rentada</option>
                            <option value="FAMILIAR">Familiar</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_direccion">Dirección</label>
                        <input type="text" id="txt_direccion" name="txt_direccion" class="form-control text-uppercase" placeholder="Dirección">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theCp">
                        <label for="txt_codigo_postal">Codigo Postal</label>
                        <input type="text" id="txt_codigo_postal" name="txt_codigo_postal" class="form-control" placeholder="Codigo Postal">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_colonia">Colonia</label>
                        <input type="text" id="txt_colonia" name="txt_colonia" class="form-control" placeholder="Codigo Postal">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_ciudad">Ciudad</label>
                        <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control" placeholder="Ciudad">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado">Estado</label>
                        <input type="text" id="txt_estado" name="txt_estado" class="form-control" placeholder="Estado">
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_tipo_cliente">Tipo de Cliente</label>
                        <select class="form-control" id="txt_tipo_cliente" name="txt_tipo_cliente">
                            <option value="NUEVO">Nuevo</option>
                            <option value="RENOVACION">Renovación</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_dependientes_economicos">Dependientes Economicos</label>
                        <input type="text" id="txt_dependientes_economicos" name="txt_dependientes_economicos" class="form-control" placeholder="Dependientes Economicos" required maxlength="3" value="{{$solicitud->dependientes_economicos}}" disabled>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_ingreso_mensual">Ingreso Mensual</label>
                        <input type="text" id="txt_ingreso_mensual" name="txt_ingreso_mensual" class="form-control" placeholder="0.00" value="{{number_format($solicitud->ingreso_mensual,2)}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_gasto_mensual">Gasto Mensual</label>
                        <input type="text" id="txt_gasto_mensual" name="txt_gasto_mensual" class="form-control" placeholder="0.00" value="{{number_format($solicitud->gasto_mensual,2)}}" disabled>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_ciclo">Ciclo</label>
                        <input type="text" id="txt_ciclo" name="txt_ciclo" class="form-control" placeholder="Ciclo" value="{{$solicitud->ciclo}}" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_monto_solicitado">Monto Solicitado</label>
                        <input type="text" id="txt_monto_solicitado" name="txt_monto_solicitado" class="form-control" placeholder="0.00" value="{{number_format($solicitud->monto_solicitado,2)}}" disabled>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_capacidad_pago">Capacidad de Pago</label>
                        <input type="text" id="txt_capacidad_pago" name="txt_capacidad_pago" class="form-control" placeholder="%"  value="{{$solicitud->capacidad_pago}}" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_frecuencia_pago">Frecuencia de Pago</label>
                        <select class="form-control" id="txt_frecuencia_pago" name="txt_frecuencia_pago" disabled>
                            <option {{ $solicitud->frecuencia_pago == 'SEMANAL' ? 'selected' : ''}} value="SEMANAL" >Semanal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_producto">Producto</label>
                        <select class="form-control" id="txt_producto" name="txt_producto" disabled>
                            <option {{ $solicitud->producto == 'ME ALCANZA' ? 'selected' : ''}} value="ME ALCANZA">Me Alcanza</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_tasa">Tasa</label>
                        <select class="form-control" id="txt_tasa" name="txt_tasa" disabled>
                            <option {{ $solicitud->tasa == '40' ? 'selected' : ''}} value="40">40%</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_plazo">Plazo</label>
                        <select class="form-control" id="txt_plazo" name="txt_plazo" disabled>
                            <option {{ $solicitud->plazo == '14' ? 'selected' : ''}} value="14">14</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_cuota">Cuota</label>
                        <input type="text" id="txt_cuota" name="txt_cuota" class="form-control" placeholder="0.00" value="{{$solicitud->cuota}}" disabled>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fsolicitud">Fecha Solicitud</label>
                        <input type="text" id="txt_fsolicitud" name="txt_fsolicitud" class="form-control" value="{{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y')}}" disabled>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fdesembolso">Fecha de Desembolso</label>
                        <input type="text" id="txt_fdesembolso" name="txt_fdesembolso" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ \Carbon\Carbon::parse($solicitud->fecha_desembolso)->format('d/m/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fprimer_pago">Fecha de Primer Pago</label>
                        <input type="text" id="txt_fprimer_pago" name="txt_fprimer_pago" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ \Carbon\Carbon::parse($solicitud->fecha_primer_pago)->format('d/m/Y')}}" disabled>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fvencimiento">Fecha de Vencimiento</label>
                        <input type="text" id="txt_fvencimiento" name="txt_fvencimiento" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ \Carbon\Carbon::parse($solicitud->fecha_vencimiento)->format('d/m/Y')}}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="txt_monto_autorizado">Monto Autorizado</label>
                    <input type="text" name="txt_monto_autorizado" class="form-control is-valid" id="txt_monto_autorizado" placeholder="0.00">
                </div>
            </div>
            <div class="float-right">
                @csrf
                <button type="button" class="btn btn-block btn-primary" onclick="calcularTablaAmortizacionRiesgo()"> Calcular</button>
            </div>
            <br><br><hr>
            <div class="row">
                <div class="col-12 table-responsive">
                    <p class="lead text-center"><b>Tabla de Amortización</b></p>
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




function calculoTotal(){
    let monto_solicitado = convertir($("#txt_monto_solicitado").val());
    let ingreso_mensual = convertir($("#txt_ingreso_mensual").val());
    let gasto_mensual = convertir($("#txt_gasto_mensual").val());
    let tasa = $("#txt_tasa").val();
    let plazo = $("#txt_plazo").val();
    let porcentaje = tasa * (1/100);

    if (isNaN(monto_solicitado) || isNaN(tasa) || isNaN(plazo)) {
        $("#txt_total").val("")
    }else{   
        let formulaTotal = ((monto_solicitado * porcentaje) + monto_solicitado);
        let fPagoSemanal = formulaTotal / plazo
        let fCapPago = (ingreso_mensual - gasto_mensual) / formulaTotal
        $("#txt_total").html(formato_numero(formulaTotal,2,'.',','))
        $("#txt_total_val").val(formato_numero(formulaTotal,2,'.',','))
        $("#txt_pago_semanal").html(formato_numero(fPagoSemanal,2,'.',','))
        $("#txt_pago_val").val(formato_numero(fPagoSemanal,2,'.',','))
        $("#txt_cap_pago").html(fCapPago.toFixed(4))
        $("#txt_cal_capPago").val(fCapPago.toFixed(4))
    }

}

function capacidadPago(){
    let ingreso = convertir($("#txt_ingreso_mensual").val());
    let gasto_mensual = convertir($("#txt_gasto_mensual").val());
    let monto_solic = convertir($("#txt_monto_solicitado").val());
    if (isNaN(ingreso) || isNaN(gasto_mensual) || isNaN(monto_solic)) {
        $("#txt_capacidad_pago").val("")
    }else{   
        let formula = ((ingreso - gasto_mensual) / monto_solic) * 100
        let resultado = formula.toFixed(2)
        $("#txt_capacidad_pago").val(resultado)
    }

}

function cuota(){
    let monto_solicitado = convertir($("#txt_monto_solicitado").val());
    let tasa = $("#txt_tasa").val();
    let plazo = $("#txt_plazo").val();
    let porcentaje = tasa * (1/100);

    if (isNaN(monto_solicitado) || isNaN(tasa) || isNaN(plazo)) {
        $("#txt_cuota").val("")
    }else{   
        let formulaCuota = ((monto_solicitado * porcentaje) + monto_solicitado) / plazo
        let saldoPendiente= ((monto_solicitado * porcentaje) + monto_solicitado)
        let resultado2 = formulaCuota.toFixed(2)
        $("#txt_cuota").val(resultado2)
    }

}

function calcularTablaAmortizacionRiesgo(){
    
    let cuota = document.getElementById("txt_cuota").value;
    let plazo = document.getElementById("txt_plazo").value;
    let tasa = document.getElementById("txt_tasa").value;
    let frecuencia_pago = document.getElementById("txt_frecuencia_pago").value;
    let monto_solicitado = document.getElementById("txt_monto_solicitado").value;
    let monto_autorizado = document.getElementById("txt_monto_autorizado").value;
    let fecha_desembolso = document.getElementById("txt_fdesembolso").value;
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/detalleTablaAmortizacion',
        url: "{{ asset('admin/analisis_credito/detalleTablaAmortizacion') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            monto_solicitado : monto_solicitado,
            monto_autorizado : monto_autorizado,
            fecha_desembolso : fecha_desembolso,
            cuota : cuota,
            plazo : plazo,
            tasa : tasa,
            frecuencia_pago : frecuencia_pago,
        },
        
        success:function(data){
            console.log(data);
            vistaTablaAmortizacion(data);
        }
    });

}

function vistaTablaAmortizacion(tabla) {
    let html = '';
    tabla.forEach(fila =>  {
        
        html += '<tr><td>'+fila.mes+'</td><td>'+moment(fila.fecha_pago).utc().format('DD/MM/YYYY')+'</td><td>'+fila.cuota+'</td><td>'+fila.capital+'</td><td>'+fila.interes+'</td><td class="text-center">'+fila.saldo+'</td><td>'+fila.gasto_por_cobranza+'</td></tr>'
    })
    $("#tablaAmortizacion").html(html);
}

function variablesDeRiesgoEdad(){
    let variable = document.getElementById("txt_var_edad").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion').html(data[0].calificacion);
            $('#txt_cal_edad').val(data[0].calificacion);
            $('#txt_beta').html(data[0].beta);
            $('#txt_severidad').html(data[0].var);
            $('#txt_zeta_edad').val(data[0].zeta);
            $('#txt_z_edad').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });

}

function variablesDeRiesgoGenero(){
    let variable = document.getElementById("txt_var_sexo").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",
        
        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_sex').html(data[0].calificacion);
            $('#txt_cal_genero').val(data[0].calificacion);
            $('#txt_beta_sex').html(data[0].beta);
            $('#txt_severidad_sex').html(data[0].var);
            $('#txt_zeta_sex').val(data[0].zeta);
            $('#txt_z_sex').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });
}

function variablesDeRiesgoVivienda(){
    let variable = document.getElementById("txt_var_vivienda").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_viv').html(data[0].calificacion);
            $('#txt_cal_viv').val(data[0].calificacion);
            $('#txt_beta_viv').html(data[0].beta);
            $('#txt_severidad_viv').html(data[0].var);
            $('#txt_zeta_viv').val(data[0].zeta);
            $('#txt_z_viv').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });
}

function variablesDeRiesgoEdoCivil(){
    let variable = document.getElementById("txt_var_edo_civil").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_civil').html(data[0].calificacion);
            $('#txt_cal_edcivil').val(data[0].calificacion);
            $('#txt_beta_civil').html(data[0].beta);
            $('#txt_severidad_civil').html(data[0].var);
            $('#txt_zeta_civil').val(data[0].zeta);
            $('#txt_z_civil').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });
}

function variablesDeRiesgoDepEc(){
    let variable = document.getElementById("txt_var_depEc").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_dep').html(data[0].calificacion);
            $('#txt_cal_dep').val(data[0].calificacion);
            $('#txt_beta_dep').html(data[0].beta);
            $('#txt_severidad_dep').html(data[0].var);
            $('#txt_zeta_dep').val(data[0].zeta);
            $('#txt_z_dep').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });
}

function variablesDeRiesgoEsc(){
    let variable = document.getElementById("txt_var_esc").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_esc').html(data[0].calificacion);
            $('#txt_cal_escol').val(data[0].calificacion);
            $('#txt_beta_esc').html(data[0].beta);
            $('#txt_severidad_esc').html(data[0].var);
            $('#txt_zeta_esc').val(data[0].zeta);
            $('#txt_z_esc').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });
}

function variablesDeRiesgoCiclo(){
    let variable = document.getElementById("txt_var_ciclo").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_ciclo').html(data[0].calificacion);
            $('#txt_cal_ciclo').val(data[0].calificacion);
            $('#txt_beta_ciclo').html(data[0].beta);
            $('#txt_severidad_ciclo').html(data[0].var);
            $('#txt_zeta_ciclo').val(data[0].zeta);
            $('#txt_z_ciclo').html(data[0].zeta);

            calculoScore();
            calculoZ();
        }
    });
}

function variablesDeRiesgoIngreso(){
    let variable = document.getElementById("txt_var_ingreso").value;    
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/variableRiesgo',
        url: "{{ asset('admin/analisis_credito/variableRiesgo') }}",

        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            variable : variable
        },
        
        success:function(data){
            console.log(data);
            $('#txt_calificacion_ingreso').html(data[0].calificacion);
            $('#txt_cal_ingreso').val(data[0].calificacion);
            $('#txt_beta_ingreso').html(data[0].beta);
            $('#txt_severidad_ingreso').html(data[0].var);
            $('#txt_zeta_ingreso').val(data[0].zeta);
            $('#txt_z_ingreso').html(data[0].zeta);

            calculoScore();
            calculoZ();
            calculoIndiceSev();
        }
    });
}

function calculoScore(){
    let califEdad = $("#txt_cal_edad").val();
    let califGenero = $("#txt_cal_genero").val();
    let califViv = $("#txt_cal_viv").val();
    let califEdoCivil = $("#txt_cal_edcivil").val();
    let califDep = $("#txt_cal_dep").val();
    let califEsc = $("#txt_cal_escol").val();
    let califCiclo = $("#txt_cal_ciclo").val();
    let califIngreso = $("#txt_cal_ingreso").val();
    let califCapPago = $("#txt_cal_capPago").val();

    let formulaScore = (parseFloat(califEdad) + parseFloat(califGenero) + parseFloat(califViv) + parseFloat(califEdoCivil) + parseFloat(califDep) + parseFloat(califEsc) + parseFloat(califCiclo)  + parseFloat(califIngreso)  + parseFloat(califCapPago))

    if (isNaN(formulaScore)) {
        $("#txt_score").html("--")
    }else{   
        $("#txt_score").html(formulaScore.toFixed(4))
        $("#txt_score_val").val(formulaScore.toFixed(4))
    }

}

function calculoZ(){
    let zetaEdad = $("#txt_zeta_edad").val();
    let zetaGenero = $("#txt_zeta_sex").val();
    let zetaViv = $("#txt_zeta_viv").val();
    let zetaEdoCivil = $("#txt_zeta_civil").val();
    let zetaDep = $("#txt_zeta_dep").val();
    let zetaEsc = $("#txt_zeta_esc").val();
    let zetaCiclo = $("#txt_zeta_ciclo").val();
    let zetaIngreso = $("#txt_zeta_ingreso").val();

    let formulaZ = - parseFloat( 1.9411) +((parseFloat(zetaEdad) + parseFloat(zetaGenero) + parseFloat(zetaViv) + parseFloat(zetaEdoCivil) + parseFloat(zetaDep) + parseFloat(zetaEsc) + parseFloat(zetaCiclo)  + parseFloat(zetaIngreso)) - parseFloat(zetaEsc))

    if (isNaN(formulaZ)) {
        $("#txt_z").html("--")
    }else{   
        $("#txt_z").html(formulaZ.toFixed(4))
        $("#txt_zeta_val").val(formulaZ.toFixed(4))
        calcularProbabilidad()
    }
   
}

function calcularProbabilidad(){
    let zeta = $("#txt_zeta_val").val();

    let formulaProbabilidad = (parseFloat(1) / (parseFloat(1) + Math.pow(parseFloat(2.7183), - parseFloat(zeta))))
    
    if (isNaN(formulaProbabilidad)) {
        $("#txt_probabilidad_incumplimiento").html("--")
    }else{   
        $("#txt_probabilidad_incumplimiento").html((formulaProbabilidad *= 100).toFixed(4))
        $("#txt_incumplimi_val").val((formulaProbabilidad *= 100).toFixed(4))
        calculoVar();
    }
    
}

function calculoIndiceSev(){
    let zetaSeveridad = $("#txt_zeta_ingreso").val();

    let resultZetaSev = parseFloat(zetaSeveridad);
    
    if (isNaN(resultZetaSev)) {
        $("#txt_indice_sev").html("--")
    }else{   
        $("#txt_indice_val").val(resultZetaSev.toFixed(4))
        $("#txt_indice_sev").html(resultZetaSev.toFixed(4))
        calculoSeveridad();
    }
}

function calculoSeveridad(){
    let indiceSev = $("#txt_indice_val").val();
    let monto_solic = convertir($("#txt_monto_solicitado").val());
    let resultCalculoSev = 1 - (parseFloat(indiceSev) / parseFloat(monto_solic));
    
    if (isNaN(resultCalculoSev)) {
        $("#txt_calculo_sev").html("--")
    }else{   
        $("#txt_calculo_sev").html(resultCalculoSev.toFixed(4))
        $("#txt_calculo_val").val(resultCalculoSev.toFixed(4))
        calculoPerdidaEsperada();
    }
    
}

function calculoPerdidaEsperada(){
   
    let incumplimiento = $("#txt_incumplimi_val").val();
    let calculoSev = $("#txt_calculo_val").val();
    let monto_solic = convertir($("#txt_monto_solicitado").val());
    let incumplimientoPorc = parseFloat(incumplimiento) /100;
    incumplimientoPorc = incumplimientoPorc /100;
    let resultPerdida = (parseFloat(incumplimientoPorc) * parseFloat(calculoSev) * monto_solic );
   
    if (isNaN(resultPerdida)) {
        $("#txt_perdida_esperada").html("--")
    }else{   
        $("#txt_perdida_val").val(resultPerdida.toFixed(2))
        $("#txt_perdida_esperada").html(resultPerdida.toFixed(2))
    }
    
}

function calculoVar(){
   
    let incumplimiento = $("#txt_incumplimi_val").val();
    let monto_solic = convertir($("#txt_monto_solicitado").val());
    let incumplimientoPorc = parseFloat(incumplimiento) /100;
    incumplimientoPorc = incumplimientoPorc /100;
    let resultVar = (parseFloat(incumplimientoPorc) * monto_solic );
   
    if (isNaN(resultVar)) {
        $("#txt_var_rsult").html("--")
    }else{   
        $("#txt_var_val").val(resultVar.toFixed(2))
        $("#txt_var_rsult").html(resultVar.toFixed(2))
    }
    
}

function verMontoAutorizado(){
    let monto_autorizado = $("#txt_monto_autorizado").val();
    $("#txt_monto_aprobado").html(monto_autorizado);  
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