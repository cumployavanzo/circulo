@extends('layouts.AdminLTE.index')

@section('title', 'Roles')
@section('header', 'Roles')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Roles</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.rol.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Rol"><li class="fas fa-plus"></li>&nbsp; Nuevo Rol</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $rol)
                    <tr>
                        <td>#{{ $rol->id }}</td>
                        <td>{{ $rol->nombre }}</td>
                        <td>{{ $rol->estatus }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.rol.edit', [$rol->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="float-right">{{ $roles->links()}}</div> --}}
        </div>
    </div>
@endsection