@extends('layouts.AdminLTE.index')
@section('title', 'Puestos')
@section('header', 'Puestos')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo puesto
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.addPuestos') }}">
            @csrf
        <div class="card-body">
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="txt_nombre_puesto">Nombre</label>
                    <input type="text" id="txt_nombre_puesto" name="txt_nombre_puesto" class="form-control text-uppercase" placeholder="Nombre del Puesto">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txt_area" class="">Área</label>
                    <select type="select" id="txt_area" name="txt_area" class="form-control select2 " required>
                        <option value="">Selecciona</option>
                        @foreach($areas as $area)
                            <option {{ old('txt_area') == $area->id ? 'selected' : '' }} value="{{$area->id}}">{{$area->nombre}}</option>
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
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_sueldo_inicial">Sueldo Inicial:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="txt_sueldo_inicial" name="txt_sueldo_inicial">  
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_sueldo_final">Sueldo Final:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="txt_sueldo_final" name="txt_sueldo_final">  
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txt_comisiones">Comisiones:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="txt_comisiones" name="txt_comisiones">  
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
    $("#txt_sueldo_inicial").maskMoney({
        decimal: ".",
        thousands: ","
    })
    $("#txt_sueldo_final").maskMoney({
        decimal: ".",
        thousands: ","
    })
    $("#txt_comisiones").maskMoney({
        decimal: ".",
        thousands: ","
    })

    $("#txt_area").select2({
        theme:"bootstrap4"
    });
</script>
@endpush