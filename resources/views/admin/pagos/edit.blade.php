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
                <form method="POST" action="{{ route('admin.pago.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" id="idGasto" name="idGasto" value="{{$gasto->id}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-start">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="txt_tipo_pago">Tipos de Pago</label>
                                        <select class="form-control" id="txt_tipo_pago" name="txt_tipo_pago" onchange="cuentaTipoPago()" disabled>
                                            <option>-- Selecciona --</option>
                                            <option {{ $pago->tipo_pago == 'Transferencia' ? 'selected' : ''}} value="Transferencia">Transferencia</option>
                                            <option {{ $pago->tipo_pago == 'Efectivo' ? 'selected' : ''}} value="Efectivo">Efectivo</option>
                                            <option {{ $pago->tipo_pago == 'Cheque' ? 'selected' : ''}} value="Cheque">Cheque</option>
                                            <option {{ $pago->tipo_pago == 'Especie' ? 'selected' : ''}} value="Especie">Especie</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="fecha_pago">Fecha de Pago</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d', strtotime($pago['fecha_pago'])) }}" readonly>
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
                                    <textarea class="form-control text-uppercase" id="concepto" name="concepto" placeholder="Concepto.." readonly>{{$pago->observaciones}}</textarea>
                                </div>     
                            </div>
                        </div>
                    </div> 
                </form> 
                @if (!empty($pago) && !empty($gastoProducto))
                    <hr>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <p class="lead text-center"><b>Contabilidad</b></p>
                            <table class="table">
                               
                                @if ($gasto->concepto == 'NO APLICA')
                                    <thead>
                                        <tr>
                                            <th style="width:15%">Cuenta</th>
                                            <th style="width:40%">Nombre de cuenta</th>
                                            <th style="width:10%">Debe</th>
                                            <th style="width:10%">Haber</th>
                                            <th style="width:15%">Factura</th>
                                            <th style="width:10%">N° Pago</th>
                                        </tr>
                                    </thead>  
                                    <tr> {{-- CUENTA DEL PROVEEDOR --}}
                                        <td style="width:15%">{{ $gasto->proveedor->cuentas->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $gasto->proveedor->cuentas->nombre_cuenta }}</td>
                                        <td style="width:10%">{{ $gasto->total }}</td> 
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $pago->id}}</td>
                                    </tr>
                                    <tr> {{-- CUENTA DEL TIPO PAGO --}}
                                        <td style="width:15%">{{ $pago->cuentas->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $pago->cuentas->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{ $gasto->total }}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $pago->id}}</td>
                                    </tr>
                                    @php
                                        $totalI = 0;
                                        $totalIva = 0;
                                    @endphp
                                    @foreach($gastoProducto as $producto)
                                        <tr> {{-- CUENTA DEL IVA ACREDITABLE PENDIENTE --}}
                                            <td style="width:15%">{{ $producto->articulo->cuentasIva->numero_cuenta }}</td>
                                            <td style="width:40%">{{ $producto->articulo->cuentasIva->nombre_cuenta }}</td>
                                            <td style="width:10%">{{number_format($producto->p_iva, 4, '.', '')}}</td>
                                            <td style="width:10%"></td>
                                            <td style="width:15%">{{ $gasto->num_factura}}</td>
                                            <td style="width:10%">{{ $pago->id}}</td>
                                        </tr>
                                        <tr>  {{-- CUENTA DEL IVA ACREDITABLE PAGADO --}}
                                            <td style="width:15%">{{ $cuentaIvaPagado->numero_cuenta }}</td>
                                            <td style="width:40%">{{ $cuentaIvaPagado->nombre_cuenta }}</td>
                                            <td style="width:10%"></td>
                                            <td style="width:10%">{{number_format($producto->p_iva, 4, '.', '')}}</td>
                                            <td style="width:15%">{{ $gasto->num_factura}}</td>
                                            <td style="width:10%">{{ $pago->id}}</td>
                                        </tr>
                                        @php
                                            $totalI += $producto->total;
                                        
                                            $totalIva += $producto->p_iva;
                                            $sumaIgualDebe = $totalI + $totalIva;
                                            $sumasIguales = $totalI + $totalIva;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td style="width:15%"></td>
                                        <td style="width:40%">Sumas Iguales</td>
                                        <td style="width:10%">{{number_format($sumaIgualDebe, 4, '.', '')}}</td>
                                        <td style="width:10%">{{number_format($sumasIguales, 4, '.', '')}}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $pago->id}}</td>
                                    </tr>
                                @elseif($gasto->concepto == 'RETIRO DE CAPITAL' || $gasto->concepto == 'VENTA DE ACCIONES')
                                <thead>
                                    <tr>
                                        <th style="width:15%">Cuenta</th>
                                        <th style="width:40%">Nombre de cuenta</th>
                                        <th style="width:10%">Debe</th>
                                        <th style="width:10%">Haber</th>
                                        <th style="width:10%">N° Pago</th>
                                    </tr>
                                </thead>  
                                    
                                    <tr>
                                        <td style="width:15%">100-600-100-005</td>
                                        <td style="width:40%">SOCIOS, ACCIONISTAS O REPRESENTANTE LEGAL</td>
                                        <td style="width:10%">{{$gasto->total}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $cuentaTipoPago->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $cuentaTipoPago->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{$gasto->total}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    
                               @endif
                                
                            </table>
                        
                        </div>
                    </div>   
                @endif
            </div>   
       
        <div class="card-footer">
            <a type="button" href="{{ route('admin.pago.index') }}" class="btn btn-primary float-right">Salir</a>
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