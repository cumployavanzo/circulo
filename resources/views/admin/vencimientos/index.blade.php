@extends('layouts.AdminLTE.index')

@section('title', 'Vencimientos')
@section('header', 'Vencimientos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Pagos</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.cobro.index') }}" type="button" class="btn btn-sm btn-info" title="Regresar"><i class="fas fa-arrow-left"></i>&nbsp; Regresar</a>
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
            <div class="form-group float-right">
                <div class="d-flex">
                    <form action="{{ route('admin.vencimiento.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Cobrado">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-success">{{$stateCobrado->count()}}</span>
                            <i class="fas fa-hand-holding-usd"></i> Cobrado
                        </button>
                    </form>
                    <form action="{{ route('admin.vencimiento.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="No cobrado">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-danger">{{$stateNocobrado->count()}}</span>
                            <i class="fas fa-hand-holding"></i> No cobrado
                        </button>
                    </form>
                </div>
            </div>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Fecha Pago</th>
                        <th>Pago</th>
                        <th>Capital</th>
                        <th>Interes</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vencimientos as $vencimiento)
                    <tr>
                        <td>#{{ $vencimiento->id }}</td>
                        <td>{{ $vencimiento->nombre }} {{ $vencimiento->apellido_paterno }} {{ $vencimiento->apellido_materno }}</td>
                        <td>{{ date('d/m/Y', strtotime($vencimiento->fecha_pago))}}</td>
                        <td>$ {{number_format($vencimiento->pago, 2, '.', '')}}</td>
                        <td>$ {{number_format($vencimiento->capital, 2, '.', '')}}</td>
                        <td>$ {{number_format($vencimiento->interes, 2, '.', '')}}</td>
                        <td>
                            @if ($vencimiento->estatus == 'No cobrado')
                                <a class="btn btn-primary btn-sm " href="{{ route('admin.vencimiento.edit', [$vencimiento->id]) }}" title="Cobrar">&nbsp;Cobrar</a>
                            @elseif ($vencimiento->estatus == 'Cobrado')
                                <a class="btn btn-primary btn-sm " href="{{ route('admin.vencimiento.show', [$vencimiento->id]) }}" title="Ver Detalles"><i class="fas fa-eye"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $vencimientos->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection
