@extends('layouts.AdminLTE.index')
@section('title', 'Solicitud')
@section('header', 'Solicitud')
@section('content')
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <h4 class="card-title">
                Nueva Solicitud
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.colocacion.store') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <input type="hidden" id="idCliente" name="idCliente">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_curp">CURP</label>
                        <input type="text" id="txt_curp" name="txt_curp" class="form-control text-uppercase" placeholder="CURP" maxlength="18" onchange="cargarDatosCliente()">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_clave_elector">Clave de Elector</label>
                        <input type="text" id="txt_clave_elector" name="txt_clave_elector" class="form-control text-uppercase" placeholder="Clave de Elector" required maxlength="18">
                    </div>
                    <small id="msjValidacion" class="text-danger"></small>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nombre">Nombre</label>
                        <input type="text" id="txt_nombre" name="txt_nombre" class="form-control text-uppercase" placeholder="Nombre(s)">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="txt_apellido_paterno" name="txt_apellido_paterno" class="form-control text-uppercase" placeholder="Apellido Paterno">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_apellido_materno">Apellido Materno</label>
                        <input type="text" id="txt_apellido_materno" name="txt_apellido_materno" class="form-control text-uppercase" placeholder="Apellido Materno">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_nombre_promotor" class="">Nombre del Promotor</label>
                        <select type="select" id="txt_nombre_promotor" name="txt_nombre_promotor" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($personal as $person)
                                <option {{ old('txt_nombre_promotor') == $person->id ? 'selected' : '' }} value="{{$person->id}}">{{$person->getFullname()}}</option>
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_producto">Producto</label>
                        <select type="select" id="txt_producto" name="txt_producto" class="form-control @error('state') is-invalid @enderror" required onchange="cargarPeriodo()">
                            <option value="">Selecciona</option>
                            @foreach($productoSeg as $prod)
                                <option {{ old('txt_producto') == $prod->id ? 'selected' : '' }} value="{{$prod->id}}">{{$prod->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_periodo" class="">Periodo</label>
                        <select type="select" id="txt_periodo" name="txt_periodo" class="form-control select2 " required onchange="cargarMontos()">
                            <option value="">Selecciona</option>
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_montos">Monto Asegurado</label>
                        <select type="select" id="txt_montos" name="txt_montos" class="form-control @error('state') is-invalid @enderror" required onchange="cargarPrecio()">
                            <option value="">Selecciona</option>
                            @foreach($productoSeg as $prod)
                                <option {{ old('txt_montos') == $prod->id ? 'selected' : '' }} value="{{$prod->id}}">{{$prod->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_precio">Precio</label>
                        <input type="text" id="txt_precio" name="txt_precio" class="form-control text-uppercase" placeholder="Precio">

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
@endsection
@push('scripts')
<script>

    $("#txt_producto").select2({
        theme:"bootstrap4"
    });

    $("#txt_nombre_promotor").select2({
        theme:"bootstrap4"
    });
 
    function cargarDatosCliente(){
        let curp = document.getElementById("txt_curp").value;
      
        $.ajax({
            type: "get",
            url: "{{ asset('admin/colocacion/detalleClienteSeg') }}/" + curp,
            type: 'get',
            success: function(data){
                console.log(data);
                $('#idCliente').val(data.cliente['id']);
                $('#txt_nombre').val(data.cliente['nombre']);
                $('#txt_apellido_paterno').val(data.cliente['apellido_paterno']);
                $('#txt_apellido_materno').val(data.cliente['apellido_materno']);
                $('#txt_clave_elector').val(data.cliente['clave_elector']);
                
            },
        })
        return false;
    }

    function cargarPeriodo(){
        let idProducto = document.getElementById("txt_producto").value;
        $.ajax({
            url: "{{ asset('admin/colocacion/periodoSeg') }}/" + idProducto,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                let selectPeriodos = '<option value="">-- Selecciona --</option>';
                data.periodos.forEach(fila =>  {
                    selectPeriodos += '<option value="'+fila.id+'">'+fila.descripcion+'</option>';
                })
                $("#txt_periodo").html(selectPeriodos);
            }
        });
    }


    function cargarMontos(){
        let idProducto = document.getElementById("txt_producto").value;
        let idPeriodo = document.getElementById("txt_periodo").value;
        csrfc = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            type: 'POST',
            url: '/admin/colocacion/verMontosProducto',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            data: {
                _token: csrfc,
                idProducto : idProducto,
                idPeriodo : idPeriodo,
            },
        
            success: function(data){
               console.log(data);
               let selectMontos = '<option value="">-- Selecciona --</option>';
                data.montos.forEach(fila =>  {
                    selectMontos += '<option value="'+fila.id_primasuma+'">'+fila.suma_asegurada+'</option>';
                })
                $("#txt_montos").html(selectMontos); 

            }
        });
       
    }



    function cargarPrecio(){

        let idPrimaSuma = document.getElementById("txt_montos").value;
        $.ajax({
            url: "{{ asset('admin/colocacion/montoSumaAseg') }}/" + idPrimaSuma,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data.precios);
                $('#txt_precio').html('')
                $('#txt_precio').val(data.precios);
            }
        });

    }


</script>
@endpush