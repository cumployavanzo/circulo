@extends('layouts.AdminLTE.index')
@section('title', 'Asignación')
@section('header', 'Asignación')
@section('content')
<div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nueva asignación
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.asignacion.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" id="idGasto" name="idGasto" value="0">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="fecha_asignacion">Fecha de Asignación:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_asignacion" name="fecha_asignacion" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                                                                      
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-6">                                               
                            <label for="Fk_proveedor">Proveedor:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck"></i></span>
                                </div>
                                <select type="select" id="Fk_proveedor" name="Fk_proveedor" class="form-control select2 " required>
                                    <option value="">Selecciona</option>
                                    @foreach($proveedores as $provedor)
                                        <option {{ old('Fk_proveedor') == $provedor->id ? 'selected' : '' }} value="{{$provedor->id}}">{{$provedor->nombre_proveedor}}</option>
                                    @endforeach
                                </select>
                                @error('userType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="col-lg-6">                                               
                            <label for="Fk_detalle_compra">Articulo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i></span>
                                </div>
                                <select type="select" id="Fk_detalle_compra" name="Fk_detalle_compra" class="form-control select2 " required onchange="detalleActivo()">
                                    <option value="">Selecciona</option>
                                    @foreach($articulos_activo as $activo)
                                        <option {{ old('Fk_detalle_compra') == $activo->id ? 'selected' : '' }} value="{{$activo->id}}">{{$activo->nombre_producto}}</option>
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
                <div class="form-group">
                    <div class="row">          
                        <div class="col-lg-4">
                            <label for="txt_num_economico">Número Economico:</label>
                            <input id="txt_num_economico" class="form-control text-uppercase" type="text" name="txt_num_economico" placeholder="Número economico" disabled>
                        </div>  
                        <div class="col-lg-4">
                            <label for="txt_placas">Placas:</label>
                            <input id="txt_placas" class="form-control text-uppercase" type="text" name="txt_placas" placeholder="Placas" disabled>
                        </div>  
                        <div class="col-lg-4">
                            <label for="txt_serie">Serie:</label>
                            <input id="txt_serie" class="form-control text-uppercase" type="text" name="txt_serie" placeholder="Serie" disabled>
                           
                        </div>   
                    </div>  
                </div>  
                <div class="form-group">
                    <div class="row">          
                        <div class="col-lg-4">
                            <label for="txt_modelo">Modelo:</label>
                            <input id="txt_modelo" class="form-control text-uppercase" type="text" name="txt_modelo" placeholder="Modelo" disabled>
                           
                        </div>  
                        <div class="col-lg-4">
                            <label for="txt_tipo_vehiculo">Tipo de Vehiculo:</label>
                            <select class="form-control" id="txt_tipo_vehiculo" name="txt_tipo_vehiculo">
                                @foreach($tipos_veh as $tipo)
                                    <option {{ old('txt_tipo_vehiculo') == $tipo->id ? 'selected' : '' }} value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                           
                        </div>  
                        <div class="col-lg-4">
                            <label for="txt_num_pasajeros">Número de Pasajeros:</label>
                            <input id="txt_num_pasajeros" class="form-control text-uppercase" type="text" name="txt_num_pasajeros" placeholder="Núm Pasajeros">

                        </div>   
                    </div>  
                </div>  
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-7">                                               
                            <label for="Fk_conductor">Conductor:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-car"></i></span>
                                </div>
                                <select type="select" id="Fk_conductor" name="Fk_conductor" class="form-control select2 " required>
                                    <option value="">Selecciona</option>
                                    @foreach($personals as $personal)
                                        <option {{ old('Fk_conductor') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
                                    @endforeach
                                </select>
                                @error('userType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="col-lg-5">                                               
                            <label for="Fk_ruta">Ruta:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map"></i></span>
                                </div>
                                <select type="select" id="Fk_ruta" name="Fk_ruta" class="form-control select2 " required>
                                    <option value="">Selecciona</option>
                                    @foreach($sucursales as $ruta)
                                        <option {{ old('Fk_ruta') == $ruta->id ? 'selected' : '' }} value="{{$ruta->id}}">{{$ruta->nombre_ruta}}</option>
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
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-8">                                               
                            <label for="Fk_propietario">Propietario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <select type="select" id="Fk_propietario" name="Fk_propietario" class="form-control select2 " required>
                                    <option value="">Selecciona</option>
                                    @foreach($personals as $personal)
                                        <option {{ old('Fk_propietario') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
                                    @endforeach
                                </select>
                                @error('userType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="col-lg-4">
                            <label for="txt_poliza">Poliza de Seguro:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                                </div>
                                <input id="txt_poliza" class="form-control text-uppercase" type="text" name="txt_poliza" placeholder="Poliza de Seguro">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="txt_state">Estatus:</label>
                        <select class="form-control" id="txt_state" name="txt_state">
                            <option>-- ELIGE UNA OPCIÓN --</option>
                            <option>Mantenimiento</option>
                            <option>Circulacion</option>
                            <option>Viaje Especial</option>
                            <option>Baja</option>
                            <option>Disponible</option>
                            <option>Siniestrada</option>
                        </select>
                    </div> 
                </div> 
            </div><!-- /.card-body -->   
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>                                    
        </form>
    
</div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    

    $("#Fk_proveedor").select2({
        theme:"bootstrap4"
    });

    $("#Fk_propietario").select2({
        theme:"bootstrap4"
    });

    $("#Fk_conductor").select2({
        theme:"bootstrap4"
    });

    $("#Fk_detalle_compra").select2({
        theme:"bootstrap4"
    });


    function detalleActivo(){
        id = document.getElementById("Fk_detalle_compra").value;
        $.ajax({
            url: 'detalleActivo/' + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                // console.log(data.detalles);
                $('#txt_num_economico').val(data.detalles.numero_economico);
                $('#txt_placas').val(data.detalles.placas);
                $('#txt_serie').val(data.detalles.numero_serie);
                $('#txt_modelo').val(data.detalles.modelo);
            }
        });
       
    }
    
</script>
@endpush