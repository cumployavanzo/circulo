@extends('layouts.AdminLTE.index')

@section('title', 'Asignaciones')
@section('header', 'Asignaciones')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Asignaciones</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.asignacion.create') }}"  type="button" class="btn btn-sm btn-primary" title="Nueva asignacion"><li class="fas fa-plus"></li>&nbsp; Nueva Asignación</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
                        <th>Fecha Asignación</th>
                        <th>Ruta</th>
                        <th>Articulo</th>
                        <th>Tipo</th>
                        <th>Conductor</th>
                        <th>Propietario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asignaciones as $asignacion)
                    <tr>
                        <td>#{{ $asignacion->id }}</td>
                        <td>{{ date('d/m/Y', strtotime($asignacion->fecha_asignacion))}}</td>
                        <td>{{ $asignacion->movimientos->ruta->nombre_ruta}}</td>
                        <td>{{ $asignacion->detalle_compra->articulo->nombre_producto}}</td>
                        <td>{{ $asignacion->tipoVehiculo->nombre}}</td>
                        <td>{{ $asignacion->movimientos->conductor->getFullName()}}</td>
                        <td>{{ $asignacion->propietario->getFullName()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $asignaciones->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection