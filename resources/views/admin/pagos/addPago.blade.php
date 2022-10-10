@extends('layouts.AdminLTE.index')
@section('title', 'Pagos')
@section('header', 'Pagos')
@section('content')
<div class="col-md-12">
    <div class="card card-gray"> 
        <div class="card-header">
            <h4 class="card-title">
                Pagos
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.pago.store') }}" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                    <div class="col-12">
                        <h5>
                            @if ($gasto->concepto == 'RETIRO DE CAPITAL' || $gasto->concepto == 'VENTA DE ACCIONES')
                                <i class="fas fa-user"></i> {{$gasto->personals->getFullName()}}
                            @elseif ($gasto->concepto == 'NO APLICA' )    
                                <i class="fas fa-user"></i> {{$gasto->proveedor->nombre_proveedor}}
                            @endif
                            <small class="float-right">Fecha Compra: {{ \Carbon\Carbon::parse($gasto->fecha_compra)->format('d/m/Y')}}</small>
                        </h5>
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <address>
                        @if ($gasto->concepto == 'RETIRO DE CAPITAL' || $gasto->concepto == 'VENTA DE ACCIONES')
                            N° Factura: <strong>NA</strong><br>
                        @elseif ($gasto->concepto == 'NO APLICA' )    
                            N° Factura: <strong>{{$gasto->num_factura}}</strong><br>
                        @endif
                        Detalle compra: {{ $gasto->detalle_compra}}<br>
                        <b class="text-success">TOTAL: {{ $gasto->total}}</b>
                        </address>
                    </div>
                    </div>
                </div>
               
                    <input type="hidden" id="idGasto" name="idGasto" value="{{$gasto->id}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-start">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="txt_tipo_pago">Tipos de Pago</label>
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
                                    <label for="fecha_pago">Fecha de Pago</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="">
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
                
            </div>   
       
        <div class="card-footer">
            <input type="submit" class="btn btn-primary float-right" value="Pagar">
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