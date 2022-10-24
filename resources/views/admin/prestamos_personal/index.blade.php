@extends('layouts.AdminLTE.index')

@section('title', 'Prestamos Personales')
@section('header', 'Prestamos Personales')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Prestamos Personales</h3>
            <div class="card-tools">
                <div class="form-group float-right">
                    <div class="d-flex">
                        <a href="{{ route('admin.prestamoP.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Prestamo"><li class="fas fa-plus"></li>&nbsp; Nuevo</a>&nbsp;                        
                        <form action="{{ route('admin.reportePrestamos') }}" method="POST">
                            @method('post')
                            @csrf
                            <button class="btn btn-sm btn-info" title="Generar Reporte" type="submit" href="#"><i class="fas fa-file-excel"></i> Reporte</button>
                        </form>
                    </div>
                </div>
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
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha Prestamo</th>
                        <th>Empleado</th>
                        <th>Concepto</th>
                        <th>Monto Prestamo</th>
                        <th>Plazo</th>
                        <th>Pagos Descontados</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamosP as $prestamo)
                    <tr>
                        <td>#{{ $prestamo->id }}</td>
                        <td>{{ date('d/m/Y', strtotime($prestamo->fecha_prestamo))}}</td>
                        <td>{{ $prestamo->personals->getFullName() }}</td>
                        <td>{{ $prestamo->concepto->conceptos }}</td>
                        <td>$ {{number_format($prestamo->total_prestamo, 2, '.', '')}}</td>
                        <td>{{ $prestamo->num_pagos }}</td>
                        <td class="text-bold">{{ $prestamo->detallesPrestamo->where('estatus','Descontado')->count() }} / {{ $prestamo->detallesPrestamo->count() }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.prestamoP.show', [$prestamo->id]) }}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $prestamosP->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection
