@extends('layouts.AdminLTE.login')

@section('content')
<div class="card">
    <form method="POST" action="{{ route('registro.store')  }}" autocomplete="off">
    @csrf
        <div class="card-header text-center">
            <h2>REGISTRO DE USUARIO</h2>
        </div>
        <img class="rounded-circle mx-auto d-block m-2 logo" style="width: 25%;" src="{{ asset('img/lobo1.jpg') }}" alt="Logo">
        <div class="card-body">
            @if (session('mensaje'))
                <div class="alert alert-success">
                <h5>{{session('titulo')}}</h5>
                    {{session('mensaje')}}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control text-uppercase" id="txt_clave" name="txt_clave" placeholder="Clave Elector" minlength="18" maxlength="18" autofocus="" required="" aria-required="true">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="E-mail" required="" aria-required="true">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="txt_emailC" name="txt_emailC" placeholder="Confirmar E-mail" required="" aria-required="true">
            </div>
            <div class="form-group">
                <input type="password" id="txt_pass" name="txt_pass" class="form-control" placeholder="Password">
            </div>
            <div class="form-group float-right">
                <small style="color: #050505;"> * Recibirá el correo electrónico de confirmación después de enviar este formulario.</small>
            </div>
            <div class="form-group">
                <div id="botonera">
                    <button type="submit" class="btn btn-primary btn-block">
                        Regístrate
                    </button>
                </div>
            </div>
        </div>
  </form>    
</div>
@endsection