@extends('layouts.AdminLTE.index')

@section('title', 'Artículos')
@section('header', 'Artículos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Artículos</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.articulo.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Articulo"><li class="fas fa-plus"></li>&nbsp; Nuevo Articulo</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" autocomplete="off">
                <div class="form-group row text-right">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm text-uppercase" placeholder="Introduce nombre articulo " id="txt_name_articulo" name="txt_name_articulo" value="{{$name_articulo}}">    
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
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Unidad</th>
                        <th>Producto</th>
                        <th>Clasificación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articulos as $articulo)
                    <tr>
                        <td>#{{ $articulo->id }}</td>
                        <td> {{ $articulo->nombre_producto }}</td>
                        <td>{{ $articulo->codigo_producto }}</td>
                        <td>{{ $articulo->unidad_medida }}</td>
                        <td>{{ $articulo->tipo_producto }}</td>
                        <td>{{ $articulo->clasificacion }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.articulo.edit', [$articulo->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteArticulo', [$articulo->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $articulos->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection