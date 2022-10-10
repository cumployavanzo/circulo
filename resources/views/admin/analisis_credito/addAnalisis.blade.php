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