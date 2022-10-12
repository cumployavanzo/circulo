@extends('layouts.AdminLTE.index')

@section('title', 'Vencimientos')
@section('header', 'Vencimientos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Pagos</h3>
        </div>
        <div class="card-body">
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
                            <a class="btn btn-primary btn-sm " href="{{ route('admin.vencimiento.edit', [$vencimiento->id]) }}" title="Autorizar">&nbsp;Cobrar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $vencimientos->links()}}</div>
        </div>
    </div>
@endsection
