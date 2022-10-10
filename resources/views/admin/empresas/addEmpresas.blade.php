@extends('layouts.AdminLTE.index')
@section('title', 'Empresas')
@section('header', 'Empresas')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nueva Empresa
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.empresa.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-start">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio de Operaciones</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="txt_clave">Clave</label>
                            <input type="text" id="txt_clave" name="txt_clave" class="form-control text-uppercase" placeholder="Clave" maxlength="30">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="txt_nombre">Nombre Comercial</label>
                            <input type="text" id="txt_nombre" name="txt_nombre" class="form-control text-uppercase" placeholder="Nombre comercial" >
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="txt_razon_social">Denominación o Razón social</label>
                            <input type="text" id="txt_razon_social" name="txt_razon_social" class="form-control text-uppercase" placeholder="Denominación o Razon social" >
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="txt_rfc">RFC</label>
                            <input type="text" id="txt_rfc" name="txt_rfc" class="form-control text-uppercase" placeholder="RFC">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="txt_regimen">Régimen de Capital</label>
                            <input type="text" id="txt_regimen" name="txt_regimen" class="form-control text-uppercase" placeholder="Régimen">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="txt_registro_patronal">Registro Patronal</label>
                            <input type="text" id="txt_registro_patronal" name="txt_registro_patronal" class="form-control text-uppercase" placeholder="Registro Patronal">
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_direccion">Dirección</label>
                        <textarea class="form-control text-uppercase" id="txt_direccion" name="txt_direccion" placeholder="Dirección" maxlength="200"></textarea>
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
                        <div class="form-group" id="theSuburb">
                            <label for="txt_colonia">Colonia</label>
                            <select name="txt_colonia" id="txt_colonia" class="form-control text-uppercase theSuburbs" required>
                                <option value=""> - </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group" id="theCity">
                            <label for="txt_ciudad">Ciudad</label>
                            <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control" placeholder="Ciudad">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group" id="theState">
                            <label for="txt_estado">Estado</label>
                            <input type="text" id="txt_estado" name="txt_estado" class="form-control" placeholder="Estado">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txt_tel" class="">Teléfono</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="txt_tel" name="txt_tel" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="txt_email" class="">E-mail</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" id="txt_email" name="txt_email" class="form-control text-uppercase" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_representante" class="">Representante Legal</label>
                        <select type="select" id="txt_representante" name="txt_representante" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($empleados as $empleado)
                                <option {{ old('txt_representante') == $empleado->id ? 'selected' : '' }} value="{{$empleado->id}}">{{$empleado->getFullname()}}</option>
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
                    <div class="custom-file">
                        <input type="file" name="file_pdf" id="file_pdf" class="custom-file-input" accept="application/pdf">
                        <label for="file_pdf" class="custom-file-label">Subir  PDF</label>
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

    $("#txt_representante").select2({
        theme:"bootstrap4"
        
    });
</script>
@endpush