@extends('layouts.AdminLTE.index')

@section('title', 'Proveedores')
@section('header', 'Proveedores')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Proveedores</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.proveedor.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Proveedor"><li class="fas fa-plus"></li>&nbsp; Nuevo Proveedor</a>
                <a href="#" type="button" data-toggle="modal" data-target="#modalGlobal" class="btn btn-sm btn-info" title="Generar Reporte"><i class="fas fa-file-excel"></i>&nbsp; Global Proveedor</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" autocomplete="off">
                <div class="form-group row text-right">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm text-uppercase" placeholder="Introduce nombre proveedor " id="txt_name_proveedor" name="txt_name_proveedor" value="{{$name_proveedor}}">    
                    </div> 
                    <div class="col-sm-2 text-left">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i>&nbsp; Buscar</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Proveedor</th>
                        <th>Clave</th>
                        <th>Rfc</th>
                        <th>Tipo</th>
                        <th>Codigo Postal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                    <tr>
                        <td>#{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre_proveedor }}</td>
                        <td>{{ $proveedor->clave_proveedor }}</td>
                        <td>{{ $proveedor->rfc }}</td>
                        <td>{{ $proveedor->tipo_proveedor }}</td>
                        <td>{{ $proveedor->cp }}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.proveedor.edit', [$proveedor->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form action="{{ route('admin.deleteProveedor', [$proveedor->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $proveedores->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection
<div class="modal fade" id="modalGlobal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.reporteGastosGlobal') }}" autocomplete="off" id="f_reporte" name="f_reporte" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Exportar Reporte Global</h5>
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