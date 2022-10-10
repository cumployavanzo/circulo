@extends('layouts.AdminLTE.index')

@section('title', 'Areas')
@section('header', 'Areas')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Areas</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.area.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Area"><li class="fas fa-plus"></li>&nbsp; Nueva Area</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Area</th>
                        <th>Télefono</th>
                        <th>Extensión</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($areas as $area)
                    <tr>
                        <td>#{{ $area->id }}</td>
                        <td><a>{{ $area->nombre }}</a> </td>
                        <td>{{ $area->tel }}</td>
                        <td>{{ $area->extension }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.area.edit', [$area->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteArea', [$area->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $areas->links()}}</div>
        </div>
    </div>
@endsection