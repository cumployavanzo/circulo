@extends('layouts.AdminLTE.index')

@section('title', 'Capital')
@section('header', 'Capital')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Solicitudes</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.capital.create') }}"  type="button" class="btn btn-sm btn-primary" title="Nuevo"><li class="fas fa-plus"></li>&nbsp; Nuevo</a>
            </div>
        </div>
        <div class="card-body">
            
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 2%">Folio</th>
                        <th>Fecha</th>
                        <th>Empleado</th>
                        <th>Usuario realizo</th>
                        <th>Estatus</th>
                        <th>Movimiento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gastos as $gasto)
                    <tr>
                        <td>#{{ $gasto->id }}</td>
                        <td>{{ date('d/m/Y', strtotime($gasto->fecha_compra))}}</td>
                        <td>{{ $gasto->personals->getFullName()}}</td>
                        <td>{{ $gasto->usuario->personal->getFullName()}}</td>
                        @if ($gasto->estatus == 'Pendiente')
                            <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $gasto->estatus }}</small></td>
                        @elseif($gasto->estatus == 'Pagado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->estatus }}</small></td>
                        @elseif($gasto->estatus == 'Cobrado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->estatus }}</small></td>
                        @endif
                        @if($gasto->movimiento)
                            @if ($gasto->movimiento->state == 'Pendiente')
                                <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $gasto->movimiento->state }}</small></td>
                                <td class="project-actions d-flex">
                                    <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.capital.edit', [$gasto->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                                </td>
                            @elseif($gasto->movimiento->state == 'Proceso')
                                <td><small class="badge badge-info"><i class="fas fa-check"></i> {{ $gasto->movimiento->state }}</small></td>
                                {{-- <td class="project-actions d-flex">
                                    <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.gasto.edit', [$gasto->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                                </td> --}}
                                <td class="project-actions d-flex">
                                    <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                                </td>
                            @elseif($gasto->movimiento->state == 'Contabilizado')
                                <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->movimiento->state }}</small></td>
                                <td class="project-actions d-flex">
                                    <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                                </td>
                            @endif
                        @endif      
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $gastos->links()}}</div>
        </div>
    </div>
@endsection