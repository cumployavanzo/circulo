@extends('layouts.AdminLTE.index')

@section('title', 'Sucursal')
@section('header', 'Sucursal')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Sucursal</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.sucursal_ruta.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Caja"><li class="fas fa-plus"></li>&nbsp; Nueva Sucursal</a>
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
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sucursal ó Ruta</th>
                        <th>N° Sucursal ó Ruta</th>
                        <th>Ciudad</th>
                        <th>Teléfono</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sucursales as $sucursal)
                    <tr>
                        <td>#{{ $sucursal->id }}</td>
                        <td>{{ $sucursal->nombre_ruta }}</td>
                        <td> {{ $sucursal->numero_ruta }}</td>
                        <td> {{ $sucursal->ciudad }}</td>
                        <td>{{ $sucursal->telefono }}</td>
                        <td>
                            @if ($sucursal->state == 'Activo')
                                <span data-id="{{ $sucursal->id }}" class="badge bg-success badgebtn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Haz click para inactivar este Usuario">{{$sucursal->state}}</span>
                            @else
                                <span data-id="{{ $sucursal->id }}" class="badge bg-danger badgebtn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Haz click para activar este Usuario">{{$sucursal->state}}</span>
                            @endif
                        </td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.sucursal_ruta.edit', [$sucursal->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $sucursales->appends(request()->query())->links()}}</div>
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
            url: "{{ asset('admin/sucursales') }}/" + id,
            type: 'put',
            cache: false,
            beforeSend: function (){

            },
            success: function(data){
                if (boton.hasClass('bg-success')) {
                    boton.removeClass('bg-success').addClass('bg-danger')
                    boton.text('Inactivo')
                    boton.attr('data-original-title', 'Haz click para activar esta sucursal')
                    
                }
                else if(boton.hasClass('bg-danger')) {
                    boton.removeClass('bg-danger').addClass('bg-success')
                    boton.text('Activo')
                    boton.attr('data-original-title', 'Haz click para inactivar esta sucursal')
                }
            },
        })
    });

</script>
@endpush