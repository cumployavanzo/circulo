@extends('layouts.AdminLTE.index')

@section('title', 'Clientes')
@section('header', 'Clientes')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Clientes</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.cliente.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Cliente"><li class="fas fa-plus"></li>&nbsp; Nuevo Cliente</a>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-info" title="Generar Reporte"><i class="fas fa-file-excel"></i>&nbsp; Reporte Clientes</a>
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
                        <th style="width: 1%">#</th>
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Fecha Nac.</th>
                        <th>Edad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>#{{ $cliente->id }}</td>
                        <td>{{ $cliente->getFullName() }}</td>
                        <td>{{ $cliente->genero }}</td>
                        <td>{{ $cliente->fecha_nacimiento }}</td>
                        <td>{{ $cliente->edad }} Años</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.cliente.edit', [$cliente->id]) }}"><i class="fas fa-pencil-alt"></i>Editar</a>
                            {{-- <form action="{{ route('admin.deleteCliente', [$cliente->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-trash"></i> Borrar</button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $clientes->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.reporteClientes') }}" autocomplete="off" id="f_reporte" name="f_reporte" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Exportar Reporte de Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="limpiaForm(f_reporte)" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-10">
                        <div class="form-group">
                            <label for="txt_asociado" class="">Asociado</label>
                            <select type="select" id="txt_asociado" name="txt_asociado" class="form-control select2 " required>
                                <option value="">Selecciona</option>
                                @foreach($asociados as $asociado)
                                    <option {{ old('txt_asociado') == $asociado->id ? 'selected' : '' }} value="{{$asociado->id}}">{{$asociado->getFullname()}}</option>
                                @endforeach
                            </select>
                            @error('userType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@push('scripts')
<script>
    $("#txt_asociado").select2({
        theme:"bootstrap4"
    });
    
</script>
@endpush