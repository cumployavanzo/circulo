@extends('layouts.AdminLTE.login')

@section('content')
  <div class="card">
    {{-- <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>CFO</b>WOLF</a>
    </div> --}}
    <div class="card-header text-center mx-auto">
        <img class="rounded-circle mx-auto d-block" src="{{ asset('img/lobo1.jpg') }}" alt="Logo"><b>CFO</b>WOLF
        <h2>Bienvenido</h2>
    </div>
    <div class="card-body">
      {{-- <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p> --}}
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>    
        @if (count($errors) > 0) <div class="alert alert-danger"> @foreach ($errors->all() as $error) {{ $error }} @endforeach </div> @endif
        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
@endsection