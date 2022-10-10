@extends('layouts.AdminLTE.index')

@section('title', 'Compras')
@section('header', 'Compras')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Solicitudes</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.gasto.create') }}"  type="button" class="btn btn-sm btn-primary" title="Nueva compra"><li class="fas fa-plus"></li>&nbsp; Nuevo Gasto</a>
                <a href="#" type="button" data-toggle="modal" data-target="#modalGastos" class="btn btn-sm btn-info" title="Generar Reporte"><i class="fas fa-file-excel"></i>&nbsp; Detalle Proveedor</a>
                <a href="#" type="button" data-toggle="modal" data-target="#modalArticulos" class="btn btn-sm btn-info" title="Generar Reporte"><i class="fas fa-file-excel"></i>&nbsp; Detalle Articulos</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" autocomplete="off">
                <div class="form-group row text-right">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm text-uppercase" placeholder="Introduce nombre a buscar " id="txt_name" name="txt_name" value="{{$name_proveedor}}">    
                    </div> 
                    <div class="col-sm-2 text-left">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i>&nbsp; Buscar</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 2%">Folio</th>
                        <th>Fecha</th>
                        <th>Factura</th>
                        <th>Proveedor</th>
                        <th>Usuario</th>
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
                        <td>{{ $gasto->num_factura}}</td>
                        <td>{{ $gasto->proveedor->nombre_proveedor}}</td>
                        <td>{{ $gasto->usuario->personal->getName()}}</td>
                        @if ($gasto->estatus == 'Pendiente')
                            <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $gasto->estatus }}</small></td>
                        @elseif($gasto->estatus == 'Pagado')
                            <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->estatus }}</small></td>
                        @endif
                        @if($gasto->movimiento)
                            @if ($gasto->movimiento->state == 'Pendiente')
                                <td><small class="badge badge-warning"><i class="far fa-clock"></i> {{ $gasto->movimiento->state }}</small></td>
                                <td class="project-actions">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.gasto.edit', [$gasto->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            @elseif($gasto->movimiento->state == 'Proceso')
                                <td><small class="badge badge-info"><i class="fas fa-check"></i> {{ $gasto->movimiento->state }}</small></td>
                                <td class="project-actions">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.gasto.edit', [$gasto->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            @elseif($gasto->movimiento->state == 'Contabilizado')
                                <td><small class="badge badge-success"><i class="fas fa-check"></i> {{ $gasto->movimiento->state }}</small></td>
                                <td class="project-actions">
                                    <button class="btn btn-info btn-sm"><i class="fas fa-ban"></i></button>
                                </td>
                            @endif
                        @endif      
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $gastos->appends(request()->query())->links()}}</div>

        </div>
    </div>
@endsection
<div class="modal fade" id="modalGastos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.reporteGastos') }}" autocomplete="off" id="f_reporte" name="f_reporte" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Exportar Reporte Detalles</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="limpiaForm(f_reporte)" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="fecha_inicial">Fecha Inicial:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="fecha_final">Fecha Final:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_final" name="fecha_final" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiaForm(f_reporte)">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Exportar</button>
                  </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalArticulos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.reporteArticulos') }}" autocomplete="off" id="f_reporte_art" name="f_reporte_art" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Exportar Reporte Detalles</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="limpiaForm(f_reporte_art)" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="fecha_inicial">Fecha Inicial:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="fecha_final">Fecha Final:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_final" name="fecha_final" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiaForm(f_reporte_art)">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Exportar</button>
                  </div>
            </form>
        </div>
    </div>
</div>

