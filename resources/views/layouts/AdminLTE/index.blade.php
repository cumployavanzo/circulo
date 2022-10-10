
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title' ,'Default')</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js">
<link href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('layouts/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('layouts/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('layouts/AdminLTE/dist/css/adminlte.min.css?v=3.2.0') }}">
<link rel="stylesheet" href="{{ asset('scripts/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('scripts/plugins/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('scripts/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
{{-- <link href="/select2-bootstrap-theme/select2-bootstrap.min.css" type="text/css" rel="stylesheet" /> --}}



{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"> --}}

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">



@include('layouts.AdminLTE.nav')

@include('layouts.AdminLTE.sidebar')



<div class="content-wrapper">

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    @yield('header' ,'Dashboard')
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<section class="content">
<div class="container-fluid">
    @yield('content')
</div>
</section>

</div>


<aside class="control-sidebar control-sidebar-dark">

</aside>


<footer class="main-footer">
<strong>Copyright &copy; 2014-2021 AdminRP<a href="https://adminlte.io"></a>.</strong>
All rights reserved.
<div class="float-right d-none d-sm-inline-block">
<b>Version</b> A.1.0
</div>
</footer>
</div>



<script src="{{ asset('layouts/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('layouts/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('layouts/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<script src="{{ asset('layouts/AdminLTE/dist/js/adminlte.js') }}?v=3.2.0"></script>


<script src="{{ asset('layouts/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('layouts/AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('layouts/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('layouts/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
<script src="{{ asset('scripts/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('scripts/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('scripts/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

<script src="{{ asset('scripts/js/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('scripts/js/funciones.js') }}"></script>


@stack('scripts')

{{-- <script src="AdminLTE/dist/js/demo.js"></script> --}}

{{-- <script src="AdminLTE/dist/js/pages/dashboard2.js"></script>  --}}
</body>
</html>
