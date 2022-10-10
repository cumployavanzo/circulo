@extends('layouts.AdminLTE.index')
@section('title', 'Nomina')
@section('header', 'Nomina')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo Registro
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.nomina.store') }}" autocomplete="off">
            @csrf
            <div class="card-body">
                <input type="hidden" id="idNomina" name="idNomina" value="0">
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-8">                                               
                            <label for="Fk_empleado">Empleado:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <select type="select" id="Fk_empleado" name="Fk_empleado" class="form-control select2 " required onchange="allDetallesEmpleado();">
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
                            <label for="txt_modalidad">Modalidad:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span>
                                </div>
                                <select class="form-control" id="txt_modalidad" name="txt_modalidad" onchange="allDetallesEmpleado()">
                                    <option>SEMANAL</option>
                                    <option>QUINCENAL</option>
                                    <option>MENSUAL</option>
                                </select>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">   
                        <div class="col-lg-4">
                            <label for="fecha_inicial">Fecha Inicial:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="fecha_final">Fecha Final:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_final" name="fecha_final" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card-header"></div> <!-- /.card-header -->
                    <div class="card-body">
                            <div class="row">
                                <input type="hidden" id="sueldo" name="sueldo" value="0">
                                <div class="col-lg-12">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-user"></i>&nbsp;<span id="nameEmpleado"></span> <small class="float-right">Fecha Alta: <b id="fecha_alta">--/--/----</b></small></h5>
                                        <address>
                                            <strong id="puesto"></strong><br>
                                            Sueldo Diario: <b id="sueldo_diario" class="text-success"></b><br>
                                            <b id="sueldo_modalidad">Sueldo Semanal: </b><br>
                                            </address>
                                       
                                        </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">Concepto</label>
                                                <div class="col-lg-5">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
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
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="txt_monto">Monto</label>
                                                <div class="col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="txt_monto" name="txt_monto">
                                                    </div>
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
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Concepto</th>
                                    <th>Tipo</th>
                                    <th>Monto Persepción</th>
                                    <th>Monto Deducción</th>
                                    <th>Neto a Pagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SUELDO</td>
                                    <td>Persepción</td>
                                    <td id="salario">0.00</td>
                                    <td>-- --</td>
                                    <td>-- --</td>
                                </tr>
                            </tbody>
                        </table>
                       
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
                
                $('#puesto').html(data.puesto);
                $('#fecha_alta').html(data.personals.fecha_alta);
                $('#sueldo_diario').html('$'+' '+sueldo_diario.toFixed(2))
                $('#nameEmpleado').html(data.personals.nombre+' '+data.personals.apellido_materno+' '+data.personals.apellido_paterno);
                if(modalidad == 'SEMANAL'){
                    $('#sueldo_modalidad').html('Sueldo Semanal: '+' '+'$'+' '+(sueldo_diario * 7).toFixed(2))
                    $('#sueldo').val((sueldo_diario * 7))
                    $('#salario').html((sueldo_diario * 7))
                }else if(modalidad == 'QUINCENAL'){
                    $('#sueldo_modalidad').html('Sueldo Quincenal: '+' '+'$'+' '+(sueldo_diario * 15).toFixed(2))
                    $('#sueldo').val((sueldo_diario * 15))
                    $('#salario').html((sueldo_diario * 15))
                }else if(modalidad == 'MENSUAL'){
                    $('#sueldo_modalidad').html('Sueldo Mensual: '+' '+'$'+' '+(sueldo_diario * 30).toFixed(2))
                    $('#sueldo').val((sueldo_diario * 30))
                    $('#salario').html((sueldo_diario * 30))
                }

            }
        });
       
    }

    
</script>
@endpush