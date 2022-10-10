@extends('layouts.AdminLTE.index')

@section('title', 'Analisis de Credito')
@section('header', 'Analisis de Credito')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Solicitudes</h3>
            {{-- <div class="card-tools pull-right">
                <a href="{{ route('admin.solicitud.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Solicitud"><li class="fas fa-plus"></li>&nbsp; Nueva Solicitud</a>
            </div> --}}
        </div>
        <div class="card-body">
            
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>ID solicitud</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Monto Solicitado</th>
                        <th>Fecha Solicitud</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $solicitud)
                    <tr>
                        <td># {{ $solicitud->id }}</td>
                        <td>{{ $solicitud->cliente->getFullName() }}</td>
                        <td>{{ $solicitud->producto->nombre }}</td>
                        <td>{{ number_format($solicitud->monto_solicitado,2,'.',',') }}</td>
                        <td>{{ date('d/m/Y', strtotime($solicitud->fecha_solicitud))}}</td> 
                        
                            @if ($solicitud->estatus == 'Pendiente')
                                <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $solicitud->estatus }}</small></td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.analisis_credito.edit', [$solicitud->id]) }}"><i class="fas fa-thumbtack"></i> Asignar</a>
                                </td>
                            @elseif($solicitud->estatus == 'Proceso')
                                <td><small class="badge badge-info"><i class="fas fa-check"></i> {{ $solicitud->estatus }}</small></td>
                                @if ($solicitud->users_id_analisis == auth()->user()->id)
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.analisis_credito.edit', [$solicitud->id]) }}"><i class="fas fa-thumbtack"></i> Analisis</a>
                                    </td>
                                @else
                                    <td class="project-actions text-right">
                                        <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                                    </td>
                                @endif
                            @else
                                <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $solicitud->estatus }}</small></td>
                                <td class="project-actions text-right">
                                    <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                                </td>
                            @endif
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $solicitudes->links()}}</div>
        </div>
    </div>
@endsection