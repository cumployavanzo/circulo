@extends('layouts.AdminLTE.index')
@section('title', 'Solicitud')
@section('header', 'Solicitud')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nueva Solicitud
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.solicitud.store') }}" autocomplete="off">
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
                            <option value="">Selecciona</option>
                            @foreach($clientes as $cliente)
                                <option {{ old('txt_nombre_cliente') == $cliente->id ? 'selected' : '' }} value="{{$cliente->id}}">{{$cliente->getFullname()}}</option>
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
                            <option value="M" >Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="x">Indistinto</option>
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_tipo_vivienda">Tipo Vivienda</label>
                        <select class="form-control" id="txt_tipo_vivienda" name="txt_tipo_vivienda">
                            <option value="PROPIA">Propia</option>
                            <option value="RENTADA">Rentada</option>
                            <option value="FAMILIAR">Familiar</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="txt_direccion">Dirección</label>
                        <input type="text" id="txt_direccion" name="txt_direccion" class="form-control text-uppercase" placeholder="Dirección">
                    </div>
                </div>    
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_vialidad">Vialidad</label>
                        <select class="form-control" id="txt_vialidad" name="txt_vialidad">
                            <option value="">-- -- --</option>
                            <option value="Ampliacion">Ampliación</option>
                            <option value="Andador">Andador</option>
                            <option value="Avenida">Avenida</option>
                            <option value="Boulevard">Boulevard</option>
                            <option value="Calle">Calle</option>
                            <option value="Callejon">Callejon</option>
                            <option value="Calzada">Calzada</option>
                            <option value="Cerrada">Cerrada</option>
                            <option value="Circuito">Circuito</option>
                            <option value="Circumbalacion">Circumbalación</option>
                            <option value="Continuacion">Continuación</option>
                            <option value="Corredor">Corredor</option>
                            <option value="Diagonol">Diagonol</option>
                            <option value="Eje Vial">Eje Vial</option>
                            <option value="Pasaje">Pasaje</option>
                            <option value="Peatonal">Peatonal</option>
                            <option value="Periferico">Periferico</option>
                            <option value="Privada">Privada</option>
                            <option value="Prolongacion">Prolongación</option>
                            <option value="Retorno">Retorno</option>
                            <option value="Viaducto">Viaducto</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_entre_calles">Entre calles</label>
                        <input type="text" id="txt_entre_calles" name="txt_entre_calles" class="form-control text-uppercase" placeholder="Entre calles">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="txt_referencia">Referencia</label>
                        <input type="text" id="txt_referencia" name="txt_referencia" class="form-control text-uppercase" placeholder="Referencia">
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
                        <input type="text" id="txt_colonia" name="txt_colonia" class="form-control" placeholder="Colonia">
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
                        <label for="txt_tipo_negocio">Tipo de Negocio</label>
                        <input type="text" id="txt_tipo_negocio" name="txt_tipo_negocio" class="form-control text-uppercase" placeholder="Tipo de negocio" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_antiguedad_negocio">Antiguedad del Negocio</label>
                        <input type="text" id="txt_antiguedad_negocio" name="txt_antiguedad_negocio" class="form-control text-uppercase" placeholder="Antiguedad del negocio" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_anios_exp">Años de Experiencia</label>
                        <input type="text" id="txt_anios_exp" name="txt_anios_exp" class="form-control text-uppercase" placeholder="Años de experencia">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_establecimiento">Tipo de Establecimiento</label>
                        <select class="form-control" id="txt_establecimiento" name="txt_establecimiento">
                            <option value="Propio">Propio</option>
                            <option value="Ambulante">Ambulante</option>
                            <option value="Rentado">Rentado</option>
                            <option value="Fijo">Fijo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start"> 
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_num_hijos">Número de hijos</label>
                        <input type="text" id="txt_num_hijos" name="txt_num_hijos" class="form-control text-uppercase" placeholder="Número de hijos">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_garantia">Garantía</label>
                        <textarea class="form-control text-uppercase" rows="2" id="txt_garantia" name="txt_garantia" placeholder="Garantía ..."></textarea>                    
                    </div>
                </div>
            
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_tipo_cliente">Tipo de Cliente</label>
                        <select class="form-control" id="txt_tipo_cliente" name="txt_tipo_cliente">
                            <option value="NUEVO">Nuevo</option>
                            <option value="REINGRESO">Reingreso</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_dependientes_economicos">Dependientes Economicos</label>
                        <input type="text" id="txt_dependientes_economicos" name="txt_dependientes_economicos" class="form-control" placeholder="Dependientes Economicos" required maxlength="3">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_ingreso_mensual">Ingreso Mensual</label>
                        <input type="text" id="txt_ingreso_mensual" name="txt_ingreso_mensual" class="form-control" placeholder="0.00" onchange="capacidadPago()">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_gasto_mensual">Gasto Mensual</label>
                        <input type="text" id="txt_gasto_mensual" name="txt_gasto_mensual" class="form-control" placeholder="0.00" onchange="capacidadPago()">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_producto">Producto</label>
                        <select type="select" id="txt_producto" name="txt_producto" class="form-control select2 " required onchange="cargarProducto();">
                            <option value="">Selecciona</option>
                            @foreach($productos as $producto)
                                <option {{ old('txt_producto') == $producto->id ? 'selected' : '' }} value="{{$producto->id}}">{{$producto->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_tasa">Tasa</label>
                        <input type="text" id="txt_tasa" name="txt_tasa" class="form-control" placeholder="Tasa" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_plazo">Plazo</label>
                        <input type="text" id="txt_plazo" name="txt_plazo" class="form-control" placeholder="Plazo" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_frecuencia_pago">Frecuencia de Pago</label>
                        <input type="text" id="txt_frecuencia_pago" name="txt_frecuencia_pago" class="form-control" placeholder="Frecuencia Pago" readonly>
                    </div>
                </div>
                
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_ciclo">Ciclo</label>
                        <input type="text" id="txt_ciclo" name="txt_ciclo" class="form-control" placeholder="Ciclo">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_monto_solicitado">Monto Solicitado</label>
                        <input type="text" id="txt_monto_solicitado" name="txt_monto_solicitado" class="form-control" placeholder="0.00" onchange="capacidadPago(); cuota();">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_capacidad_pago">Capacidad de Pago</label>
                        <input type="text" id="txt_capacidad_pago" name="txt_capacidad_pago" class="form-control" placeholder="0.00" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_cuota">Cuota</label>
                        <input type="text" id="txt_cuota" name="txt_cuota" class="form-control" placeholder="%" readonly>
                    </div>
                </div>
            </div>
           
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fsolicitud">Fecha Solicitud</label>
                        <input type="text" id="txt_fsolicitud" name="txt_fsolicitud" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" onchange="calculaFechDesemb(); calculaFechaPpago(); calculaFechaVenc();">
                        {{-- <input type="text" id="txt_fsolicitud" name="txt_fsolicitud" class="form-control" value="{{ $today->format('d/m/Y') }}"> --}}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fdesembolso">Fecha de Desembolso</label>
                        <input type="text" id="txt_fdesembolso" name="txt_fdesembolso" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fprimer_pago">Fecha de Primer Pago</label>
                        <input type="text" id="txt_fprimer_pago" name="txt_fprimer_pago" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fvencimiento">Fecha de Vencimiento</label>
                        <input type="text" id="txt_fvencimiento" name="txt_fvencimiento" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" readonly>
                    </div>
                </div>
            </div>
            <div class="float-right">
                @csrf
                <button type="button" class="btn btn-block btn-primary" onclick="calcularTablaAmortizacion()"> Calcular</button>
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
                    <tbody id="tabla">
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
<script src="{{ asset('scripts/js/solicitud.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $("#txt_nombre_cliente").on('change', function(){
        id =document.getElementById("txt_nombre_cliente").value;
        cargarDetalles(id)
    });

    function cargarDetalles(id){
    $.ajax({
        type: "get",
        url: "{{ asset('admin/solicitud/detalleClienteSolicitud') }}/" + id,
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
            $('#txt_entre_calles').val(data.cliente.entre_calles).attr('disabled', true);
            $('#txt_vialidad').val(data.cliente.tipo_vialidad).attr('disabled', true);
            $('#txt_referencia').val(data.cliente.referencia).attr('disabled', true);
        },
    })
    return false;
}

    function cargarProducto(id){
        id = document.getElementById("txt_producto").value;
        $.ajax({
            url: 'productos/' + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
               console.log(data.products);
                $('#txt_tasa').val(data.products.tasa);
                $('#txt_plazo').val(data.products.plazo);
                $('#txt_frecuencia_pago').val(data.products.frecuencia_pago);
                
            }
        });
       
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

    $('#txt_fsolicitud').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

</script>




@endpush