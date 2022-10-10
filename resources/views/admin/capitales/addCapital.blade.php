@extends('layouts.AdminLTE.index')
@section('title', 'Capital')
@section('header', 'Capital')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nueva solicitud
            </h4>
        </div>
        <form action="{{ route('admin.addSolicitudCapital') }}" method="POST" autocomplete="off"> 
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" id="idGasto" name="idGasto" value="0">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="fecha_compra">Fecha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_compra" name="fecha_compra" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
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
                                <select type="select" id="Fk_empleado" name="Fk_empleado" class="form-control select2 " required onchange="detallesEmpleado();">
                                    <option value="">Selecciona</option>
                                    @foreach($personals as $personal)
                                        <option {{ old('Fk_empleado') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
                                    @endforeach
                                </select>
                                @error('userType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="col-lg-4">
                            <label for="txt_puesto">Puesto:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span>
                                </div>
                                <input id="txt_puesto" class="form-control text-uppercase" type="text" name="txt_puesto" placeholder="Puesto" disabled>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-4">
                            <label for="txt_rfc">RFC:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ul"></i></span>
                                </div>
                                <input id="txt_rfc" class="form-control text-uppercase" type="text" name="txt_rfc" placeholder="RFC" disabled>
                            </div>
                        </div>    
                        <div class="col-lg-4">
                            <label for="txt_curp">CURP:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                </div>
                                <input id="txt_curp" class="form-control text-uppercase" type="text" name="txt_curp" placeholder="CURP" disabled>
                            </div>
                        </div>   
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="txt_concepto">Concepto</label>
                                <select class="form-control" id="txt_concepto" name="txt_concepto" required>
                                    <option>SELECCIONA</option>
                                    <option>APORTACIONES DE CAPITAL</option>
                                    <option>RETIRO DE CAPITAL</option>
                                    <option>VENTA DE ACCIONES</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-12">
                            <label for="detalle_compra">Detalle:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                                </div>
                                <textarea class="form-control text-uppercase" id="detalle_compra" name="detalle_compra" placeholder="Detalle de Compra"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card-header"></div> <!-- /.card-header -->
                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">N° Acciones</label>
                                                <div class="col-lg-3">
                                                    <input id="cantidades" class="form-control text-uppercase"  name="cantidades"  placeholder="N° Acciones" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">Valor de la Acción</label>
                                                <div class="col-lg-5">
                                                    <input id="costo_unitario" class="form-control text-uppercase"  name="costo_unitario"  placeholder="Valor de la Acción" required="">
                                                </div>
                                            </div>
                                            <hr class="m-6">
                                            <button type="submit" class="btn btn-block btn-info">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                    </div>
                </div>
            </div><!-- /.card-body -->                                       
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

    

    $("#Fk_proveedor").select2({
        theme:"bootstrap4"
    });

    $("#Fk_empleado").select2({
        theme:"bootstrap4"
    });

    $("#Fk_articulo").select2({
        theme:"bootstrap4"
    });

    $("#costo_unitario").maskMoney({
        decimal: ".",
        thousands: ",",
        precision: 4
    });

    function detallesEmpleado(){
        id = document.getElementById("Fk_empleado").value;
        $.ajax({
            url: 'detallesPersonals/' + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data)
                $('#txt_puesto').val(data.puesto);
                $('#txt_rfc').val(data.personals.rfc);
                $('#txt_curp').val(data.personals.curp);
            }
        });
       
    }

    
</script>
@endpush