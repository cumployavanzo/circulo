@extends('layouts.AdminLTE.index')
@section('title', 'Avales')
@section('header', 'Avales')
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
                Editar Aval
            </h4>
        </div>
        <form method="POST" action="{{action('AvalController@update', $aval->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nombre">Nombre</label>
                        <input type="text" id="txt_nombre" name="txt_nombre" class="form-control text-uppercase" placeholder="Nombre(s)" value="{{ $aval->nombre}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="txt_apellido_paterno" name="txt_apellido_paterno" class="form-control text-uppercase" placeholder="Apellido Paterno" value="{{ $aval->apellido_paterno}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_materno">Apellido Materno</label>
                        <input type="text" id="txt_apellido_materno" name="txt_apellido_materno" class="form-control text-uppercase" placeholder="Apellido Materno" value="{{ $aval->apellido_materno}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_fecha_nac">Fecha de Nacimiento</label>
                        <input type="text" id="txt_fecha_nac" name="txt_fecha_nac" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ $aval->fecha_nacimiento}}">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="position-relative form-group" id="theAge">
                        <label for="txt_edad" class="">Edad</label>
                        <input name="txt_edad" id="txt_edad" type="text" value="{{ $aval->edad}}" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_genero">Género</label>
                        <select class="form-control" id="txt_genero" name="txt_genero">
                            <option {{ $aval->genero == 'MASCULINO' ? 'selected' : ''}} value="MASCULINO">Masculino</option>
                            <option {{ $aval->genero == 'FEMENINO' ? 'selected' : ''}} value="FEMENINO">Femenino</option>
                            <option {{ $aval->genero == 'INDISTINTO' ? 'selected' : ''}} value="INDISTINTO">Indistinto</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_ciudad_nacimiento">Ciudad de Nacimiento</label>
                        <input type="text" id="txt_ciudad_nacimiento" name="txt_ciudad_nacimiento" class="form-control text-uppercase" placeholder="Ciudad de Nacimiento" value="{{ $aval->ciudad_nacimiento}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado_nacimiento">Estado de Nacimiento</label>
                        <select type="select" id="txt_estado_nacimiento" name="txt_estado_nacimiento" class="form-control @error('state') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            <option {{ $aval->estado == 'AGUASCALIENTES' ? 'selected' : ''}} value="AGUASCALIENTES">AGUASCALIENTES</option>
                            <option {{ $aval->estado == 'BAJA CALIFORNIA' ? 'selected' : ''}} value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                            <option {{ $aval->estado == 'BAJA CALIFORNIA SUR' ? 'selected' : ''}} value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                            <option {{ $aval->estado == 'CAMPECHE' ? 'selected' : ''}} value="CAMPECHE">CAMPECHE</option>
                            <option {{ $aval->estado == 'CHIAPAS' ? 'selected' : ''}} value="CHIAPAS">CHIAPAS</option>
                            <option {{ $aval->estado == 'CHIHUAHUA' ? 'selected' : ''}} value="CHIHUAHUA">CHIHUAHUA</option>
                            <option {{ $aval->estado == 'COAHUILA' ? 'selected' : ''}} value="COAHUILA">COAHUILA</option>
                            <option {{ $aval->estado == 'COLIMA' ? 'selected' : ''}} value="COLIMA">COLIMA</option>
                            <option {{ $aval->estado == 'DISTRITO FEDERAL' ? 'selected' : ''}} value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
                            <option {{ $aval->estado == 'DURANGO' ? 'selected' : ''}} value="DURANGO">DURANGO</option>
                            <option {{ $aval->estado == 'GUANAJUATO' ? 'selected' : ''}} value="GUANAJUATO">GUANAJUATO</option>
                            <option {{ $aval->estado == 'GUERRERO' ? 'selected' : ''}} value="GUERRERO">GUERRERO</option>
                            <option {{ $aval->estado == 'HIDALGO' ? 'selected' : ''}} value="HIDALGO">HIDALGO</option>
                            <option {{ $aval->estado == 'JALISCO' ? 'selected' : ''}} value="JALISCO">JALISCO</option>
                            <option {{ $aval->estado == 'MEXICO' ? 'selected' : ''}} value="MEXICO">MÉXICO</option>
                            <option {{ $aval->estado == 'MORELOS' ? 'selected' : ''}} value="MORELOS">MORELOS</option>
                            <option {{ $aval->estado == 'MICHOACAN' ? 'selected' : ''}} value="MICHOACAN">MICHOACAN</option>
                            <option {{ $aval->estado == 'NAYARIT' ? 'selected' : ''}} value="NAYARIT">NAYARIT</option>
                            <option {{ $aval->estado == 'NUEVO LEON' ? 'selected' : ''}} value="NUEVO LEON">NUEVO LEON</option>
                            <option {{ $aval->estado == 'OAXACA' ? 'selected' : ''}} value="OAXACA">OAXACA</option>
                            <option {{ $aval->estado == 'PUEBLA' ? 'selected' : ''}} value="PUEBLA">PUEBLA</option>
                            <option {{ $aval->estado == 'QUERETARO' ? 'selected' : ''}} value="QUERETARO">QUERETARO</option>
                            <option {{ $aval->estado == 'QUINTANA ROO' ? 'selected' : ''}} value="QUINTANA ROO">QUINTANA ROO</option>
                            <option {{ $aval->estado == 'SAN LUIS POTOSI' ? 'selected' : ''}} value="SAN LUIS POTOSI">SAN LUIS POTOSI</option>
                            <option {{ $aval->estado == 'SINALOA' ? 'selected' : ''}} value="SINALOA">SINALOA</option>
                            <option {{ $aval->estado == 'SONORA' ? 'selected' : ''}} value="SONORA">SONORA</option>
                            <option {{ $aval->estado == 'TABASCO' ? 'selected' : ''}} value="TABASCO">TABASCO</option>
                            <option {{ $aval->estado == 'TAMAULIPAS' ? 'selected' : ''}} value="TAMAULIPAS">TAMAULIPAS</option>
                            <option {{ $aval->estado == 'TLAXCALA' ? 'selected' : ''}} value="TLAXCALA">TLAXCALA</option>
                            <option {{ $aval->estado == 'VERACRUZ' ? 'selected' : ''}} value="VERACRUZ">VERACRUZ</option>
                            <option {{ $aval->estado == 'YUCATAN' ? 'selected' : ''}} value="YUCATAN">YUCATAN</option>
                            <option {{ $aval->estado == 'ZACATECAS' ? 'selected' : ''}} value="ZACATECAS">ZACATECAS</option>
                            <option {{ $aval->estado == 'EXTRANJERO' ? 'selected' : ''}} value="EXTRANJERO">EXTRANJERO</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nacionalidad">Nacionalidad</label>
                        <input type="text" id="txt_nacionalidad" name="txt_nacionalidad" class="form-control text-uppercase" placeholder="Nacionalidad" value="{{ $aval->nacionalidad}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_rfc">RFC</label>
                        <input type="text" id="txt_rfc" name="txt_rfc" class="form-control text-uppercase" placeholder="RFC" value="{{ $aval->rfc}}" maxlength="13">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_curp">CURP</label>
                        <input type="text" id="txt_curp" name="txt_curp" class="form-control text-uppercase" placeholder="CURP" value="{{ $aval->curp}}" maxlength="18">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_parentesco">Parentesco</label>
                        <select class="form-control" id="txt_parentesco" name="txt_parentesco">
                            <option>-- Elíge --</option>
                            <option {{ $aval->parentesco == 'HIJO(A)' ? 'selected' : ''}} value="HIJO(A)">HIJO(A)</option>
                            <option {{ $aval->parentesco == 'PADRE' ? 'selected' : ''}} value="PADRE">PADRE</option>
                            <option {{ $aval->parentesco == 'MADRE' ? 'selected' : ''}} value="MADRE">MADRE</option>
                            <option {{ $aval->parentesco == 'ESPOSO(A)' ? 'selected' : ''}} value="ESPOSO(A)">ESPOSO(A)</option>
                            <option {{ $aval->parentesco == 'HERMANO(A)' ? 'selected' : ''}} value="HERMANO(A)">HERMANO(A)</option>
                            <option {{ $aval->parentesco == 'ABUELO(A)' ? 'selected' : ''}} value="ABUELO(A)">ABUELO(A)</option>
                            <option {{ $aval->parentesco == 'NIETO(A)' ? 'selected' : ''}} value="NIETO(A)">NIETO(A)</option>
                            <option {{ $aval->parentesco == 'SOBRINO(A)' ? 'selected' : ''}} value="SOBRINO(A)">SOBRINO(A)</option>
                            <option {{ $aval->parentesco == 'YERNO' ? 'selected' : ''}} value="YERNO">YERNO</option>
                            <option {{ $aval->parentesco == 'NUERA' ? 'selected' : ''}} value="NUERA">NUERA</option>
                            <option {{ $aval->parentesco == 'CUÑADO(A)' ? 'selected' : ''}} value="CUÑADO(A)">CUÑADO(A)</option>
                            <option {{ $aval->parentesco == 'TIO(A)' ? 'selected' : ''}} value="TIO(A)">TIO(A)</option>
                            <option {{ $aval->parentesco == 'PRIMO(A)' ? 'selected' : ''}} value="PRIMO(A)">PRIMO(A)</option>
                            <option {{ $aval->parentesco == 'CONOCIDO(A)' ? 'selected' : ''}} value="CONOCIDO(A)">CONOCIDO(A)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_tipo_vivienda">Tipo Vivienda</label>
                        <select class="form-control" id="txt_tipo_vivienda" name="txt_tipo_vivienda">
                            <option {{ $aval->tipo_vivienda == 'PROPIA' ? 'selected' : ''}} value="PROPIA">Propia</option>
                            <option {{ $aval->tipo_vivienda == 'RENTADA' ? 'selected' : ''}} value="RENTADA">Rentada</option>
                            <option {{ $aval->tipo_vivienda == 'FAMILIAR' ? 'selected' : ''}} value="FAMILIAR">Familiar</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_direccion">Dirección</label>
                        <input type="text" id="txt_direccion" name="txt_direccion" class="form-control text-uppercase" placeholder="Dirección" value="{{ $aval->direccion}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_residencia">Años de Residencia</label>
                        <input type="text" id="txt_residencia" name="txt_residencia" class="form-control text-uppercase" placeholder="Años de Residencia" value="{{ $aval->anios_residencia}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="txt_referencia">Referencia</label>
                        <input type="text" id="txt_referencia" name="txt_referencia" class="form-control text-uppercase" placeholder="Referencia" value="{{ $aval->referencia}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theCp">
                        <label for="txt_codigo_postal">Codigo Postal</label>
                        <input type="text" id="txt_codigo_postal" name="txt_codigo_postal" class="form-control" placeholder="Codigo Postal" value="{{ $aval->cp}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group" id="theSuburb">
                        <label for="txt_colonia">Colonia</label>
                        <select name="txt_colonia" id="txt_colonia" class="form-control text-uppercase theSuburbs">
                            <option value="{{ $aval->colonia }}">{{ $aval->colonia }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theCity">
                        <label for="txt_ciudad">Ciudad</label>
                        <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control" placeholder="Ciudad" value="{{ $aval->ciudad}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group" id="theState">
                        <label for="txt_estado">Estado</label>
                        <input type="text" id="txt_estado" name="txt_estado" class="form-control" placeholder="Estado" value="{{ $aval->estado}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_celular">Celular</label>
                        <input type="text" id="txt_celular" name="txt_celular" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $aval->celular}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_fecha_alta">Fecha de Alta</label>
                        <input type="text" id="txt_fecha_alta" name="txt_fecha_alta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" value="{{ $aval->fecha_alta}}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_escolaridad">Escolaridad</label>
                        <select class="form-control" id="txt_escolaridad" name="txt_escolaridad">
                            <option {{ $aval->escolaridad == 'NINGUNA' ? 'selected' : ''}} value="NINGUNA">Ninguna</option>
                            <option {{ $aval->escolaridad == 'LEER Y ESCRIBIR' ? 'selected' : ''}} value="LEER Y ESCRIBIR">Leer y Escribir</option>
                            <option {{ $aval->escolaridad == 'PREESCOLAR' ? 'selected' : ''}} value="PREESCOLAR">Preescolar</option>
                            <option {{ $aval->escolaridad == 'PRIMARIA' ? 'selected' : ''}} value="PRIMARIA">Primaria</option>
                            <option {{ $aval->escolaridad == 'SECUNDARIA' ? 'selected' : ''}} value="SECUNDARIA">Secundaria</option>
                            <option {{ $aval->escolaridad == 'PREPARATORIA' ? 'selected' : ''}} value="SOCIO FUNDADOR">Preparatoria</option>
                            <option {{ $aval->escolaridad == 'LICENCIATURA' ? 'selected' : ''}} value="LICENCIATURA">Licenciatura</option>
                            <option {{ $aval->escolaridad == 'MAESTRIA' ? 'selected' : ''}} value="MAESTRIA">Maestria</option>
                            <option {{ $aval->escolaridad == 'DOCTORADO' ? 'selected' : ''}} value="DOCTORADO">Doctorado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_profesion">Profesión</label>
                        <input type="text" id="txt_profesion" name="txt_profesion" class="form-control text-uppercase" placeholder="Profesión" value="{{ $aval->profesion}}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_religion">Religión</label>
                        <select class="form-control" id="txt_religion" name="txt_religion">
                            <option {{ $aval->religion == 'SIN RELIGION' ? 'selected' : ''}} value="SIN RELIGION">Sin Religion</option>
                            <option {{ $aval->religion == 'CRISTIANISMO' ? 'selected' : ''}} value="CRISTIANISMO">Cristianismo</option>
                            <option {{ $aval->religion == 'BUDISMO' ? 'selected' : ''}} value="BUDISMO">Budismo</option>
                            <option {{ $aval->religion == 'HINDUISMO' ? 'selected' : ''}} value="HINDUISMO">Hinduismo</option>
                            <option {{ $aval->religion == 'TESTIGO DE JEHOVA' ? 'selected' : ''}} value="TESTIGO DE JEHOVA">Testigo de Jehova</option>
                            <option {{ $aval->religion == 'PRESBISTERIANA' ? 'selected' : ''}} value="PRESBISTERIANA">Presbiteriana</option>
                            <option {{ $aval->religion == 'CATOLICA' ? 'selected' : ''}} value="CATOLICA">Catolica</option>
                            <option {{ $aval->religion == 'PROTESTANTE' ? 'selected' : ''}} value="PROTESTANTE">Protestante</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_estado_civil">Estado Civil</label>
                        <select class="form-control" id="txt_estado_civil" name="txt_estado_civil">
                            <option {{ $aval->estado_civil == 'SOLTERO(A)' ? 'selected' : ''}} value="SOLTERO(A)">Soltera</option>
                            <option {{ $aval->estado_civil == 'CASADO(A)' ? 'selected' : ''}} value="CASADO(A)">Casada</option>
                            <option {{ $aval->estado_civil == 'UNION LIBRE' ? 'selected' : ''}} value="UNION LIBRE">Union Libre</option>
                            <option {{ $aval->estado_civil == 'DIVORCIADO(A)' ? 'selected' : ''}} value="DIVORCIADO(A)">Divorciada</option>
                            <option {{ $aval->estado_civil == 'VIUDO(A)' ? 'selected' : ''}} value="VIUDO(A)">Viuda</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_clave_elector">Clave de Elector</label>
                        <input type="text" id="txt_clave_elector" name="txt_clave_elector" class="form-control text-uppercase" placeholder="Clave de Elector" value="{{ $aval->clave_elector}}"  maxlength="18" required onchange="validarClaveElector()">
                    </div>
                    <small id="msjValidacion" class="text-danger"></small>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_vencimiento_ine">Año de vencimiento</label>
                        <input type="text" id="txt_vencimiento_ine" name="txt_vencimiento_ine" class="form-control" placeholder="aaaa" value="{{ $aval->anio_vencimiento_ine}}" maxlength="4">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_folio_ine">Folio INE</label>
                        <input type="text" id="txt_folio_ine" name="txt_folio_ine" class="form-control" placeholder="Folio INE" value="{{ $aval->folio_ine}}" maxlength="20">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_ocr">OCR</label>
                        <input type="text" id="txt_ocr" name="txt_ocr" class="form-control" placeholder="OCR" value="{{ $aval->ocr}}"  maxlength="13">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_tarjeta">N° de Tarjeta</label>
                        <input type="text" id="txt_num_tarjeta" name="txt_num_tarjeta" class="form-control" placeholder="N° de Tarjeta" value="{{ $aval->numero_tarjeta}}" maxlength="16">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_cuenta">N° de Cuenta</label>
                        <input type="text" id="txt_num_cuenta" name="txt_num_cuenta" class="form-control" placeholder="N° de Cuenta" value="{{ $aval->numero_cuenta}}" maxlength="20">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_clave_interbancaria">Clabe Interbancaria</label>
                        <input type="text" id="txt_clave_interbancaria" name="txt_clave_interbancaria" class="form-control" placeholder="Clabe Interbancaria" value="{{ $aval->clave_interbancaria}}" maxlength="18">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_banco">Banco</label>
                        <input type="text" id="txt_banco" name="txt_banco" class="form-control text-uppercase" placeholder="Banco" value="{{ $aval->banco}}">
                    </div>
                </div>
            </div>
        </div>              
        <div class="card-footer" id="botonera">
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $("#txt_nombre_asociado").select2({
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

    function validarClaveElector(){
        var claveElector = document.getElementById("txt_clave_elector").value;
        $.ajax({
            type: "get",
            url: "{{ asset('admin/aval/validarClave') }}/" + claveElector,
            type: 'get',
            success: function(data){
                console.log(data);
                if(data.clientExiste){
                    $('#msjValidacion').html('<i class="fa fa-bell fa-lg faa-ring animated"></i>'+' '+' ESTE AVAL YA EXISTE!')
                    $("#botonera").hide('slow')
                }else{
                    $('#msjValidacion').html('')
                    $("#botonera").show('slow')
                }
               
            },
        })
        return false;
    }
</script>
@endpush