@extends('layouts.AdminLTE.login')

@section('content')
  <div class="card">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
          <!-- <a class="navbar-brand">CUMPLO Y AVANZO</a> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                  
                  <li class="nav-item">
                      <a class="nav-link active" href="{{ route('registro.index') }}">Registrarse</a>
                  </li>
              </ul>
          </div>
      </div>
    </nav>
    {{-- <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>CUMPLO</b>Y AVANZO</a>
    </div> --}}
    <div class="card-header text-center mx-auto">
        <img class="rounded-circle mx-auto d-block m-2" style="width: 55%;" src="{{ asset('img/lobo1.jpg') }}" alt="Logo">
        {{-- <img class="rounded-circle mx-auto d-block m-2 logo" style="width: 25%;" src="{{ asset('img/lobo1.jpg') }}" alt="Logo"> PARA MEGANA--}}

        <h2>Bienvenido</h2>
    </div>
    <div class="card-body">
      @if (session('notification'))
          <div class="alert alert-success">
              {{session('notification')}}
          </div>
      @endif
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
            <button type="submit" class="btn bg-maroon btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div><br>
        <div class="row">
          <div class="col-12">
              <a href="{{ route('loginCliente') }}"  method="POST" type="button" class="btn btn-info btn-block btn-flat"><i class="fa fa-bell"></i> Solicita tu prestamo aquí</a>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
@endsection