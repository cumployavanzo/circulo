@extends('layouts.AdminLTE.index')
@section('title', 'Vencimientos')
@section('header', 'Vencimientos')
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
                Vencimientos
            </h4>
        </div>
        <form method="POST" action="{{action('VencimientoController@store', $vencimiento->id)}}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-address-card"></i> {{$vencimiento->analisisC->solicitud->cliente->getFullname()}}
                      <small class="float-right">Fecha Solicitud: {{ \Carbon\Carbon::parse($vencimiento->analisisC->solicitud->fecha_solicitud)->format('d/m/Y')}}</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    <address>
                      <strong>{{$vencimiento->analisisC->solicitud->cliente->ciudad_nacimiento}}</strong><br>
                      {{ $vencimiento->analisisC->solicitud->cliente->colonia}}, {{ $vencimiento->analisisC->solicitud->cliente->estado}}<br>
                      Telefono: {{ $vencimiento->analisisC->solicitud->cliente->celular}}<br>
                      Dirección: {{ $vencimiento->analisisC->solicitud->cliente->direccion}}<br>
                      Codigo Postal : {{ $vencimiento->analisisC->solicitud->cliente->cp}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <address>
                        Asociado: {{$vencimiento->analisisC->solicitud->asociado->getFullname()}}<br>
                        Operador: {{$vencimiento->analisisC->solicitud->asociado->operadores->getFullname()}}<br>
                        Producto: <b>{{ $vencimiento->analisisC->solicitud->producto->nombre}}</b><br>
                        Tasa: <b>{{ $vencimiento->analisisC->solicitud->tasa}} %</b><br>
                        Plazo: <b>{{ $vencimiento->analisisC->solicitud->plazo}}</b>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <input type="hidden" id="idAmortizacion" name="idAmortizacion" value="{{$vencimiento->id}}">
                    {{-- <input type="hidden" id="txt_idSolicitud" name="txt_idSolicitud" value="{{$credito->solicitud->id}}">
                    <input type="hidden" id="txt_cuota" name="txt_cuota" value="{{$credito->solicitud->cuota}}">
                    <input type="hidden" id="txt_plazo" name="txt_cuota" value="{{$credito->solicitud->plazo}}">
                    <input type="hidden" id="txt_frecuencia_pago" name="txt_frecuencia_pago" value="{{$credito->solicitud->frecuencia_pago}}">
                    <input type="hidden" id="txt_tasa" name="txt_tasa" value="{{$credito->solicitud->tasa}}">
                    <input type="hidden" id="txt_fdesembolso" name="txt_fdesembolso" value="{{$credito->solicitud->fecha_desembolso}}">
                    <input type="hidden" id="txt_monto_autorizado" name="txt_monto_autorizado" value="{{$credito->monto_autorizado}}"> --}}

                    <b>Monto Autorizado: {{ number_format($vencimiento->analisisC->monto_autorizado,2,'.',',') }}</b><br>
                    <b>Fecha Desembolso: {{ \Carbon\Carbon::parse($vencimiento->analisisC->solicitud->fecha_desembolso)->format('d/m/Y')}}</b><br>
                    <b class="text-success">Fecha Pago: {{ \Carbon\Carbon::parse($vencimiento->fecha_pago)->format('d/m/Y')}}</b><br>
                    <b class="text-success">Monto Pago: {{ number_format($vencimiento->pago,2,'.',',') }}</b><br>
                    <b>Capital: {{ number_format($vencimiento->capital,2,'.',',') }}</b><br>
                    <b>Interes: {{ number_format($vencimiento->interes,2,'.',',') }}</b><br>

                  </div>
                  
                </div>
                <br>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12">
                      <div class="d-flex justify-content-start">
                          <div class="col-sm-5">
                              <div class="form-group">
                                  <label for="txt_tipo_pago">Tipos de Cobro</label>
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
                              <label for="fecha_pago">Fecha de Cobro</label>
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
                                          <option {{ old('txt_cuenta_efectivo') == $cuentaC->id ? 'selected' : '' }} value="{{$cuentaC->cuentas_id}}">{{$cuentaC->cuenta->nombre_cuenta}}</option>
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
                <!-- /.row -->
            </div>
        </div>   
                   
        <div class="card-footer">
            <div class="col-12">
                <a type="button" href="javascript:history.back()" class="btn btn-danger float-right">Cancelar</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">Guardar</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>

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