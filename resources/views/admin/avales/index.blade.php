@extends('layouts.AdminLTE.index')

@section('title', 'Avales')
@section('header', 'Avales')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Avales</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.aval.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Aval"><li class="fas fa-plus"></li>&nbsp; Nuevo Aval</a>
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
                    @foreach($avales as $aval)
                    <tr>
                        <td>#{{ $aval->id }}</td>
                        <td>{{ $aval->getFullName() }}</td>
                        <td>{{ $aval->genero }}</td>
                        <td>{{ $aval->fecha_nacimiento }}</td>
                        <td>{{ $aval->edad }} Años</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.aval.edit', [$aval->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
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
            <div class="float-right">{{ $avales->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection