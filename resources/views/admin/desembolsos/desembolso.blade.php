@extends('layouts.AdminLTE.index')
@section('title', 'Desembolso')
@section('header', 'Desembolso')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('mensaje')}}
            </div>  
        @endif  
        <div class="card-header">
            <h4 class="card-title">
                Desembolso
            </h4>
        </div>
        <form method="POST" action="{{action('DesembolsoController@store', $credito->id)}}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-address-card"></i> {{$credito->solicitud->cliente->getFullname()}}
                      <small class="float-right">Fecha Solicitud: {{ \Carbon\Carbon::parse($credito->solicitud->fecha_solicitud)->format('d/m/Y')}}</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    <address>
                      <strong>{{$credito->solicitud->cliente->ciudad_nacimiento}}</strong><br>
                      {{ $credito->solicitud->cliente->colonia}}, {{ $credito->solicitud->cliente->estado}}<br>
                      Telefono: {{ $credito->solicitud->cliente->celular}}<br>
                      Dirección: {{ $credito->solicitud->cliente->direccion}}<br>
                      Codigo Postal : {{ $credito->solicitud->cliente->cp}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <address>
                        Asociado: {{$credito->solicitud->asociado->getFullname()}}<br>
                        Operador: {{$credito->solicitud->asociado->operadores->getFullname()}}<br>
                        Producto: <b>{{ $credito->solicitud->producto->nombre}}</b><br>
                        Tasa: <b>{{ $credito->solicitud->tasa}} %</b><br>
                        Plazo: <b>{{ $credito->solicitud->plazo}}</b>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <input type="hidden" id="idAnalisisCred" name="idAnalisisCred" value="{{$credito->id}}">
                    <input type="hidden" id="txt_idSolicitud" name="txt_idSolicitud" value="{{$credito->solicitud->id}}">
                    <input type="hidden" id="txt_cuota" name="txt_cuota" value="{{$credito->solicitud->cuota}}">
                    <input type="hidden" id="txt_plazo" name="txt_cuota" value="{{$credito->solicitud->plazo}}">
                    <input type="hidden" id="txt_frecuencia_pago" name="txt_frecuencia_pago" value="{{$credito->solicitud->frecuencia_pago}}">
                    <input type="hidden" id="txt_tasa" name="txt_tasa" value="{{$credito->solicitud->tasa}}">
                    <input type="hidden" id="txt_fdesembolso" name="txt_fdesembolso" value="{{$credito->solicitud->fecha_desembolso}}">
                    <input type="hidden" id="txt_monto_autorizado" name="txt_monto_autorizado" value="{{$credito->monto_autorizado}}">

                    <b>Monto Autorizado: {{ number_format($credito->monto_autorizado,2,'.',',') }}</b><br>
                    <b>Fecha Desembolso: {{ \Carbon\Carbon::parse($credito->solicitud->fecha_desembolso)->format('d/m/Y')}}</b>
                  </div>
                  
                </div>
                <br>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12">
                      <div class="d-flex justify-content-start">
                          <div class="col-sm-5">
                              <div class="form-group">
                                  <label for="txt_tipo_pago">Tipos de Desembolso</label>
                                  <select class="form-control" id="txt_tipo_pago" name="txt_tipo_pago" onchange="cuentaTipoPago()">
                                      <option>-- Selecciona --</option>
                                      <option value="Transferencia">Transferencia</option>
                                      <option value="Efectivo">Efectivo</option>
                                      <option value="Cheque">Cheque</option>
                                      <option value="Especie">Especie</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <label for="fecha_pago">Fecha de Desembolso</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" required>
                              </div>
                          </div>
                      </div>
                      <div id="cuentaTransferencia" style="display: none">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="txt_cuenta_transferencia" class="">Cuenta Transferencia</label>
                                  <select type="select" id="txt_cuenta_transferencia" name="txt_cuenta_transferencia" class="form-control select2 ">
                                      <option value="">Selecciona</option>
                                      @foreach($bancos as $banco)
                                          <option {{ old('txt_cuenta_transferencia') == $banco->id ? 'selected' : '' }} value="{{$banco->id}}">{{$banco->nombre_cuenta}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div id="cuentaEfectivo" style="display: none">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="txt_cuenta_efectivo" class="">Cuenta Efectivo</label>
                                  <select type="select" id="txt_cuenta_efectivo" name="txt_cuenta_efectivo" class="form-control select2 ">
                                      <option value="">Selecciona</option>
                                      @foreach($cuentasCaja as $cuentaC)
                                          <option {{ old('txt_cuenta_efectivo') == $cuentaC->id ? 'selected' : '' }} value="{{$cuentaC->cuentas_id}}">{{$cuentaC->nombre_caja}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div id="cuentaCheque" style="display: none">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="txt_cuenta_cheque" class="">Cuenta Cheque</label>
                                  <select type="select" id="txt_cuenta_cheque" name="txt_cuenta_cheque" class="form-control select2 ">
                                      <option value="">Selecciona</option>
                                      @foreach($bancos as $banco)
                                          <option {{ old('txt_cuenta_cheque') == $banco->id ? 'selected' : '' }} value="{{$banco->id}}">{{$banco->nombre_cuenta}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div id="cuentaEspecie" style="display: none">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="txt_cuenta_especie" class="">Cuenta Especie</label>
                                  <select type="select" id="txt_cuenta_especie" name="txt_cuenta_especie" class="form-control select2 ">
                                      <option value="">Selecciona</option>
                                      @foreach($cuentaActivo as $cuentaAct)
                                          <option {{ old('txt_cuenta_especie') == $cuentaAct->id ? 'selected' : '' }} value="{{$cuentaAct->cuentas_id}}">{{$cuentaAct->cuentas->nombre_cuenta}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <label for="concepto">Concepto</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                              </div>
                              <textarea class="form-control text-uppercase" id="concepto" name="concepto" placeholder="Concepto.."></textarea>
                          </div>     
                      </div>                   
                  </div>
                </div> 
                <div class="row">
                  <div class="col-12 table-responsive">
                    <p class="lead text-center"><b>Tabla de Amortización</b></p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha de Pago</th>
                                <th>Pago</th>
                                <th>Capital</th>
                                <th>Interes</th>
                                <th>Saldo Pendiente</th>
                                <th>Gasto por cobranza</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAmortizacion">
                        </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>   
                   
        <div class="card-footer">
            <div class="col-12">
                <a type="button" href="javascript:history.back()" class="btn btn-danger float-right">Cancelar</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Desembolsar</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>

calcularTablaAmortizacionRiesgo();

  function calcularTablaAmortizacionRiesgo(){
    
    let cuota = document.getElementById("txt_cuota").value;
    let plazo = document.getElementById("txt_plazo").value;
    let tasa = document.getElementById("txt_tasa").value;
    let frecuencia_pago = document.getElementById("txt_frecuencia_pago").value;
    let monto_autorizado = document.getElementById("txt_monto_autorizado").value;
    let fecha_desembolso = document.getElementById("txt_fdesembolso").value;
    // csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        // url: '/admin/analisis_credito/detalleTablaAmortizacion',
        url: "{{ asset('admin/analisis_credito/detalleTablaAmortizacion') }}",

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            // _token: csrfc,
            monto_autorizado : monto_autorizado,
            fecha_desembolso : fecha_desembolso,
            cuota : cuota,
            plazo : plazo,
            tasa : tasa
        },
        
        success:function(data){
            console.log(data);
            vistaTablaAmortizacion(data);
        }
    });

    function vistaTablaAmortizacion(tabla) {
      let html = '';
      tabla.forEach(fila =>  {
          
          html += '<tr><td>'+fila.mes+'</td><td>'+moment(fila.fecha_pago).utc().format('DD/MM/YYYY')+'</td><td>'+fila.cuota+'</td><td>'+fila.capital+'</td><td>'+fila.interes+'</td><td class="text-center">'+fila.saldo+'</td><td>'+fila.gasto_por_cobranza+'</td></tr>'
      })
      $("#tablaAmortizacion").html(html);
    }
  }

  function cuentaTipoPago() {
        if($("#txt_tipo_pago").val() == "Transferencia"){
            $("#cuentaTransferencia").slideDown('slow');
            $("#cuentaEfectivo").hide(1000);
            $("#cuentaCheque").hide(1000);
            $("#cuentaEspecie").hide(1000);
        }else if($("#txt_tipo_pago").val() == "Efectivo"){
            $("#cuentaEfectivo").slideDown('slow');
            $("#cuentaTransferencia").hide(1000);
            $("#cuentaCheque").hide(1000);
            $("#cuentaEspecie").hide(1000);
        }else if($("#txt_tipo_pago").val() == "Cheque"){
            $("#cuentaCheque").slideDown('slow');
            $("#cuentaEfectivo").hide(1000);
            $("#cuentaTransferencia").hide(1000);
            $("#cuentaEspecie").hide(1000);
        }else if($("#txt_tipo_pago").val() == "Especie"){
            $("#cuentaEspecie").slideDown('slow');
            $("#cuentaTransferencia").hide(1000);
            $("#cuentaEfectivo").hide(1000); 
            $("#cuentaCheque").hide(1000);
        }else{
            $("#cuentaTransferencia").hide(1000);
            $("#cuentaEfectivo").hide(1000); 
            $("#cuentaCheque").hide(1000);
            $("#cuentaEspecie").hide(1000);

        }
    }

</script>




@endpush