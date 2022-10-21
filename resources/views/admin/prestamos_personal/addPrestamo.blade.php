@extends('layouts.AdminLTE.index')
@section('title', 'Nomina')
@section('header', 'Nomina')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo Prestamo
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.prestamoP.store') }}" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">   
                        <div class="col-lg-4">
                            <label for="fecha_prestamo">Fecha Prestamo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_prestamo" name="fecha_prestamo" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-8">                                               
                            <label for="Fk_empleado">Empleado:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <select type="select" id="Fk_empleado" name="Fk_empleado" class="form-control select2 " required>
                                    <option value="">Selecciona</option>
                                    @foreach($personals as $personal)
                                        <option {{ old('Fk_empleado') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
                                    @endforeach
                                </select>
                                @error('userType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $messages }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                           
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label>Concepto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-list"></i></span>
                            </div>
                            <select type="select" id="txt_concepto_nomina" name="txt_concepto_nomina" class="form-control select2 " required>
                                <option value="">Selecciona</option>
                                @foreach($conceptoNomina as $conceptoNom)
                                    <option {{ old('txt_concepto_nomina') == $conceptoNom->id ? 'selected' : '' }} value="{{$conceptoNom->id}}">{{$conceptoNom->conceptos}}</option>
                                @endforeach
                            </select>
                            @error('userType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if (\Session::has('errorMessage'))   
                        <span id="msjValidacion" class="text-danger"><b> {!! \Session::get('errorMessage') !!}</b></span>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="num_pagos">N° de Pagos:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fab fa-slack-hash"></i></span>
                            </div>
                            <input id="num_pagos" class="form-control text-uppercase" type="number" name="num_pagos" placeholder="N° de Pagos" required="" maxlength="20">
                        </div>
                    </div> 
                    <div class="col-lg-3">
                        <label for="txt_monto">Monto del Prestamo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control" id="txt_monto" name="txt_monto">
                        </div>
                    </div>
                </div> 
              
              
            </div><!-- /.card-body -->                                       
            <div class="card-footer">
                <button type="submit" href="#" class="btn btn-info float-right">Guardar</button>
            </div>    
        </form>
</div>
@endsection
@push('scripts')

<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    
    
    $("#txt_monto").maskMoney({
        decimal: ".",
        thousands: ","
    })

    $("#Fk_empleado").select2({
        theme:"bootstrap4"
    });

    $("#txt_concepto_nomina").select2({
        theme:"bootstrap4"
    });

    
</script>
@endpush