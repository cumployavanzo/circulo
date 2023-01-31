@extends('layouts.AdminLTE.index')

@section('title', 'Prospectos')
@section('header', 'Prospectos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Prospectos</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.prospecto.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Aval"><li class="fas fa-plus"></li>&nbsp; Nuevo Prospecto</a>
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
                        <th>Curp</th>
                        <th>Colonia</th>
                        <th>Asesor</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prospectos as $prospecto)
                    @php
                        if($prospecto->genero == 'M'){
                            $genero = 'MASCULINO'; 
                        }else if($prospecto->genero == 'F'){
                            $genero = 'FEMENINO';  
                        }else{
                            $genero = 'INDISTINTO';
                        }
                    @endphp
                    <tr>
                        <td>#{{ $prospecto->id }}</td>
                        <td>{{ $prospecto->getFullName() }}</td>
                        <td>{{ $genero }}</td>
                        <td>{{ $prospecto->curp }}</td>
                        <td>{{ $prospecto->colonia }}</td>
                        <td>{{ $prospecto->usuario->personal->getFullName()}}</td>
                        <td class="project-actions d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('admin.prospecto.edit', [$prospecto->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $prospectos->appends(request()->query())->links()}}</div>
        </div>
    </div>
@endsection