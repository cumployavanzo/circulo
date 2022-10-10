@extends('layouts.AdminLTE.index')

@section('title', 'Empresas')
@section('header', 'Empresas')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Empresas</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.empresa.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Empresa"><li class="fas fa-plus"></li>&nbsp; Nueva Empresa</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Nombre</th>
                        <th>Razon Social</th>
                        <th>Clave</th>
                        <th>Fecha Inicio</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                    <tr>
                        <td>#{{ $empresa->id }}</td>
                        <td>{{ $empresa->nombre_empresa }}</td>
                        <td>{{ $empresa->razon_social }}</td>
                        <td>{{ $empresa->clave }}</td>
                        <td>{{ $empresa->fecha_inic_operaciones }}</td>
                        <td class="project-actions">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.empresa.edit', [$empresa->id]) }}"><i class="fas fa-pencil-alt"></i>Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $empresas->links()}}</div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

</script>
@endpush