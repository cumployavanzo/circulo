@extends('layouts.AdminLTE.index')

@section('title', 'Clientes')
@section('header', 'Clientes')

@section('content')
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('mensaje')}}
    </div>  
    @endif 
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Clientes</h3>
            <div class="form-group float-right">
              
                <div class="d-flex">
                    <!-- <div class="col-sm-7">
                        <form action="{{ route('admin.importClients') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row text-right">
                                <div class="col-sm-6">
                                    <input type="file" class="form-control form-control-sm text-uppercase" id="documento" name="documento">  
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file-upload btn-icon-wrapper"> </i>&nbsp; Importar</button>
                                </div>  
                            </div>  
                        </form>
                    </div>   -->
                    <div class="col-sm-12">
                        <a href="{{ route('admin.cliente.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Cliente"><li class="fas fa-plus"></li>&nbsp; Nuevo Cliente</a>
                    </div>  
                
                </div>
            </div>
        </div>
       
        <div class="card-body">
            <form class="form-horizontal" autocomplete="off">
                <div class="form-group row text-right">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm text-uppercase" placeholder="Introduce nombre a buscar " id="txt_name" name="txt_name" value="{{$name}}">    
                    </div> 
                    <div class="col-sm-2 text-left">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i>&nbsp; Buscar</button>
                    </div>
                </div>
            </form>
            <div class="form-group float-right">
                <div class="d-flex">
                    <form action="{{ route('admin.cliente.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Activo">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-success">{{$estatusActivo->count()}}</span>
                            <i class="fas fa-user-check"></i> Activos
                        </button>
                    </form>
                    <form action="{{ route('admin.cliente.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Inactivo">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-danger">{{$estatusInactivo->count()}}</span>
                            <i class="fas fa-user-times"></i> Inactivos
                        </button>
                    </form>
                </div>
            </div>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Edad</th>
                        <th>Score</th>
                        <th>Historial</th>
                        <th>Precalificación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                   
                    <tr>
                        <td>#{{ $cliente->id }}</td>
                        <td>{{ $cliente->getFullName() }}</td>
                        <td>{{ $cliente->genero }}</td>
                        <td>{{ $cliente->edad }} Años</td>
                        <td>{{ $cliente->scoreing->score }}</td>
                        <td>{{ $cliente->scoreing->historial_crediticio }}</td>
                        <td>
                            @if ($cliente->state_encuesta == 'Aceptado')
                                <span class="badge bg-success badgebtn">{{$cliente->state_encuesta}}</span>
                            @else
                                <span class="badge bg-danger badgebtn">{{$cliente->state_encuesta}}</span>
                            @endif
                        </td>
                        <td class="project-actions d-flex">
                             <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.ccCliente', ['idCliente'=>$cliente->id]) }}"><i class="fas fa-edit"></i> CC</a>

                       
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.cliente.edit', [$cliente->id]) }}"><i class="fas fa-eye"></i> Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $clientes->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.reporteClientes') }}" autocomplete="off" id="f_reporte" name="f_reporte" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Exportar Reporte de Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="limpiaForm(f_reporte)" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-10">
                        <div class="form-group">
                            <label for="txt_asociado" class="">Asociado</label>
                            <select type="select" id="txt_asociado" name="txt_asociado" class="form-control select2 " required>
                                <option value="">Selecciona</option>
                                @foreach($asociados as $asociado)
                                    <option {{ old('txt_asociado') == $asociado->id ? 'selected' : '' }} value="{{$asociado->id}}">{{$asociado->getFullname()}}</option>
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
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiaForm(f_reporte)">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Exportar</button>
                  </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
     $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });
    
    $("#txt_asociado").select2({
        theme:"bootstrap4"
    });
    
    $(".badgebtn").on('click', function(){
        id = this.getAttribute('data-id');
        var boton = $(this)
        $.ajax({
            url: "{{ asset('admin/clientes') }}/" + id,
            type: 'put',
            cache: false,
            beforeSend: function (){

            },
            success: function(data){
                console.log(data);
                if (boton.hasClass('bg-success')) {
                    boton.removeClass('bg-success').addClass('bg-danger')
                    boton.text('Inactivo')
                    boton.attr('data-original-title', 'Haz click para activar este Cliente')
                    
                }
                else if(boton.hasClass('bg-danger')) {
                    boton.removeClass('bg-danger').addClass('bg-success')
                    boton.text('Activo')
                    boton.attr('data-original-title', 'Haz click para inactivar este Cliente')
                }
            },
        })
    });
</script>
@endpush