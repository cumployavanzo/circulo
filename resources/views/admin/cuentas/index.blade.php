@extends('layouts.AdminLTE.index')

@section('title', 'Cuentas')
@section('header', 'Cuentas')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Cuentas</h3>
            <div class="card-tools">
                <div class="form-group float-right">
                    <div class="d-flex">
                        <a href="{{ route('admin.cuenta.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Cuenta"><li class="fas fa-plus"></li>&nbsp; Nueva Cuenta</a>&nbsp;
                        <form action="{{ route('admin.reporteCuentas') }}" method="POST">
                            @method('post')
                            @csrf
                            <button class="btn btn-sm btn-info" title="Generar Reporte" type="submit" href="#"><i class="fas fa-file-excel"></i> Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cuenta</th>
                        <th>Naturaleza</th>
                        <th>Tipo</th>
                        <th>Codigo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuentas as $cuenta)
                    <tr>
                        <td>#{{ $cuenta->id }}</td>
                        <td> {{ $cuenta->nombre_cuenta }}</td>
                        <td>{{ $cuenta->numero_cuenta }}</td>
                        <td>{{ $cuenta->naturaleza }}</td>
                        <td>{{ $cuenta->tipo }}</td>
                        <td>{{ $cuenta->codigo_agrupador }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.cuenta.edit', [$cuenta->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteCuenta', [$cuenta->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $cuentas->links()}}</div>
        </div>
    </div>
@endsection