@extends('layouts.AdminLTE.index')
@section('title', 'Roles')
@section('header', 'Roles')
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
                Editar Rol
            </h4>
        </div>
        <form method="POST" action="{{action('RolController@update', $rol->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                   
                    <div class="col-lg-4">
                        <label for="rol">Perfil:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="nav-icon fas fa-th"></i></span>
                            </div>
                            <input id="rol" class="form-control text-uppercase" type="text" name="rol" placeholder="Perfil" required="" value="{{$rol->nombre}}">
                        </div>
                    </div>    
                    <div class="col-lg-4">
                        <label for="estatus">Estatus:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-arrow-down"></i></span>
                            </div>
                            <select class="form-control" id="estatus" name="estatus">
                                <option>Activo</option>
                                <option>Inactivo</option>
                            </select>
                        </div>
                    </div>                                                 
                </div>
            </div>
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('error')}}
                </div>  
            @endif  
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong>NOTA:</strong> &puncsp; Selecciona los submenus a los que tendra acceso este Rol.    
                    <h3>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        @forelse ($menus as $item)
                            <div class="col-sm-5 col-md-3">
                                <div class="color-palette-set">
                                    <div class="bg-info text-center color-palette"><span class="text-bold">{{ $item->nombre_menu }} </span></div>
                                    <div class="col-sm-12">
                                        @foreach ($item->submenus as $subitem)
                                            @php
                                                $cheked="";
                                                for($i=0;$i<count($permisos);$i++) {
                                                    if($permisos[$i]==$subitem->id) {
                                                        $cheked ='checked="checked"';
                                                        break;
                                                    } else {
                                                        $cheked="";
                                                    }
                                                }
                                            @endphp
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" {{$cheked}} id="submenu_{{ $subitem->id }}" name="submenu[]" value="{{ $subitem->id }}">
                                                <label for="submenu_{{ $subitem->id }}" class="custom-control-label">
                                                    {{ $subitem->nombre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            
                        @empty
                            
                        @endforelse
                        <br>
                       
                        
                        
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
     $("#txt_saldo_minimo").maskMoney({
        decimal: ".",
        thousands: ","
    });

    $("#txt_cuenta_contable").select2({
        theme:"bootstrap4"
    });

    $("#txt_name_responsable").select2({
        theme:"bootstrap4"
    });

    function cargarPuesto(){
        idEmpleado = document.getElementById("txt_name_responsable").value;
        $.ajax({
            url: "{{ asset('admin/cajas/puestoPers') }}/" + idEmpleado,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data.personalsPuesto)
                $('#txt_puesto_responsable').val(data.personalsPuesto.puesto);
            }
        });
       
    }

</script>
@endpush