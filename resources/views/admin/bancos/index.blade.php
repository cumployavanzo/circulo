@extends('layouts.AdminLTE.index')

@section('title', 'Bancos')
@section('header', 'Bancos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Bancos</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.banco.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Banco"><li class="fas fa-plus"></li>&nbsp; Nuevo Banco</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Nombre Cuenta</th>
                        <th>Número Cuenta</th>
                        <th>Cuenta Clave</th>
                        <th>Número Tarjeta</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bancos as $banco)
                    <tr>
                        <td>#{{ $banco->id }}</td>
                        <td>{{ $banco->banco }}</td>
                        <td> {{ $banco->nombre_cuenta }}</td>
                        <td> {{ $banco->numero_cuenta }}</td>
                        <td>{{ $banco->cuenta_clave }}</td>
                        <td>{{ $banco->num_tarjeta }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.banco.edit', [$banco->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteBanco', [$banco->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $bancos->links()}}</div>
        </div>
    </div>
@endsection