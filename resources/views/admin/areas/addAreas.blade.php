@extends('layouts.AdminLTE.index')
@section('title', 'Áreas')
@section('header', 'Áreas')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Alta de área
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.addAreas') }}" autocomplete="off">
            @csrf
        <div class="card-body">
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="txt_nombre_area">Nombre</label>
                    <input type="text" id="txt_nombre_area" name="txt_nombre_area" class="form-control text-uppercase" placeholder="Nombre del Área">
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_telefono">Teléfono</label>
                        <input type="text" id="txt_telefono" name="txt_telefono" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="txt_extension">Extensión</label>
                        <input type="text" id="txt_extension" name="txt_extension" class="form-control" placeholder="Extension" maxlength="4">
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
    $('[data-mask]').inputmask()
</script>
@endpush