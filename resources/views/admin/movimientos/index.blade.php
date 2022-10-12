@extends('layouts.AdminLTE.index')

@section('title', 'Movimientos')
@section('header', 'Movimientos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Movimientos</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th># Movimiento</th>
                        <th>Fecha Pago</th>
                        <th>Bandera</th>
                        <th>Estatus Movimiento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movimientoGastos as $movgasto)
                    <tr>
                        <td>#{{ $movgasto->id}}</td>
                        @if ($movgasto->bandera == 'Desembolso' || $movgasto->bandera == 'Vencimiento')
                            <td>{{ date('d/m/Y', strtotime($movgasto->fecha_pago))}}</td>
                        @else
                            <td>{{ date('d/m/Y', strtotime($movgasto->compra->fecha_compra))}}</td>
                        @endif
                        <td><small class="badge badge-danger">{{ $movgasto->bandera }}</small></td>
                        @if ($movgasto->state == 'Pendiente')
                            <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $movgasto->state }}</small></td>
                            <td class="project-actions d-flex">
                                <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.movimiento.edit', [$movgasto->id]) }}"><i class="fas fa-thumbtack"></i> Aplicar</a>
                            </td>
                        @elseif($movgasto->state == 'Proceso')
                            <td><small class="badge badge-info"><i class="fas fa-check"></i> {{ $movgasto->state }}</small></td>
                            @if ($movgasto->users_contabilizo == auth()->user()->id)
                                <td class="project-actions d-flex">
                                    <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.movimiento.edit', [$movgasto->id]) }}"><i class="fas fa-hourglass"></i> Contabilizar</a>
                                </td>   
                            @else
                                <td class="project-actions d-flex">
                                    <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                                </td>
                            @endif
                        @elseif($movgasto->state == 'Contabilizado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $movgasto->state }}</small></td>
                            <td class="project-actions d-flex">
                                <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                            </td>
                        @endif   
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $movimientoGastos->links()}}</div>
        </div>
    </div>
@endsection