@extends('layouts.AdminLTE.index')
@section('title', 'Bono')
@section('header', 'Bono')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo Registro
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.bono.store') }}" autocomplete="off">
            @csrf
            <div class="card-body">
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
                <div class="form-group">
                    <div class="row">   
                        <div class="col-lg-4">
                            <label for="fecha_inicial">Fecha Inicial de la semana:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-block btn-info">Agregar</button> --}}
                <hr class="m-6">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Empleado</th>
                                    <th>Puesto</th>
                                    <th>Fecha Ingreso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div><!-- /.card-body -->                                       
            <div class="card-footer">
                <div class="col-12">
                    <a type="button" href="{{ route('admin.bono.index') }}" class="btn btn-danger float-right">Cerrar</a>
                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Guardar</button>
                </div>
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

    $('#txt_periodo_pago').daterangepicker();
    

    function allDetallesEmpleado(){
        let id = document.getElementById("Fk_empleado").value;
        let modalidad = document.getElementById("txt_modalidad").value;
        $.ajax({
            url: 'allDetallesPersonals/' + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data)
                let sueldo_diario = data.personals.sueldo_mensual/30;
            //    alert(sueldo_diario);
                if(modalidad == 'SEMANAL'){
                    $('#sueldo').val((sueldo_diario * 7))
                }else if(modalidad == 'QUINCENAL'){
                    $('#sueldo').val((sueldo_diario * 15))
                }else if(modalidad == 'MENSUAL'){
                    $('#sueldo').val((sueldo_diario * 30))
                }

            }
        });
       
    }

    
</script>
@endpush