@extends('layouts.AdminLTE.index')
@section('title', 'Sucursal')
@section('header', 'Sucursal')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nueva Sucursal
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.sucursal_ruta.store') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_nombre_ruta">Nombre de la Ruta ó Sucursal</label>
                        <input type="text" id="txt_nombre_ruta" name="txt_nombre_ruta" class="form-control text-uppercase" placeholder="Nombre de la Ruta ó Sucursal" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_ruta">Número de Ruta ó Sucursal</label>
                        <input type="text" id="txt_num_ruta" name="txt_num_ruta" class="form-control " placeholder="Número de Ruta ó Sucursal" maxlength="20">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="txt_telefono">Teléfono</label>
                        <input type="text" id="txt_telefono" name="txt_telefono" class="form-control" placeholder="(999) 999-9999" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_ciudad">Ciudad</label>
                        <input type="text" id="txt_ciudad" name="txt_ciudad" class="form-control text-uppercase" placeholder="Ciudad">
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="txt_direccion">Dirección</label>
                    <textarea class="form-control text-uppercase" rows="2" id="txt_direccion" name="txt_direccion" placeholder="Dirección ..."></textarea>                    
                </div>
            </div>
        </div>              
        <div class="card-footer">
            <div class="col-12">
                <a type="button" href="javascript:history.back()" class="btn btn-danger float-right">Cerrar</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Guardar</button>
            </div>
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