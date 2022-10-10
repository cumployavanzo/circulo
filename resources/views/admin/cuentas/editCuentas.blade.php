@extends('layouts.AdminLTE.index')
@section('title', 'Cuentas')
@section('header', 'Cuentas')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('mensaje')}}
            </div>  
        @endif  
        <div class="card-header">
            <h4 class="card-title">
                Editar Cuenta
            </h4>
        </div>
        <form method="POST" action="{{action('CuentaController@update', $cuenta->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_nombre_cuenta">Nombre cuenta</label>
                        <input type="text" id="txt_nombre_cuenta" name="txt_nombre_cuenta" class="form-control text-uppercase" placeholder="Nombre de la Cuenta" required value="{{ $cuenta->nombre_cuenta}}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_num_cuenta">Número de cuenta</label>
                        <input type="text" id="txt_num_cuenta" name="txt_num_cuenta" class="form-control " placeholder="Número de la Cuenta" maxlength="20" value="{{ $cuenta->numero_cuenta}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_naturaleza">Naturaleza</label>
                        <select class="form-control" id="txt_naturaleza" name="txt_naturaleza">
                            <option {{ $cuenta->naturaleza == 'DEUDORA' ? 'selected' : ''}} value="DEUDORA">Deudora</option>
                            <option {{ $cuenta->naturaleza == 'ACREDORA' ? 'selected' : ''}} value="ACREDORA">Acredora</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_tipo">Tipo</label>
                        <select class="form-control" id="txt_tipo" name="txt_tipo">
                            <option {{ $cuenta->tipo == 'AUXILIAR' ? 'selected' : ''}} value="AUXILIAR">Auxiliar</option>
                            <option {{ $cuenta->tipo == 'MAYOR' ? 'selected' : ''}} value="MAYOR">Mayor</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_nivel">Nivel</label>
                        <input type="text" id="txt_nivel" name="txt_nivel" class="form-control" placeholder="Nivel" maxlength="3" value="{{ $cuenta->nivel}}">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_codigo_agrupador">Codigo Agrupador</label>
                        <input type="text" id="txt_codigo_agrupador" name="txt_codigo_agrupador" class="form-control" placeholder="Codigo Agrupador" maxlength="15" value="{{ $cuenta->codigo_agrupador}}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_cuenta_ca">Nombre de la cuenta CA</label>
                        <input type="text" id="txt_cuenta_ca" name="txt_cuenta_ca" class="form-control text-uppercase" placeholder="Nombre de la Cuenta CA" value="{{ $cuenta->nombre_cuenta_ca}}">
                    </div>
                </div>
            </div>
        </div>              
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
        </div>
        </form>
    </div>
</div>
@endsection