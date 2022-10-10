@extends('layouts.AdminLTE.index')
@section('title', 'Articulos')
@section('header', 'Articulos')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo Artículo
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.addArticulos') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_nombre_producto">Nombre del Producto</label>
                        <input type="text" id="txt_nombre_producto" name="txt_nombre_producto" class="form-control text-uppercase" placeholder="Nombre del Producto" required>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_codigo">Codigo Producto</label>
                        <input type="text" id="txt_codigo" name="txt_codigo" class="form-control " placeholder="Codigo Producto" maxlength="20">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_unidad_medida">Unidad de Medida</label>
                        <input type="text" id="txt_unidad_medida" name="txt_unidad_medida" class="form-control text-uppercase" placeholder="Unidad de Medida">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_tipo">Tipo de Producto</label>
                        <select class="form-control" id="txt_tipo" name="txt_tipo" onchange="cargarClasificacion();">
                            <option>SELECCIONA</option>
                            <option>ACTIVO</option>
                            <option>PASIVO</option>
                            <option>CAPITAL</option>
                            <option>GASTOS</option>
                            <option>INGRESOS</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_clasificacion" class="">Clasificación</label>
                        <select name="txt_clasificacion" id="txt_clasificacion" class="form-control text-uppercase" required>
                            <option value="">SELECCIONA UNA OPCIÓN</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_cuenta_p" class="">Cuenta Contable del Artículo</label>
                        <select type="select" id="txt_cuenta_p" name="txt_cuenta_p" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($cuentas as $cuenta)
                                <option {{ old('txt_cuenta_p') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
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
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_cuenta_iva" class="">Cuenta Contable del % IVA</label>
                        <select type="select" id="txt_cuenta_iva" name="txt_cuenta_iva" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($cuentas as $cuenta)
                                <option {{ old('txt_cuenta_iva') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
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
                        <label for="txt_IVA">% de IVA</label>
                        <input type="text" id="txt_IVA" name="txt_IVA" class="form-control text-uppercase" placeholder="% de IVA">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_cuenta_ret_isr" class="">Cuenta Contable del % Retención ISR</label>
                        <select type="select" id="txt_cuenta_ret_isr" name="txt_cuenta_ret_isr" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($cuentas as $cuenta)
                                <option {{ old('txt_cuenta_ret_isr') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
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
                        <label for="txt_ret_isr">% Retención ISR</label>
                        <input type="text" id="txt_ret_isr" name="txt_ret_isr" class="form-control text-uppercase" placeholder="% Retención ISR">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_cuenta_ret_iva" class="">Cuenta Contable de Retención IVA</label>
                        <select type="select" id="txt_cuenta_ret_iva" name="txt_cuenta_ret_iva" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($cuentas as $cuenta)
                                <option {{ old('txt_cuenta_ret_iva') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
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
                        <label for="txt_ret_iva">Retención IVA</label>
                        <input type="text" id="txt_ret_iva" name="txt_ret_iva" class="form-control text-uppercase" placeholder="Retención IVA">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_cuenta_deprec" class="">Cuenta Contable de % Depreciacion</label>
                        <select type="select" id="txt_cuenta_deprec" name="txt_cuenta_deprec" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($cuentas as $cuenta)
                                <option {{ old('txt_cuenta_deprec') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
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
                        <label for="txt_depreciacion">% Depreciacion</label>
                        <input type="text" id="txt_depreciacion" name="txt_depreciacion" class="form-control text-uppercase" placeholder="% Depreciacion">
                    </div>
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

    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $("#txt_cuenta_p").select2({
        theme:"bootstrap4"
    });
    $("#txt_cuenta_iva").select2({
        theme:"bootstrap4"
    });
    $("#txt_cuenta_ret_isr").select2({
        theme:"bootstrap4"
    });
    $("#txt_cuenta_ret_iva").select2({
        theme:"bootstrap4"
    });
    $("#txt_cuenta_deprec").select2({
        theme:"bootstrap4"
    });

    function cargarClasificacion(){
        id = document.getElementById("txt_tipo").value;
        $.ajax({
            url: "{{ asset('admin/articulos/clasificacion') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data);
                $('#txt_clasificacion').html('');
                let clasificaciones = data.clasificaciones;
                clasificaciones.forEach(clasificacion => {
                    $('#txt_clasificacion').append('<option value="'+clasificacion.nombre+'">'+clasificacion.nombre+'</option>');
                });
                
            }
        });
       
    }
</script>
@endpush