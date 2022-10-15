@extends('layouts.AdminLTE.index')
@section('title', 'Prestamo Personal')
@section('header', 'Prestamo Personal')
@section('content')

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Datos</h3>
            </div>
            <div class="card-body">
                <strong><i class="fas fa-user mr-1"></i>&nbsp;&nbsp;{{$prestamos->personals->getFullName()}}</strong>
                <p class="text-muted">{{$prestamos->personals->puestoid->puesto}}</p>
                <hr>
                <strong><i class="fas fa-calendar-check mr-1"></i> Fecha del Prestamo: </strong>
                <p class="text-muted">{{ date('d/m/Y', strtotime($prestamos->fecha_prestamo))}}</p>
                <hr>
                <strong><i class="fas fa-comments-dollar mr-1"></i> Monto del Prestamo: </strong>
                <p class="text-muted"><b class="text-success">$ {{number_format($prestamos->total_prestamo, 2, '.', '')}}</b></p>
                <hr>
                @php
                    if($descuentos){
                        $monto = round($descuentos->monto, 2);
                        $saldo = ($prestamos->total_prestamo - $monto);
                    }else{
                        $monto = '0.00';
                        $saldo = '0.00';
                    }       
                @endphp
                <strong><i class="fas fa-file-invoice-dollar mr-1"></i> Saldo:</strong>
                <p class="text-muted"><b class="text-success">$ {{number_format($saldo, 2, '.', '')}}</b></p>
                <hr>
                <strong><i class="fas fa-list-ol mr-1"></i> Plazo: </strong>
                <p class="text-muted">#<b> {{ $prestamos->num_pagos}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $prestamos->concepto->conceptos}}
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
                                        <th>#</th>
                                        <th>Monto Pago</th>
                                        <th>N° Nomina</th>
                                        <th>Fecha Corte</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 0;
                                    @endphp
                                    @foreach($detalles as $detalle)
                                    @php
                                        $cont ++;
                                        if($detalle->detalleNomina){
                                            $nomina = $detalle->detalleNomina->nomina_id;
                                            $corteIni = date("d/m/Y", strtotime($detalle->detalleNomina->nomina->fecha_corte_ini));
                                            $corteFin = date("d/m/Y", strtotime($detalle->detalleNomina->nomina->fecha_corte_fin));
                                        }else{
                                            $nomina = '--';
                                            $corteIni = '-- -- --';
                                            $corteFin = '-- -- --';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{$cont}}</td>
                                        <td>$ {{number_format($detalle->monto_pago, 2, '.', '')}}</td>
                                        <td>{{ $nomina }}</td>
                                        <td>{{ $corteIni }} al {{$corteFin}}</td>
                                        @if ($detalle->estatus == 'Descontado')
                                            <td><small class="badge badge-success">{{ $detalle->estatus }}</small></td>
                                        @else
                                            <td><small class="badge badge-warning">{{ $detalle->estatus }}</small></td>
                                        @endif   
                                    </tr>
                                   
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-right">{{ $detalles->links()}}</div>
                        </div> 
                    </div>
                </div>
              </div>
            </div>
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

    
    detallesEmpleado();
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
            url: "{{ asset('admin/capital/detallesPersonals') }}/" + id,
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