@extends('layouts.AdminLTE.index')
@section('title', 'Asociados')
@section('header', 'Asociados')
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
                Editar Asociado
            </h4>
        </div>
        <form method="POST" action="{{action('AsociadoAdminController@update', $asociado->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nombre">Nombre</label>
                        <input type="text" id="txt_nombre" name="txt_nombre" class="form-control" placeholder="Nombre" value="{{ $asociado->nombre}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="txt_apellido_paterno" name="txt_apellido_paterno" class="form-control" placeholder="Apellido Paterno" value="{{ $asociado->apellido_paterno}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_materno">Apellido Materno</label>
                        <input type="text" id="txt_apellido_materno" name="txt_apellido_materno" class="form-control" placeholder="Apellido Materno" value="{{ $asociado->apellido_materno }}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_fecha_nac">Fecha de Nacimiento</label>
                        <input type="text" id="txt_fecha_nac" name="txt_fecha_nac" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ $asociado->fecha_nacimiento}}">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="position-relative form-group" id="theAge">
                        <label for="txt_edad" class="">Edad</label>
                        <input name="txt_edad" id="txt_edad" type="text" class="form-control" value="{{ $asociado->edad}}" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_genero">Género</label>
                        <select class="form-control" id="txt_genero" name="txt_genero">
                            <option {{ $asociado->genero == 'MASCULINO' ? 'selected' : ''}} value="MASCULINO">Masculino</option>
                            <option {{ $asociado->genero == 'FEMENINO' ? 'selected' : ''}} value="FEMENINO">Femenino</option>
                            <option {{ $asociado->genero == 'INDISTINTO' ? 'selected' : ''}} value="INDISTINTO">Indistinto</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_ciudad_nacimiento">Ciudad de Nacimiento</label>
                        <input type="text" id="txt_ciudad_nacimiento" name="txt_ciudad_nacimiento" class="form-control" placeholder="Ciudad de Nacimiento" value="{{ $asociado->ciudad_nacimiento}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado_nacimiento">Estado de Nacimiento</label>
                        <select type="select" id="txt_estado_nacimiento" name="txt_estado_nacimiento" class="form-control @error('state') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            <option {{ $asociado->estado == 'AGUASCALIENTES' ? 'selected' : ''}} value="AGUASCALIENTES">AGUASCALIENTES</option>
                            <option {{ $asociado->estado == 'BAJA CALIFORNIA' ? 'selected' : ''}} value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                            <option {{ $asociado->estado == 'BAJA CALIFORNIA SUR' ? 'selected' : ''}} value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                            <option {{ $asociado->estado == 'CAMPECHE' ? 'selected' : ''}} value="CAMPECHE">CAMPECHE</option>
                            <option {{ $asociado->estado == 'CHIAPAS' ? 'selected' : ''}} value="CHIAPAS">CHIAPAS</option>
                            <option {{ $asociado->estado == 'CHIHUAHUA' ? 'selected' : ''}} value="CHIHUAHUA">CHIHUAHUA</option>
                            <option {{ $asociado->estado == 'COAHUILA' ? 'selected' : ''}} value="COAHUILA">COAHUILA</option>
                            <option {{ $asociado->estado == 'COLIMA' ? 'selected' : ''}} value="COLIMA">COLIMA</option>
                            <option {{ $asociado->estado == 'DISTRITO FEDERAL' ? 'selected' : ''}} value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
                            <option {{ $asociado->estado == 'DURANGO' ? 'selected' : ''}} value="DURANGO">DURANGO</option>
                            <option {{ $asociado->estado == 'GUANAJUATO' ? 'selected' : ''}} value="GUANAJUATO">GUANAJUATO</option>
                            <option {{ $asociado->estado == 'GUERRERO' ? 'selected' : ''}} value="GUERRERO">GUERRERO</option>
                            <option {{ $asociado->estado == 'HIDALGO' ? 'selected' : ''}} value="HIDALGO">HIDALGO</option>
                            <option {{ $asociado->estado == 'JALISCO' ? 'selected' : ''}} value="JALISCO">JALISCO</option>
                            <option {{ $asociado->estado == 'MEXICO' ? 'selected' : ''}} value="MEXICO">MÉXICO</option>
                            <option {{ $asociado->estado == 'MORELOS' ? 'selected' : ''}} value="MORELOS">MORELOS</option>
                            <option {{ $asociado->estado == 'MICHOACAN' ? 'selected' : ''}} value="MICHOACAN">MICHOACAN</option>
                            <option {{ $asociado->estado == 'NAYARIT' ? 'selected' : ''}} value="NAYARIT">NAYARIT</option>
                            <option {{ $asociado->estado == 'NUEVO LEON' ? 'selected' : ''}} value="NUEVO LEON">NUEVO LEON</option>
                            <option {{ $asociado->estado == 'OAXACA' ? 'selected' : ''}} value="OAXACA">OAXACA</option>
                            <option {{ $asociado->estado == 'PUEBLA' ? 'selected' : ''}} value="PUEBLA">PUEBLA</option>
                            <option {{ $asociado->estado == 'QUERETARO' ? 'selected' : ''}} value="QUERETARO">QUERETARO</option>
                            <option {{ $asociado->estado == 'QUINTANA ROO' ? 'selected' : ''}} value="QUINTANA ROO">QUINTANA ROO</option>
                            <option {{ $asociado->estado == 'SAN LUIS POTOSI' ? 'selected' : ''}} value="SAN LUIS POTOSI">SAN LUIS POTOSI</option>
                            <option {{ $asociado->estado == 'SINALOA' ? 'selected' : ''}} value="SINALOA">SINALOA</option>
                            <option {{ $asociado->estado == 'SONORA' ? 'selected' : ''}} value="SONORA">SONORA</option>
                            <option {{ $asociado->estado == 'TABASCO' ? 'selected' : ''}} value="TABASCO">TABASCO</option>
                            <option {{ $asociado->estado == 'TAMAULIPAS' ? 'selected' : ''}} value="TAMAULIPAS">TAMAULIPAS</option>
                            <option {{ $asociado->estado == 'TLAXCALA' ? 'selected' : ''}} value="TLAXCALA">TLAXCALA</option>
                            <option {{ $asociado->estado == 'VERACRUZ' ? 'selected' : ''}} value="VERACRUZ">VERACRUZ</option>
                            <option {{ $asociado->estado == 'YUCATAN' ? 'selected' : ''}} value="YUCATAN">YUCATAN</option>
                            <option {{ $asociado->estado == 'ZACATECAS' ? 'selected' : ''}} value="ZACATECAS">ZACATECAS</option>
                            <option {{ $asociado->estado == 'EXTRANJERO' ? 'selected' : ''}} value="EXTRANJERO">EXTRANJERO</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nacionalidad">Nacionalidad</label>
                        <input type="text" id="txt_nacionalidad" name="txt_nacionalidad" class="form-control text-uppercase" placeholder="Nacionalidad" value="{{ $asociado->nacionalidad}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_rfc">RFC</label>
                        <input type="text" id="txt_rfc" name="txt_rfc" class="form-control" placeholder="RFC" value="{{ $asociado->rfc}}" maxlength="13">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_curp">CURP</label>
                        <input type="text" id="txt_curp" name="txt_curp" class="form-control" placeholder="CURP" value="{{ $asociado->curp}}" maxlength="18">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_tipo_vivienda">Tipo Vivienda</label>
                        <select class="form-control" id="txt_tipo_vivienda" name="txt_tipo_vivienda">
                            <option {{ $asociado->tipo_vivienda == 'PROPIA' ? 'selected' : ''}} value="PROPIA">Propia</option>
                            <option {{ $asociado->tipo_vivienda == 'RENTADA' ? 'selected' : ''}} value="RENTADA">Rentada</option>
                            <option {{ $asociado->tipo_vivienda == 'FAMILIAR' ? 'selected' : ''}} value="FAMILIAR">Familiar</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_direccion">Dirección</label>
                        <input type="text" id="txt_direccion" name="txt_direccion" class="form-control" placeholder="Dirección" value="{{ $asociado->direccion}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_residencia">Años de Residencia</label>
                        <input type="text" id="txt_residencia" name="txt_residencia" class="form-control text-uppercase" placeholder="Años de Residencia" value="{{ $asociado->anios_residencia}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="txt_referencia">Referencia</label>
                        <input type="text" id="txt_referencia" name="txt_referencia" class="form-control text-uppercase" placeholder="Referencia" value="{{ $asociado->referencia}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theCp">
                        <label for="txt_codigo_postal">Codigo Postal</label>
                        <input type="text" id="txt_codigo_postal" name="txt_codigo_postal" class="form-control" placeholder="Codigo Postal" value="{{ $asociado->cp}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group" id="theSuburb">
                        <label for="txt_colonia">Colonia</label>
                        <select name="txt_colonia" id="txt_colonia" class="form-control text-uppercase theSuburbs">
                            <option value="{{ $asociado->colonia }}">{{ $asociado->colonia }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theCity">
                        <label for="txt_ciudad">Ciudad</label>
                        <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control" placeholder="Ciudad" value="{{ $asociado->ciudad}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theState">
                        <label for="txt_estado">Estado</label>
                        <input type="text" id="txt_estado" name="txt_estado" class="form-control" placeholder="Estado" value="{{ $asociado->estado}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_celular">Celular</label>
                        <input type="text" id="txt_celular" name="txt_celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $asociado->celular}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_puesto" class="">Puesto</label>
                        <select type="select" id="txt_puesto" name="txt_puesto" class="form-control select2 " required>
                            <option value="">Seleccionar</option>
                            @foreach($puestos as $puesto)
                                <option {{ old('txt_puesto') == $puesto->id ? 'selected' : ($namePuesto != "N/A" ? ($namePuesto == $puesto->id ? 'selected' : '')  : '') }} value="{{$puesto->id}}">{{$puesto->puesto}}</option>
                            @endforeach
                        </select>
                        @error('userType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fecha_alta">Fecha de Alta</label>
                        <input type="text" id="txt_fecha_alta" name="txt_fecha_alta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ $asociado->fecha_alta}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_escolaridad">Escolaridad</label>
                        <select class="form-control" id="txt_escolaridad" name="txt_escolaridad">
                            <option {{ $asociado->escolaridad == 'NINGUNA' ? 'selected' : ''}} value="NINGUNA">Ninguna</option>
                            <option {{ $asociado->escolaridad == 'LEER Y ESCRIBIR' ? 'selected' : ''}} value="LEER Y ESCRIBIR">Leer y Escribir</option>
                            <option {{ $asociado->escolaridad == 'PREESCOLAR' ? 'selected' : ''}} value="PREESCOLAR">Preescolar</option>
                            <option {{ $asociado->escolaridad == 'PRIMARIA' ? 'selected' : ''}} value="PRIMARIA">Primaria</option>
                            <option {{ $asociado->escolaridad == 'SECUNDARIA' ? 'selected' : ''}} value="SECUNDARIA">Secundaria</option>
                            <option {{ $asociado->escolaridad == 'PREPARATORIA' ? 'selected' : ''}} value="SOCIO FUNDADOR">Preparatoria</option>
                            <option {{ $asociado->escolaridad == 'LICENCIATURA' ? 'selected' : ''}} value="LICENCIATURA">Licenciatura</option>
                            <option {{ $asociado->escolaridad == 'MAESTRIA' ? 'selected' : ''}} value="MAESTRIA">Maestria</option>
                            <option {{ $asociado->escolaridad == 'DOCTORADO' ? 'selected' : ''}} value="DOCTORADO">Doctorado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_profesion">Profesión</label>
                        <input type="text" id="txt_profesion" name="txt_profesion" class="form-control" placeholder="Profesión" value="{{ $asociado->profesion}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_religion">Religión</label>
                        <select class="form-control" id="txt_religion" name="txt_religion">
                            <option {{ $asociado->religion == 'SIN RELIGION' ? 'selected' : ''}} value="SIN RELIGION">Sin Religion</option>
                            <option {{ $asociado->religion == 'CRISTIANISMO' ? 'selected' : ''}} value="CRISTIANISMO">Cristianismo</option>
                            <option {{ $asociado->religion == 'BUDISMO' ? 'selected' : ''}} value="BUDISMO">Budismo</option>
                            <option {{ $asociado->religion == 'HINDUISMO' ? 'selected' : ''}} value="HINDUISMO">Hinduismo</option>
                            <option {{ $asociado->religion == 'TESTIGO DE JEHOVA' ? 'selected' : ''}} value="TESTIGO DE JEHOVA">Testigo de Jehova</option>
                            <option {{ $asociado->religion == 'PRESBISTERIANA' ? 'selected' : ''}} value="PRESBISTERIANA">Presbiteriana</option>
                            <option {{ $asociado->religion == 'CATOLICA' ? 'selected' : ''}} value="CATOLICA">Catolica</option>
                            <option {{ $asociado->religion == 'PROTESTANTE' ? 'selected' : ''}} value="PROTESTANTE">Protestante</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado_civil">Estado Civil</label>
                        <select class="form-control" id="txt_estado_civil" name="txt_estado_civil">
                            <option {{ $asociado->estado_civil == 'SOLTERO(A)' ? 'selected' : ''}} value="SOLTERO(A)">Soltera</option>
                            <option {{ $asociado->estado_civil == 'CASADO(A)' ? 'selected' : ''}} value="CASADO(A)">Casada</option>
                            <option {{ $asociado->estado_civil == 'UNION LIBRE' ? 'selected' : ''}} value="UNION LIBRE">Union Libre</option>
                            <option {{ $asociado->estado_civil == 'DIVORCIADO(A)' ? 'selected' : ''}} value="DIVORCIADO(A)">Divorciada</option>
                            <option {{ $asociado->estado_civil == 'VIUDO(A)' ? 'selected' : ''}} value="VIUDO(A)">Viuda</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_clave_elector">Clave de Elector</label>
                        <input type="text" id="txt_clave_elector" name="txt_clave_elector" class="form-control" placeholder="Clave de Elector" value="{{ $asociado->clave_elector}}" maxlength="18">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_vencimiento_ine">Año de vencimiento</label>
                        <input type="text" id="txt_vencimiento_ine" name="txt_vencimiento_ine" class="form-control" placeholder="aaaa" value="{{ $asociado->anio_vencimiento_ine}}" maxlength="4">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_folio_ine">Folio INE</label>
                        <input type="text" id="txt_folio_ine" name="txt_folio_ine" class="form-control" placeholder="Folio INE" value="{{ $asociado->folio_ine}}" maxlength="20">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_ocr">OCR</label>
                        <input type="text" id="txt_ocr" name="txt_ocr" class="form-control" placeholder="OCR" value="{{ $asociado->ocr}}" maxlength="13">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_tarjeta">N° de Tarjeta</label>
                        <input type="text" id="txt_num_tarjeta" name="txt_num_tarjeta" class="form-control" placeholder="N° de Tarjeta" value="{{ $asociado->numero_tarjeta}}" maxlength="16">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_cuenta">N° de Cuenta</label>
                        <input type="text" id="txt_num_cuenta" name="txt_num_cuenta" class="form-control" placeholder="N° de Cuenta" value="{{ $asociado->numero_cuenta}}" maxlength="20">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_clave_interbancaria">Clabe Interbancaria</label>
                        <input type="text" id="txt_clave_interbancaria" name="txt_clave_interbancaria" class="form-control" placeholder="Clabe Interbancaria" value="{{ $asociado->clave_interbancaria}}" maxlength="18">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_banco">Banco</label>
                        <input type="text" id="txt_banco" name="txt_banco" class="form-control" placeholder="Banco" value="{{ $asociado->banco}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_min_cliente">Mínimo de Clientes</label>
                        <input type="text" id="txt_min_cliente" name="txt_min_cliente" class="form-control" placeholder="Mínimo de clientes" value="{{ $asociado->minimo_clientes}}" maxlength="10">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_max_cliente">Máximo de Clientes</label>
                        <input type="text" id="txt_max_cliente" name="txt_max_cliente" class="form-control" placeholder="Máximo de clientes" value="{{ $asociado->maximo_clientes}}" maxlength="10">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_operador" class="">Operador</label>
                        <select type="select" id="txt_operador" name="txt_operador" class="form-control select2 " required>
                            <option value="">Seleccionar</option>
                            @foreach($operadores as $operador)
                                <option {{ old('txt_operador') == $operador->id ? 'selected' : ($personOperador != "N/A" ? ($personOperador == $operador->id ? 'selected' : '')  : '') }} value="{{$operador->id}}">{{$operador->getFullname()}}</option>
                            @endforeach
                        </select>
                        @error('userType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_ruta" class="">Ruta</label>
                        <select type="select" id="txt_ruta" name="txt_ruta" class="form-control select2 " required>
                            <option value="">Seleccionar</option>
                            @foreach($rutas as $ruta)
                                <option {{ old('txt_ruta') == $ruta->id ? 'selected' : ($nameRuta != "N/A" ? ($nameRuta == $ruta->id ? 'selected' : '')  : '') }} value="{{$ruta->id}}">{{$ruta->nombre_ruta}}</option>
                            @endforeach
                        </select>
                        @error('userType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>              
        <div class="card-footer">
            <div class="col-12">
                <a type="button" href="{{ route('admin.asociado.index') }}" class="btn btn-danger float-right">Cerrar</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Guardar</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
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

    $("#txt_operador").select2({
        theme:"bootstrap4"
        
    });

    $("#txt_ruta").select2({
        theme:"bootstrap4"  
    });
    
    $('#txt_fecha_nac').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    $('#txt_fecha_alta').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

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

</script>
@endpush