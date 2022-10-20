@extends('layouts.AdminLTE.index')
@section('title', 'Nomina')
@section('header', 'Nomina')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Lista Nomina
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.nomina.store') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            @if ($nomina->state == 'Proceso')
            <input type="hidden" id="idNomina" name="idNomina" value="{{$nomina->id}}">
            <input type="hidden" id="sueldo" name="sueldo" value="">
            <input type="hidden" id="modalidad" name="modalidad" value="{{$nomina->modalidad}}">
            <div class="form-group">
                <div class="row">   
                    <div class="col-lg-4">
                        <label for="fecha_inicial">Fecha Inicial:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d', strtotime($nomina['fecha_corte_ini'])) }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="fecha_final">Fecha Final:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" id="fecha_final" name="fecha_final" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d', strtotime($nomina['fecha_corte_fin'])) }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <label for="num_nomina">N° de Nomina:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-slack-hash"></i></span>
                        </div>
                        <input id="num_nomina" class="form-control text-uppercase" type="text" name="num_nomina" placeholder="N° de Nomina" required="" maxlength="20" value="{{$nomina->num_nomina}}" readonly>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <label for="txt_modalidad">Modalidad:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span>
                        </div>
                        <select class="form-control disabled" id="txt_modalidad" name="txt_modalidad" readonly="">
                            <option {{ $nomina->modalidad == 'SEMANAL' ? 'selected' : ''}} value="SEMANAL">SEMANAL</option>
                            <option {{ $nomina->modalidad == 'QUINCENAL' ? 'selected' : ''}} value="QUINCENAL">QUINCENAL</option>
                            <option {{ $nomina->modalidad == 'MENSUAL' ? 'selected' : ''}} value="MENSUAL">MENSUAL</option>

                        </select>
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
                            <select type="select" id="Fk_empleado" name="Fk_empleado" class="form-control select2 ">
                                <option value="">Selecciona</option>
                                @foreach($personals as $personal)
                                    <option {{ old('Fk_empleado') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                </div>
                <br>
                @if (\Session::has('errorMessage'))   
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {!! \Session::get('errorMessage') !!}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-block btn-info">Agregar</button>
        </form> 
            <hr class="m-6">
            @endif
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Curp</th>
                                <th>Neto a Pagar</th>
                                <th>N° de Nomina</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($detalleNomina as $detalle)
                                <tr>
                                    <td>{{$detalle->personals->getFullName()}}</td>
                                    <td>{{$detalle->personals->curp}}</td>
                                    <td>{{number_format($detalle->neto_pagar, 2, '.', '')}}</td>
                                    <td>{{$detalle->nomina_id}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a class="btn btn-info btn-sm" href="{{route('admin.movNomina.create',["idDetalle" => $detalle->id])}}"><li class="fas fa-plus"></li></a>
                                            @if ($nomina->state == 'Proceso')
                                                <form action="{{ route('admin.deleteEmpleadoNom', ['idNomina'=>$detalle->nomina_id, 'idDetalle'=>$detalle->id]) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-times"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div><!-- /.card-body --> 
            
        <div class="card-footer">
            <div class="form-group float-right">
                <div class="d-flex">
                    <a href="{{ route('admin.nomina.index') }}" class="btn btn-outline-info btn-sm" title="Regresar">
                        <i class="fas fa-arrow-left"></i>
                    &nbsp; Regresar
                    </a> &nbsp;
                    @if ($nomina->state == 'Proceso')
                        <form action="{{ route('admin.updateNomina', [$nomina->id]) }}" method="POST">
                            {{-- @method('PUT') --}}
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm " title="Autorizar"><i class="fas fa-forward"></i>&nbsp;Autorizar</button>
                        </form>
                    @endif
                </div>
           </div>
       </div>               
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

    function allDetallesEmpleado(){
        let id = document.getElementById("Fk_empleado").value;
        let modalidad = document.getElementById("txt_modalidad").value;
        $.ajax({
            url: "{{ asset('admin/nomina/allDetallesPersonals') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data)
                let sueldo_diario = data.personals.sueldo_mensual/30;
               
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