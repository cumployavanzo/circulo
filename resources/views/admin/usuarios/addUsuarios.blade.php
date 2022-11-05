@extends('layouts.AdminLTE.index')
@section('title', 'Usuarios')
@section('header', 'Usuarios')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo usuario
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.addUsuarios') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_personal" class="">Nombre Empleado</label>
                        <select type="select" id="txt_personal" name="txt_personal" class="form-control select2 " required>
                            <option value="">Selecciona</option>
                            @foreach($personales as $personal)
                                <option {{ old('txt_personal') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullname()}}</option>
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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txt_rol" class="">Perfil de usuario</label>
                    <select type="select" id="txt_rol" name="txt_rol" class="form-control" required>
                        <option value="">Selecciona</option>
                        @foreach($roles as $rol)
                            <option {{ old('txt_rol') == $rol->id ? 'selected' : '' }} value="{{$rol->id}}">{{$rol->nombre}}</option>
                        @endforeach
                    </select>
                    @error('userType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_email" class="">E-mail</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" id="txt_email" name="txt_email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_pass" class="">Password</label>
                        <input type="password" id="txt_pass" name="txt_pass" class="form-control" placeholder="Password">
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
@push('scripts')
<script>
    $("#txt_personal").select2({
        theme:"bootstrap4"
    });
     $("#txt_rol").select2({
        theme:"bootstrap4"
    });
</script>
@endpush