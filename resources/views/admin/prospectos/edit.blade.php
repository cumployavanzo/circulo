@extends('layouts.AdminLTE.index')
@section('title', 'Prospectos')
@section('header', 'Prospectos')
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
                Editar Prospecto
            </h4>
        </div>
        <form method="POST" action="{{action('ProspectoController@update', $prospecto->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nombre">Nombre</label>
                        <input type="text" id="txt_nombre" name="txt_nombre" class="form-control text-uppercase" placeholder="Nombre(s)" value="{{$prospecto->nombre}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="txt_apellido_paterno" name="txt_apellido_paterno" class="form-control text-uppercase" placeholder="Apellido Paterno" value="{{$prospecto->apellido_paterno}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_materno">Apellido Materno</label>
                        <input type="text" id="txt_apellido_materno" name="txt_apellido_materno" class="form-control text-uppercase" placeholder="Apellido Materno" value="{{$prospecto->apellido_materno}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fecha_nac">Fecha de Nacimiento</label>
                        <input type="text" id="txt_fecha_nac" name="txt_fecha_nac" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{$prospecto->fecha_nacimiento}}">

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="position-relative form-group" id="theAge">
                        <label for="txt_edad" class="">Edad</label>
                        <input name="txt_edad" id="txt_edad" type="text" class="form-control" value="{{ $prospecto->edad}}" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_genero">Género</label>
                        <select class="form-control" id="txt_genero" name="txt_genero">
                            <option {{ $prospecto->genero == 'M' ? 'selected' : ''}} value="M">Masculino</option>
                            <option {{ $prospecto->genero == 'F' ? 'selected' : ''}} value="F">Femenino</option>
                            <option {{ $prospecto->genero == 'x' ? 'selected' : ''}} value="x">Indistinto</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado_nacimiento">Estado de Nacimiento</label>
                        <select type="select" id="txt_estado_nacimiento" name="txt_estado_nacimiento" class="form-control @error('state') is-invalid @enderror" required onchange="btGenCurp(this.form, '3');">
                            <option value="">Seleccionar</option>
                            @foreach($estados_nac as $estado)
                                <option {{ old('txt_estado') == $estado->clave ? 'selected' : ($opcionEstado != "N/A" ? ($opcionEstado == $estado->clave ? 'selected' : '')  : '') }} value="{{$estado->clave}}">{{$estado->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_curp">CURP</label>
                        <input type="text" id="txt_curp" name="txt_curp" class="form-control text-uppercase" placeholder="CURP" maxlength="18" value="{{ $prospecto->curp}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_celular">Telefono</label>
                        <input type="text" id="txt_celular" name="txt_celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $prospecto->telefono}}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_vialidad">Vialidad</label>
                        <select class="form-control" id="txt_vialidad" name="txt_vialidad">
                            <option {{ $prospecto->tipo_vialidad == 'Ampliacion' ? 'selected' : ''}} value="Ampliacion">Ampliación</option>
                            <option {{ $prospecto->tipo_vialidad == 'Andador' ? 'selected' : ''}} value="Andador">Andador</option>
                            <option {{ $prospecto->tipo_vialidad == 'Avenida' ? 'selected' : ''}} value="Avenida">Avenida</option>
                            <option {{ $prospecto->tipo_vialidad == 'Boulevard' ? 'selected' : ''}} value="Boulevard">Boulevard</option>
                            <option {{ $prospecto->tipo_vialidad == 'Calle' ? 'selected' : ''}} value="Calle">Calle</option>
                            <option {{ $prospecto->tipo_vialidad == 'Callejon' ? 'selected' : ''}} value="Callejon">Callejon</option>
                            <option {{ $prospecto->tipo_vialidad == 'Calzada' ? 'selected' : ''}} value="Calzada">Calzada</option>
                            <option {{ $prospecto->tipo_vialidad == 'Cerrada' ? 'selected' : ''}} value="Cerrada">Cerrada</option>
                            <option {{ $prospecto->tipo_vialidad == 'Circuito' ? 'selected' : ''}} value="Circuito">Circuito</option>
                            <option {{ $prospecto->tipo_vialidad == 'Circumbalacion' ? 'selected' : ''}} value="Circumbalacion">Circumbalación</option>
                            <option {{ $prospecto->tipo_vialidad == 'Continuacion' ? 'selected' : ''}} value="Continuacion">Continuación</option>
                            <option {{ $prospecto->tipo_vialidad == 'Corredor' ? 'selected' : ''}} value="Corredor">Corredor</option>
                            <option {{ $prospecto->tipo_vialidad == 'Diagonol' ? 'selected' : ''}} value="Diagonol">Diagonol</option>
                            <option {{ $prospecto->tipo_vialidad == 'Eje Vial' ? 'selected' : ''}} value="Eje Vial">Eje Vial</option>
                            <option {{ $prospecto->tipo_vialidad == 'Pasaje' ? 'selected' : ''}} value="Pasaje">Pasaje</option>
                            <option {{ $prospecto->tipo_vialidad == 'Peatonal' ? 'selected' : ''}} value="Peatonal">Peatonal</option>
                            <option {{ $prospecto->tipo_vialidad == 'Periferico' ? 'selected' : ''}} value="Periferico">Periferico</option>
                            <option {{ $prospecto->tipo_vialidad == 'Privada' ? 'selected' : ''}} value="Privada">Privada</option>
                            <option {{ $prospecto->tipo_vialidad == 'Prolongacion' ? 'selected' : ''}} value="Prolongacion">Prolongación</option>
                            <option {{ $prospecto->tipo_vialidad == 'Retorno' ? 'selected' : ''}} value="Retorno">Retorno</option>
                            <option {{ $prospecto->tipo_vialidad == 'Viaducto' ? 'selected' : ''}} value="Viaducto">Viaducto</option>
                        </select>
                    </div>
                </div>
            </div>
           
            <div class="d-flex justify-content-start">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_direccion">Dirección</label>
                        <input type="text" id="txt_direccion" name="txt_direccion" class="form-control text-uppercase" placeholder="Dirección" value="{{ $prospecto->direccion}}">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_entre_calles">Entre calles</label>
                        <input type="text" id="txt_entre_calles" name="txt_entre_calles" class="form-control text-uppercase" placeholder="Entre calles" value="{{ $prospecto->entre_calles}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="txt_referencia">Referencias</label>
                        <input type="text" id="txt_referencia" name="txt_referencia" class="form-control text-uppercase" placeholder="Referencias"  value="{{ $prospecto->referencia}}">
                    </div>
                </div>
            </div>
           
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group" id="theCp">
                        <label for="txt_codigo_postal">Codigo Postal</label>
                        <input type="text" id="txt_codigo_postal" name="txt_codigo_postal" class="form-control" placeholder="Codigo Postal" value="{{ $prospecto->cp}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group" id="theSuburb">
                        <label for="txt_colonia">Colonia</label>
                        <select name="txt_colonia" id="txt_colonia" class="form-control text-uppercase theSuburbs">
                            <option value="{{ $prospecto->colonia }}">{{ $prospecto->colonia }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group" id="theCity">
                        <label for="txt_ciudad">Ciudad</label>
                        <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control" placeholder="Ciudad"  value="{{ $prospecto->ciudad}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group" id="theState">
                        <label for="txt_estado">Estado</label>
                        <input type="text" id="txt_estado" name="txt_estado" class="form-control" placeholder="Estado"  value="{{ $prospecto->estado}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_ruta" class="">Ruta</label>
                        <select type="select" id="txt_ruta" name="txt_ruta" class="form-control select2 " required>
                            <option value="">Seleccionar</option>
                            @foreach($rutas as $ruta)
                                <option {{ old('txt_ruta') == $ruta->id ? 'selected' : ($nameRuta != "N/A" ? ($nameRuta == $ruta->id ? 'selected' : '')  : '') }} value="{{$ruta->id}}">{{$ruta->nombre_ruta}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>              
        <div class="card-footer">
            <div class="col-12">
                <a type="button" href="javascript:history.back()" class="btn btn-danger float-right">Cerrar</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Guardar</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('scripts/js/curp.js') }}"></script>
<script>
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

    $('[data-mask]').inputmask()

    
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

    $('#txt_fecha_nac').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $("#txt_estado_nacimiento").select2({
        theme:"bootstrap4"
    });

    $("#txt_ruta").select2({
        theme:"bootstrap4"
    });
    
</script>
@endpush