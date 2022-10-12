@extends('layouts.AdminLTE.index')

@section('title', 'Cobros')
@section('header', 'Cobros')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de pendientes</h3>
        </div>
        <div class="card-body">
            <div class="form-group float-right">
                <div class="d-flex">
                    <form action="{{ route('admin.cobro.index') }}">
                        @csrf
                        <input type="hidden" id="bandera" name="bandera" value="Aportacion">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-success"></span>
                            <i class="fas fa-money-check-alt"></i> Cobros
                        </button>
                    </form>
                    <form action="{{ route('admin.cobro.index') }}">
                        @csrf
                        <input type="hidden" id="bandera" name="bandera" value="Cartera">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-danger"></span>
                            <i class="fas fa-users-slash"></i> Cartera
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