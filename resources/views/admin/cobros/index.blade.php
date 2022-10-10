@extends('layouts.AdminLTE.index')

@section('title', 'Cobros')
@section('header', 'Cobros')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de pendientes</h3>
        </div>
        <div class="card-body">
            
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 2%">Folio Gasto</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Usuario</th>
                        <th>Movimiento</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gastos as $gasto)
                    <tr>
                        <td>#{{ $gasto->id }}</td>
                        <td>{{ date('d/m/Y', strtotime($gasto->fecha_compra))}}</td>
                        <td>{{ $gasto->personals->getFullName()}}</td>
                        <td>{{ $gasto->usuario->personal->getName()}}</td>
                        @if ($gasto->movimiento->state == 'Pendiente')
                            <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $gasto->movimiento->state }}</small></td>
                        @elseif($gasto->movimiento->state == 'Proceso')
                            <td><small class="badge badge-info"><i class="fas fa-check"></i> {{ $gasto->movimiento->state }}</small></td>
                        @elseif($gasto->movimiento->state == 'Contabilizado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->movimiento->state }}</small></td>
                        @endif
                        @if ($gasto->estatus == 'Pendiente')
                            <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $gasto->estatus }}</small></td>
                            <td class="project-actions d-flex">
                                <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.cobro.edit', [$gasto->id]) }}"><i class="fas fa-thumbtack"></i></a>
                            </td> 
                        @elseif($gasto->estatus == 'Pagado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->estatus }}</small></td>
                            <td class="project-actions d-flex">
                                <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                            </td>
                        @elseif($gasto->estatus == 'Cobrado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->estatus }}</small></td>
                            <td class="project-actions d-flex">
                                <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                            </td>
                        @endif
                        
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $gastos->links()}}</div>
        </div>
    </div>
@endsection