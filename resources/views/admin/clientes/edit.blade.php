@extends('layouts.AdminLTE.index')
@section('title', 'Clientes')
@section('header', 'Clientes')
@section('content')
<div class="col-md-12">
    <div class="card">
        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('mensaje')}}
            </div>  
        @endif 
        <div class="card-header">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#navCliente" data-toggle="tab">Nuevo Cliente</a></li>
            </ul>
        </div>
      
        <div class="tab-content">
            <div class="active tab-pane" id="navCliente">
                <form method="POST" action="{{action('ClienteAdminController@update', $cliente->id)}}" autocomplete="off">
                @method('PUT')	
                @csrf
                <div class="card-body">
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_nombre">Nombre</label>
                                <input type="text" id="txt_nombre" name="txt_nombre" class="form-control text-uppercase" placeholder="Nombre(s)" value="{{ $cliente->nombre}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_apellido_paterno">Apellido Paterno</label>
                                <input type="text" id="txt_apellido_paterno" name="txt_apellido_paterno" class="form-control text-uppercase" placeholder="Apellido Paterno" value="{{ $cliente->apellido_paterno}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_apellido_materno">Apellido Materno</label>
                                <input type="text" id="txt_apellido_materno" name="txt_apellido_materno" class="form-control text-uppercase" placeholder="Apellido Materno" value="{{ $cliente->apellido_materno}}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_fecha_nac">Fecha de Nacimiento</label>
                                <input type="text" id="txt_fecha_nac" name="txt_fecha_nac" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ $cliente->fecha_nacimiento}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="position-relative form-group" id="theAge">
                                <label for="txt_edad" class="">Edad</label>
                                <input name="txt_edad" id="txt_edad" type="text" value="{{ $cliente->edad}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_genero">Género</label>
                                <select class="form-control" id="txt_genero" name="txt_genero">
                                    <option {{ $cliente->genero == 'M' ? 'selected' : ''}} value="M">Masculino</option>
                                    <option {{ $cliente->genero == 'F' ? 'selected' : ''}} value="F">Femenino</option>
                                    <option {{ $cliente->genero == 'x' ? 'selected' : ''}} value="x">Indistinto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_ciudad_nacimiento">Ciudad de Nacimiento</label>
                                <input type="text" id="txt_ciudad_nacimiento" name="txt_ciudad_nacimiento" class="form-control text-uppercase" placeholder="Ciudad de Nacimiento" value="{{ $cliente->ciudad_nacimiento}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_estado_nacimiento">Estado de Nacimiento</label>
                                <select type="select" id="txt_estado_nacimiento" name="txt_estado_nacimiento" class="form-control @error('state') is-invalid @enderror" required onchange="btGenCurp(this.form, '3');">
                                    <option value="">Seleccionar</option>
                                    @foreach($estados_nac as $estado)
                                        <option {{ old('txt_estado_nacimiento') == $estado->clave ? 'selected' : ($opcionEstado != "N/A" ? ($opcionEstado == $estado->clave ? 'selected' : '')  : '') }} value="{{$estado->clave}}">{{$estado->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_nacionalidad">Nacionalidad</label>
                                <input type="text" id="txt_nacionalidad" name="txt_nacionalidad" class="form-control text-uppercase" placeholder="Nacionalidad" value="{{ $cliente->nacionalidad}}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_rfc">RFC</label>
                                <input type="text" id="txt_rfc" name="txt_rfc" class="form-control text-uppercase" placeholder="RFC" value="{{ $cliente->rfc}}" maxlength="13">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_curp">CURP</label>
                                <input type="text" id="txt_curp" name="txt_curp" class="form-control text-uppercase" placeholder="CURP" value="{{ $cliente->curp}}" maxlength="18">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_clave_elector">Clave de Elector</label>
                                <input type="text" id="txt_clave_elector" name="txt_clave_elector" class="form-control text-uppercase" placeholder="Clave de Elector" value="{{ $cliente->clave_elector}}"  maxlength="18" required onchange="validarClaveElector()">
                            </div>
                            <small id="msjValidacion" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                       
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="txt_direccion">Dirección</label>
                                <input type="text" id="txt_direccion" name="txt_direccion" class="form-control text-uppercase" placeholder="Dirección" value="{{ $cliente->direccion}}">
                            </div>
                        </div>
                       
                    </div>
                   
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="txt_referencia">Referencia</label>
                                <input type="text" id="txt_referencia" name="txt_referencia" class="form-control text-uppercase" placeholder="Referencia" value="{{ $cliente->referencia}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group" id="theCp">
                                <label for="txt_codigo_postal">Codigo Postal</label>
                                <input type="text" id="txt_codigo_postal" name="txt_codigo_postal" class="form-control" placeholder="Codigo Postal" value="{{ $cliente->cp}}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-4">
                            <div class="form-group" id="theSuburb">
                                <label for="txt_colonia">Colonia</label>
                                <select name="txt_colonia" id="txt_colonia" class="form-control text-uppercase theSuburbs">
                                    <option value="{{ $cliente->colonia }}">{{ $cliente->colonia }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group" id="theCity">
                                <label for="txt_ciudad">Ciudad</label>
                                <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control" placeholder="Ciudad" value="{{ $cliente->ciudad}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group" id="theState">
                                <label for="txt_estado">Estado</label>
                                <input type="text" id="txt_estado" name="txt_estado" class="form-control" placeholder="Estado" value="{{ $cliente->estado}}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="txt_celular">Celular</label>
                                <input type="text" id="txt_celular" name="txt_celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $cliente->celular}}">
                            </div>
                        </div>
                        
                    </div>
                   
                  
                </div>              
                <div class="card-footer">
                    <div class="col-12">
                        <a type="button" href="{{ route('admin.cliente.index') }}" class="btn btn-danger float-right">Cerrar</a>
                        <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Guardar</button>
                    </div>
                </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('scripts/js/curp.js') }}"></script>
<script>

     $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });


    $("#txt_nombre_asociado").select2({
        theme:"bootstrap4"
    });

    $("#txt_nombre_aval").select2({
        theme:"bootstrap4"
    });
    
    $("#txt_cuenta").select2({
        theme:"bootstrap4"
    });

    $("#txt_estado_nacimiento").select2({
        theme:"bootstrap4"
    });

    $('#txt_fecha_nac').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    $('#txt_fecha_alta').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $('[data-mask]').inputmask()

    $("#txt_codigo_postal").focusout(function() {
        cp = $('#txt_codigo_postal').val();
        if(cp.length == 5){
            $.ajax({
                type: "POST",
                url: "{{ url('/api/checkCp') }}",
                data: {
                    cp : cp
                },
                success:function(data){
                    $(".theSuburbs").empty().trigger('change');
                    if(data != 'Resultado no encontrado'){
                        cpError = 0;
                        $('#txt_codigo_postal').removeClass('is-invalid');
                        $('#txt_codigo_postal').addClass('is-valid');
                        $('#cpError').remove();
                        $('#txt_ciudad').val(data.Ciudad);
                        $('#txt_estado').val(data.Estado);
                        let theSuburbs = data.Asentamiento;
                        var data = {};

                        theSuburbs.forEach(function(theCurrentSuburb){
                            data.id = theCurrentSuburb;
                            data.text = theCurrentSuburb;
                            var newOption = new Option(data.text, data.id, false, false);
                            $('#txt_colonia').append(newOption).trigger('change');
                        });
                    }
                    else {
                        cpError = 1;
                        $('#txt_codigo_postal').addClass('is-invalid');
                        $('#cpError').remove();
                        $('#theCp').append('<span class="invalid-feedback" id="cpError" role="alert"><strong>No se ha encontrado ese C.P.</strong></span>');
                    }
                }
            });
        }
        else {
            $('#txt_codigo_postal').addClass('is-invalid');
            $('#cpError').remove();
            $('#theCp').append('<span class="invalid-feedback" id="cpError" role="alert"><strong>El código postal debe contener 5 números.</strong></span>');
        }
    });
    
    $(function(){
        $('#txt_fecha_nac').on('change', calcularEdad);
    });
        
    function calcularEdad(){
        var fecha=document.getElementById("txt_fecha_nac").value;
        var values=fecha.split("/");
        var dia = values[0];
        var mes = values[1];
        var ano = values[2];
        fecha=	dia+"/"+mes	+"/"+ano;
        var values=fecha.split("/");
		var dia = values[0];
        var mes = values[1];
        var ano = values[2];
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth();
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
 
        if ( ahora_mes < (mes - 1)){
            edad--;
        }
        if (((mes - 1) == ahora_mes) && (ahora_dia < dia)){
            edad--;
        }
        if (edad > 1900){
            edad -= 1900;
        }
        $('#txt_edad').val(edad);
    }

    function validarClaveElector(){
        var claveElector = document.getElementById("txt_clave_elector").value;
        $.ajax({
            type: "get",
            url: "{{ asset('admin/clientes/validarClaveElector') }}/" + claveElector,
            type: 'get',
            success: function(data){
                console.log(data);
                if(data.clientExiste){
                    $('#msjValidacion').html('<i class="fa fa-bell fa-lg faa-ring animated"></i>'+' '+' ESTE CLIENTE YA EXISTE!')
                    $("#botonera").hide('slow')
                }else{
                    $('#msjValidacion').html('')
                    $("#botonera").show('slow')
                }
               
            },
        })
        return false;
    }

    $("#txt_codigo_postal_ref").focusout(function() {
        cp = $('#txt_codigo_postal_ref').val();
        if(cp.length == 5){
            $.ajax({
                type: "POST",
                url: "{{ url('/api/checkCp') }}",
                data: {
                    cp : cp
                },
                success:function(data){
                    $(".theSuburbsRef").empty().trigger('change');
                    if(data != 'Resultado no encontrado'){
                        cpErrorRef = 0;
                        $('#txt_codigo_postal_ref').removeClass('is-invalid');
                        $('#txt_codigo_postal_ref').addClass('is-valid');
                        $('#cpErrorRef').remove();
                        $('#txt_ciudad_ref').val(data.Ciudad);
                        $('#txt_estado_ref').val(data.Estado);
                        let theSuburbsRef = data.Asentamiento;
                        var data = {};

                        theSuburbsRef.forEach(function(theCurrentSuburbRef){
                            data.id = theCurrentSuburbRef;
                            data.text = theCurrentSuburbRef;
                            var newOption = new Option(data.text, data.id, false, false);
                            $('#txt_colonia_ref').append(newOption).trigger('change');
                        });
                    }
                    else {
                        cpErrorRef = 1;
                        $('#txt_codigo_postal_ref').addClass('is-invalid');
                        $('#cpErrorRef').remove();
                        $('#theCpRef').append('<span class="invalid-feedback" id="cpErrorRef" role="alert"><strong>No se ha encontrado ese C.P.</strong></span>');
                    }
                }
            });
        }
        else {
            $('#txt_codigo_postal_ref').addClass('is-invalid');
            $('#cpErrorRef').remove();
            $('#theCpRef').append('<span class="invalid-feedback" id="cpErrorRef" role="alert"><strong>El código postal debe contener 5 números.</strong></span>');
        }
    });

    function cargarReferencia(idRef){
        $.ajax({
            url: "{{ asset('admin/clientes/datosReferencia') }}/" + idRef,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data);
                $('#idReferencia').val(data.referencia.id);
                $('#idClienteRef').val(data.referencia.clientes_id);
                $('#txt_nombre_ref').val(data.referencia.nombre);
                $('#txt_apellido_paterno_ref').val(data.referencia.apellido_paterno);
                $('#txt_apellido_materno_ref').val(data.referencia.apellido_materno);
                $('#txt_parentesco_ref').val(data.referencia.parentesco);
                $('#txt_celular_ref').val(data.referencia.telefono);
                $('#txt_tipo_ref').val(data.referencia.tipo_referencia);
                $('#txt_direccion_ref').val(data.referencia.direccion);
                $('#txt_entre_calles_ref').val(data.referencia.entre_calles);
                $('#txt_codigo_postal_ref').val(data.referencia.cp);
                $('#txt_colonia_ref').append($('<option>').val(data.referencia.colonia).text(data.referencia.colonia));
                $('#txt_ciudad_ref').val(data.referencia.ciudad);
                $('#txt_estado_ref').val(data.referencia.estado);
                $('#txt_referencia_ref').val(data.referencia.referencia);

            }
        });
    }
</script>
@endpush