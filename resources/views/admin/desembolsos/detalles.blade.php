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
                    <input type="hidden" id="txt_idSolicitud" name="txt_idSolicitud" value="{{$credito->solicitud->id}}">
                    <input type="hidden" id="txt_cuota" name="txt_cuota" value="{{$credito->solicitud->cuota}}">
                    <input type="hidden" id="txt_plazo" name="txt_cuota" value="{{$credito->solicitud->plazo}}">
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
                                    <label for="txt_tipo_pago">Tipos de Pago</label>
                                    <select class="form-control" id="txt_tipo_pago" name="txt_tipo_pago" onchange="cuentaTipoPago()" disabled>
                                        <option>-- Selecciona --</option>
                                        <option {{ $detalle->tipo_pago == 'Transferencia' ? 'selected' : ''}} value="Transferencia">Transferencia</option>
                                        <option {{ $detalle->tipo_pago == 'Efectivo' ? 'selected' : ''}} value="Efectivo">Efectivo</option>
                                        <option {{ $detalle->tipo_pago == 'Cheque' ? 'selected' : ''}} value="Cheque">Cheque</option>
                                        <option {{ $detalle->tipo_pago == 'Especie' ? 'selected' : ''}} value="Especie">Especie</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="fecha_pago">Fecha de Pago</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d', strtotime($detalle['fecha_pago'])) }}" readonly>
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
                                            <option {{ old('txt_cuenta_transferencia') == $banco->id ? 'selected' : '' }} value="{{$banco->cuentas_id}}">{{$banco->cuenta->nombre_cuenta}}</option>
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
                                            <option {{ old('txt_cuenta_cheque') == $banco->id ? 'selected' : '' }} value="{{$banco->cuentas_id}}">{{$banco->cuenta->nombre_cuenta}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="cuentaEspecie" style="display: none">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="txt_cuenta_especie" class="">Cuenta Especie</label>
                                </div>
                            </div>
                        </div>  
                        <div class="col-sm-4">
                            <label for="concepto">Concepto</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                                </div>
                                <textarea class="form-control text-uppercase" id="concepto" name="concepto" placeholder="Concepto.." readonly>{{$detalle->observaciones}}</textarea>
                            </div>     
                        </div>
                    </div>
                </div> 
                @if (!empty($detalle))
                <hr>
                
                <div class="row">
                    <div class="col-12 table-responsive">
                        <p class="lead text-center"><b>Contabilidad</b></p>
                        <table class="table">  
                            <thead>
                                <tr>
                                    <th style="width:15%">Cuenta</th>
                                    <th style="width:40%">Nombre de cuenta</th>
                                    <th style="width:10%">Debe</th>
                                    <th style="width:10%">Haber</th>
                                    <th style="width:10%">N° Analisis</th>
                                </tr>
                            </thead>  
                                <tr>
                                    <td style="width:15%">{{$cuentaCliente->numero_cuenta}}</td>
                                    <td style="width:40%">{{$cuentaCliente->nombre_cuenta}}</td>
                                    <td style="width:10%">{{$credito->monto_autorizado}}</td>
                                    <td style="width:15%"></td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>
                                <tr>
                                    <td style="width:15%">{{ $cuentaTipoPago->numero_cuenta }}</td>
                                    <td style="width:40%">{{ $cuentaTipoPago->nombre_cuenta }}</td>
                                    <td style="width:10%"></td>
                                    <td style="width:15%">{{$credito->monto_autorizado}}</td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>     
                                @php
                                    $porcentaje = $producto->tasa * (1/100);
                                    $interes = ($credito->monto_autorizado * $porcentaje) / $producto->plazo;
                                    $interesOrdinario = $interes * $producto->plazo
                                @endphp
                                <tr>
                                    <td style="width:15%">800-400-100-000</td>
                                    <td style="width:40%">INTERESES ORDINARIOS CONSUMO</td>
                                    <td style="width:10%">{{number_format($interesOrdinario, 2)}}</td>
                                    <td style="width:15%"></td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>     
                               
                                <tr>
                                    <td style="width:15%">900-400-100-000</td>
                                    <td style="width:40%">INTERESES ORDINARIOS CONSUMO</td>
                                    <td style="width:10%"></td>
                                    <td style="width:15%">{{number_format($interesOrdinario, 2)}}</td>
                                    <td style="width:10%">{{ $credito->id}}</td>
                                </tr>     
                        </table>
                    </div>
                </div>   
            @endif
                <!-- /.row -->
            </div>
        </div>   
                   
        <div class="card-footer">
            <a type="button" href="{{ route('admin.desembolso.index') }}" class="btn btn-primary float-right">Salir</a>
        </div>
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