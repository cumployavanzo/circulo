@extends('layouts.AdminLTE.index')

@section('title', 'Desembolsos')
@section('header', 'Desembolsos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Desembolsos</h3>
            {{-- <div class="card-tools pull-right">
                <a href="{{ route('admin.solicitud.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Solicitud"><li class="fas fa-plus"></li>&nbsp; Nueva Solicitud</a>
            </div> --}}
        </div>
        <div class="card-body">
            
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>ID credito</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Monto Autorizado</th>
                        <th>Fecha Autorización</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($creditos as $credito)
                    
                    <tr>
                        <td># {{ $credito->id }}</td>
                        <td>{{ $credito->solicitud->cliente->getFullName() }}</td>
                        <td>{{ $credito->solicitud->producto()->first()->nombre }}</td>
                        <td>{{ number_format($credito->monto_autorizado,2,'.',',') }}</td>
                        <td>{{ date('d/m/Y', strtotime($credito->created_at))}}</td>
                        @if ($credito->desembolso == 'Pendiente')
                            <td><small class="badge badge-warning">{{ $credito->desembolso }}&nbsp;&nbsp;<i class="far fa-clock"></i></small></td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.desembolso.edit', [$credito->id]) }}"><i class="fas fa-comment-dollar"></i>&nbsp;Desembolsar</a>
                            </td>
                        @elseif($credito->desembolso == 'Desembolsado')
                            <td><small class="badge badge-success">{{ $credito->desembolso }}&nbsp;&nbsp;<i class="fas fa-check"></i></small></td>
                            <td class="project-actions text-right">
                                <a href="{{ route('admin.solicitudCredito', [$credito->solicituds_id]) }}" target="_blank" class="btn btn-default btn-sm"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            {{-- <td class="project-actions text-right">
                                <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                            </td> --}}
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $creditos->links()}}</div>
        </div>
    </div>
@endsection