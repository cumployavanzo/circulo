@extends('layouts.AdminLTE.index')
@section('title', 'Detalle Bonos')
@section('header', 'Detalle Bonos')
@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Datos</h3>
            </div>
            <div class="card-body">
                <strong><i class="fas fa-user mr-1"></i>&nbsp;&nbsp;{{$bonos->personals->getFullName()}}</strong>
                <p class="text-muted">{{$bonos->personals->puestoid->puesto}}</p>
                <hr>
                <strong><i class="fas fa-percent mr-1"></i>&nbsp;&nbsp;Total Cobrado:</strong>
                <p class="text-muted"><b class="text-success">{{$bonos->tot_porcent_cobrado}} %</b></p>
                <hr>
                <strong><i class="fas fa-percent mr-1"></i>&nbsp;&nbsp;Total Recuperado: </strong>
                <p class="text-muted"><b>{{$bonos->tot_porcent_recuperado}} %</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Detalles de la semana
                </h5>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Fecha</th>
                                        <th>Ruta</th>
                                        <th>Cuentas</th>
                                        <th>% Cobrado</th>
                                        <th>Montos</th>
                                        <th>% Recuperado</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @foreach($detalles as $detalle)
                                    @php
                                       
                                        if($detalle->ruta){
                                            $ruta = $detalle->ruta->nombre_ruta;
                                        }else{
                                            $ruta = '';
                                        }

                                        if($detalle->porcentaje_cobrado){
                                            $porcentCobrado = $detalle->porcentaje_cobrado;
                                        }else{
                                            $porcentCobrado = '';
                                        }

                                        if($detalle->porcentaje_recuperado){
                                            $porcentRecuperado = $detalle->porcentaje_recuperado;
                                        }else{
                                            $porcentRecuperado = '';
                                        }
                                        
                                    @endphp
                                    <tr>
                                        <td><b>{{$detalle->dia}}</b></td>
                                        <td>{{ date('d/m/Y', strtotime($detalle->fecha))}}</td>
                                        <td>{{$ruta}}</td>
                                        <td><small>Asignada: <br><b class="text-blue">{{$detalle->cuentas_asignadas}}</b></small><br><small>Cobrada: <br><b class="text-success">{{$detalle->cuentas_cobradas}}</b></small></td>
                                        <td>{{ $porcentCobrado}} %</td>
                                        <td><small>Recuperar: <br><b class="text-blue">{{$detalle->monto_a_recuperar}}</b></small><br><small>Recuperado: <br><b class="text-success">{{$detalle->monto_recuperado}}</b></small></td>
                                        <td>{{$porcentRecuperado}} %</td>
                                        <td>
                                            {{-- <a class="btn btn-info btn-sm" href="{{route('admin.movNomina.create',["idDetalle" => $detalle->id])}}"><li class="fas fa-plus"></li></a> --}}
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#mymodalDetalleB" title="Detalles" onclick="cargarIdDetalle('{{ $detalle->id }}')"><li class="fas fa-plus"></li></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="float-right">{{ $detalles->links()}}</div> --}}
                        </div> 
                    </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
                <div class="col-12">
                    <a type="button" href="{{ route('admin.bono.index') }}" class="btn btn-danger float-right">Cerrar</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="mymodalDetalleB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.detalleBono.store') }}" autocomplete="off" id="f_detalle" name="f_detalle">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel" style="color: #FFFFFF;"><strong>DETALLES</strong></h5>
                    <button type="button" style="color: #FFFFFF;" class="close" data-dismiss="modal"  onclick="limpiaForm(f_detalle)"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idBono" name="idBono" value="0">
                    <input type="hidden" id="idDetalleBono" name="idDetalleBono" value="0">
                    <div class="row" id="encabezado">
                        <div class="col-lg-12 connectedSortable">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <b class="float-left"><h4 id="name_dia"></h4></b><span class="float-right" id="Fecha"></span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-start">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="txt_ruta" class="">Ruta</label>
                                                <select type="select" id="txt_ruta" name="txt_ruta" class="form-control select2 " required>
                                                    <option value="">Selecciona</option>
                                                    @foreach($rutas as $ruta)
                                                        <option {{ old('txt_ruta') == $ruta->id ? 'selected' : '' }} value="{{$ruta->id}}">{{$ruta->nombre_ruta}}</option>
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
                                    <div class="d-flex justify-content-start">
                                        <div class="col-lg-5">
                                            <label for="txt_cuentas_asignadas">Cuentas Asignadas:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-check-alt"></i></span>
                                                </div>
                                                <input id="txt_cuentas_asignadas" class="form-control text-uppercase" type="text" name="txt_cuentas_asignadas" placeholder="Cuentas Asignadas">
                                            </div>
                                        </div>  
                                        <div class="col-lg-5">
                                            <label for="txt_cuentas_cobradas">Cuentas Cobradas:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-hand-holding-usd"></i></span>
                                                </div>
                                                <input id="txt_cuentas_cobradas" class="form-control text-uppercase" type="text" name="txt_cuentas_cobradas" placeholder="Cuentas Cobradas">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="col-lg-5">
                                            <label for="txt_monto_recuperar">Monto a Recuperar:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <input id="txt_monto_recuperar" class="form-control text-uppercase" type="text" name="txt_monto_recuperar" placeholder="0.00">
                                            </div>
                                        </div>  
                                        <div class="col-lg-5">
                                            <label for="txt_monto_recuperado">Monto Recuperado:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file-invoice-dollar"></i></span>
                                                </div>
                                                <input id="txt_monto_recuperado" class="form-control text-uppercase" type="text" name="txt_monto_recuperado" placeholder="0.00">
                                            </div>
                                        </div>  
                                    </div>
                                    
                                    
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm" title="Guardar Registro">
                        <i class="fas fa-paper-plane"></i> 
                        &nbsp;Guardar
                    </button>
                    <button class="btn btn-danger btn-sm" title="Cancelar" data-dismiss="modal" aria-label="Close" onclick="limpiaForm(f_nomina)">
                        <i class="fas fa-ban"></i>
                        &nbsp; Cancelar
                    </button>
                </div>
            </form>    
          </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
   function cargarIdDetalle(id){
        $.ajax({
            url: "{{ asset('admin/detalleBono/verDetalleBono') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
               console.log(data);
                $('#idBono').val(data.detalles.bonos_id);
                $('#idDetalleBono').val(data.detalles.id);
                $('#txt_cuentas_asignadas').val(data.detalles.cuentas_asignadas);
                $('#txt_cuentas_cobradas').val(data.detalles.cuentas_cobradas);
                $('#txt_monto_recuperar').val(data.detalles.monto_a_recuperar);
                $('#txt_monto_recuperado').val(data.detalles.monto_recuperado);
                $('#txt_ruta').val(data.detalles.sucursales_id).trigger('change.select2');
                $('#name_dia').html(data.detalles.dia);
                $('#Fecha').html(moment(data.detalles.fecha).utc().format('DD/MM/YYYY'));
            }
        });
    }

    $("#txt_monto_recuperar").maskMoney({
        decimal: ".",
        thousands: ",",
    });

    $("#txt_monto_recuperado").maskMoney({
        decimal: ".",
        thousands: ",",
    });

    $("#txt_ruta").select2({
        theme:"bootstrap4"
    });
</script>
@endpush