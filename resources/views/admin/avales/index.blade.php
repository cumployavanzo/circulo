@extends('layouts.AdminLTE.index')

@section('title', 'Avales')
@section('header', 'Avales')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Avales</h3>
            <div class="card-tools">
                <div class="form-group pull-right">
                    <div class="d-flex">
                        <a href="{{ route('admin.aval.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Aval"><li class="fas fa-plus"></li>&nbsp; Nuevo Aval</a>&nbsp;
                        <form action="{{ route('admin.reporteAvales') }}" method="POST">
                            @method('post')
                            @csrf
                            <button class="btn btn-sm btn-info" title="Generar Reporte" type="submit" href="#"><i class="fas fa-file-excel"></i> Reporte</button>
                        </form>
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
                    <form action="{{ route('admin.aval.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Activo">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-success">{{$estatusActivo->count()}}</span>
                            <i class="fas fa-user-check"></i> Activos
                        </button>
                    </form>
                    <form action="{{ route('admin.aval.index') }}">
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
                        <th>Fecha Nac.</th>
                        <th>Edad</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avales as $aval)
                    <tr>
                        <td>#{{ $aval->id }}</td>
                        <td>{{ $aval->getFullName() }}</td>
                        <td>{{ $aval->genero }}</td>
                        <td>{{ $aval->fecha_nacimiento }}</td>
                        <td>{{ $aval->edad }} Años</td>
                        <td>
                            @if ($aval->state == 'Activo')
                                <span data-id="{{ $aval->id }}" class="badge bg-success badgebtn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Haz click para inactivar aval">{{$aval->state}}</span>
                            @else
                                <span data-id="{{ $aval->id }}" class="badge bg-danger badgebtn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Haz click para activar aval">{{$aval->state}}</span>
                            @endif
                        </td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.aval.edit', [$aval->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            {{-- <form action="{{ route('admin.deleteCliente', [$cliente->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $avales->appends(request()->query())->links()}}</div>
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
    
    $(".badgebtn").on('click', function(){
        id = this.getAttribute('data-id');
        var boton = $(this)
        $.ajax({
            url: "{{ asset('admin/avales') }}/" + id,
            type: 'put',
            cache: false,
            beforeSend: function (){

            },
            success: function(data){
                console.log(data);
                if (boton.hasClass('bg-success')) {
                    boton.removeClass('bg-success').addClass('bg-danger')
                    boton.text('Inactivo')
                    boton.attr('data-original-title', 'Haz click para activar este Asociado')
                    
                }
                else if(boton.hasClass('bg-danger')) {
                    boton.removeClass('bg-danger').addClass('bg-success')
                    boton.text('Activo')
                    boton.attr('data-original-title', 'Haz click para inactivar este Asociado')
                }
            },
        })
    });

</script>
@endpush