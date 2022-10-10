@extends('layouts.AdminLTE.index')

@section('title', 'Puestos')
@section('header', 'Puestos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Puestos</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.puesto.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Puesto"><li class="fas fa-plus"></li>&nbsp; Nuevo Puesto</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Puesto</th>
                        <th >Area</th>
                        <th >Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($puestos as $puesto)
                    <tr>
                        <td>#{{ $puesto->id }}</td>
                        <td><a>{{ $puesto->puesto }}</a></td>
                        <td>{{ $puesto->areas->nombre }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.puesto.edit', [$puesto->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deletePuesto', [$puesto->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $puestos->links()}}</div>
        </div>
    </div>
@endsection