@extends('layouts.AdminLTE.index')

@section('title', 'Bonos')
@section('header', 'Bonos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Bonos</h3>
            <div class="card-tools">
                <div class="form-group float-right">
                    <div class="d-flex">
                        <a href="{{ route('admin.bono.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Bono"><li class="fas fa-plus"></li>&nbsp; Nuevo</a>&nbsp;                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
           
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>% Cobrado</th>
                        <th>% Recuperado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bonos as $bono)
                    <tr>
                        <td>#{{ $bono->id }}</td>
                        <td>{{ $bono->personals->getFullName() }}</td>
                        <td>{{ $bono->personals->puestoid->puesto }}</td>
                        <td>{{ $bono->tot_porcent_cobrado }}</td>
                        <td>{{ $bono->tot_porcent_recuperado }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.bono.edit', [$bono->id]) }}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $bonos->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection
