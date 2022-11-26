@extends('layouts.AdminLTE.index')

@section('title', 'Productos')
@section('header', 'Productos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Productos</h3>
            <div class="card-tools pull-right">
                <div class="form-group float-right">
                    <div class="d-flex">
                        <a href="{{ route('admin.producto.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Producto"><li class="fas fa-plus"></li>&nbsp; Nuevo Producto</a>&nbsp;
                        <form action="{{ route('admin.reporteSucursales') }}" method="POST">
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
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Nombre</th>
                        <th>Frecuencia Pago</th>
                        <th>Tasa</th>
                        <th>Plazo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>#{{ $producto->id }}</td>
                        <td><a>{{ $producto->nombre }}</a> </td>
                        <td>{{ $producto->frecuencia_pago }}</td>
                        <td>{{ $producto->tasa }}</td>
                        <td>{{ $producto->plazo }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.producto.edit', [$producto->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteProducto', [$producto->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $productos->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection