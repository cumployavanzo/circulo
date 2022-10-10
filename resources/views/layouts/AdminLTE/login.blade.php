<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CFOWOLF | Inicio de Sesión</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('layouts/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('layouts/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('layouts/AdminLTE/dist/css/adminlte.min.css') }}">
</head>

<style>
 .card { background-color: rgba(245, 245, 245, 0.4); }
.card-header, .card-footer { opacity: 1}
img {
  opacity: 0.5;
}
.special-card {
            background-color: rgba(245, 245, 245, 0.4) !important;
        }
  body{
        background-image: url(img/fondo3.jpeg);
        background-blend-mode: multiply;
        background-position: center;
        background-size: cover;
        
    }
    body:before{
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        background: rgba(0,0,0,0.29);
    }
</style>
<body class="hold-transition login-page">
    
<div class="login-box">
  <!-- /.login-logo -->
  @yield('content')
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('layouts/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('layouts/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('layouts/AdminLTE/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
