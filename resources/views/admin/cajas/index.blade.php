@extends('layouts.AdminLTE.index')

@section('title', 'Cajas')
@section('header', 'Cajas')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Cajas</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.caja.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Caja"><li class="fas fa-plus"></li>&nbsp; Nueva Caja</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Responsable</th>
                        <th>Cuenta</th>
                        <th>Saldo Mínimo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajas as $caja)
                    <tr>
                        <td>#{{ $caja->id }}</td>
                        <td>{{ $caja->nombre_caja }}</td>
                        <td> {{ $caja->responsable->getFullName() }}</td>
                        <td> {{ $caja->cuenta->nombre_cuenta }}</td>
                        <td>{{ $caja->saldo_minimo }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.caja.edit', [$caja->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteCaja', [$caja->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $cajas->links()}}</div>
        </div>
    </div>
@endsection