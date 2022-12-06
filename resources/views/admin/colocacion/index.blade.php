@extends('layouts.AdminLTE.index')

@section('title', 'Colocacion')
@section('header', 'Colocacion')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Solicitudes</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.colocacion.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Solicitud"><li class="fas fa-plus"></li>&nbsp; Nueva Solicitud</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" autocomplete="off">
                <div class="form-group row text-right">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm text-uppercase" placeholder="Introduce nombre a buscar " id="txt_name" name="txt_name" value="{{$name}}">    
                    </div> 
                    <div class="col-sm-2 text-left">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i>&nbsp; Buscar</button>
                    </div>
                </div>
            </form>
            {{-- <div class="form-group float-right">
                <div class="d-flex">
                    <form action="{{ route('admin.solicitud.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Pendiente">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-warning">{{$statePendiente->count()}}</span>
                            <i class="fas fa-ban"></i> Pendiente
                        </button>
                    </form>
                    <form action="{{ route('admin.solicitud.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Proceso">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-info">{{$stateProceso->count()}}</span>
                            <i class="fas fa-sync fa-spin"></i> Proceso
                        </button>
                    </form>
                    <form action="{{ route('admin.solicitud.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Autorizado">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-success">{{$stateTerminado->count()}}</span>
                            <i class="fas fa-check-circle"></i> Autorizado
                        </button>
                    </form>
                </div>
            </div> --}}
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>ID solicitud</th>
                        <th>Cliente</th>
                        <th>Periodo</th>
                        <th>Monto </th>
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
                        <td>{{ $solicitud->primaSuma->periodo->descripcion}}</td>
                        <td>{{ number_format($solicitud->primaSuma->suma_asegurada,2,'.',',') }}</td>
                        <td>{{ date('d/m/Y', strtotime($solicitud->fecha_solicitud))}}</td> 
                        @if ($solicitud->estado_solseg == 'Pendiente')
                            <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $solicitud->estado_solseg }}</small></td>
                          
                        @elseif($solicitud->estado_solseg == 'Proceso')
                            <td><small class="badge badge-info"><i class="fas fa-check"></i> {{ $solicitud->estado_solseg }}</small></td>
                          
                        @elseif($solicitud->estado_solseg == 'Terminado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $solicitud->estado_solseg }}</small></td>
                           
                        @elseif($solicitud->estado_solseg == 'Rechazado')
                            <td><small class="badge badge-danger">{{ $solicitud->estado_solseg }}</small></td>
                           
                        @endif
                        <td class="project-actions text-right">
                            <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="float-right">{{ $solicitudes->appends(request()->query())->links()}}</div> --}}
        </div>
    </div>
@endsection