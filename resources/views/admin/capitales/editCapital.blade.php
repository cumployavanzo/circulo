@extends('layouts.AdminLTE.index')
@section('title', 'Capital')
@section('header', 'Capital')
@section('content')
 <div class="card card-gray">
        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('mensaje')}}
            </div>  
        @endif 
        <div class="card-header">
            <h4 class="card-title">
                Nueva solicitud
            </h4>
        </div>
        <form method="POST" action="{{action('CapitalController@update', $gasto->id)}}" autocomplete="off">
            @method('PUT')           
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="fecha_compra">Fecha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_compra" name="fecha_compra" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d', strtotime($gasto['fecha_compra'])) }}">
                            </div>
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
                                <select type="select" id="Fk_empleado" name="Fk_empleado" class="form-control select2 " required onchange="detallesEmpleado();">
                                    <option value="">Selecciona</option>
                                    @foreach($personals as $personal)
                                        <option {{ old('Fk_empleado') == $personal->id ? 'selected' : ($opcionPersonal != "N/A" ? ($opcionPersonal == $personal->id ? 'selected' : '')  : '') }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
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
                            <label for="txt_puesto">Puesto:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span>
                                </div>
                                <input id="txt_puesto" class="form-control text-uppercase" type="text" name="txt_puesto" placeholder="Puesto" disabled>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-4">
                            <label for="txt_rfc">RFC:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ul"></i></span>
                                </div>
                                <input id="txt_rfc" class="form-control text-uppercase" type="text" name="txt_rfc" placeholder="RFC" disabled>
                            </div>
                        </div>    
                        <div class="col-lg-4">
                            <label for="txt_curp">CURP:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                </div>
                                <input id="txt_curp" class="form-control text-uppercase" type="text" name="txt_curp" placeholder="CURP" disabled>
                            </div>
                        </div>   
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="txt_concepto">Concepto</label>
                                <select class="form-control" id="txt_concepto" name="txt_concepto" required>
                                    <option {{ $gasto->concepto == 'APORTACIONES DE CAPITAL' ? 'selected' : ''}} value="APORTACIONES DE CAPITAL">APORTACIONES DE CAPITAL</option>
                                    <option {{ $gasto->concepto == 'RETIRO DE CAPITAL' ? 'selected' : ''}} value="RETIRO DE CAPITAL">RETIRO DE CAPITAL</option>
                                    <option {{ $gasto->concepto == 'VENTA DE ACCIONES' ? 'selected' : ''}} value="VENTA DE ACCIONES">VENTA DE ACCIONES</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">          
                        <div class="col-lg-4">
                            <label for="cantidades">N° Acciones:</label>
                            <input id="cantidades" class="form-control text-uppercase" type="text" name="cantidades" placeholder="N° Acciones" value="{{$gastoP->cantidad}}" onchange="calcularTotal()">
                        </div>   
                        <div class="col-lg-4">
                            <label for="costo_unitario">Valor de la Acción:</label>
                            <input id="costo_unitario" class="form-control text-uppercase" type="text" name="costo_unitario" placeholder="Valor de la Acción" value="{{$gastoP->costo_unitario}}">
                        </div>   
                        <div class="col-lg-4">
                            <label for="total">Total:</label>
                            <input id="total" class="form-control text-uppercase" type="text" name="total" placeholder="Total" readonly value="{{$gasto->total}}">
                        </div>   
                    </div>   
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-12">
                            <label for="detalle_compra">Detalle:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                                </div>
                                <textarea class="form-control text-uppercase" id="detalle_compra" name="detalle_compra" placeholder="Detalle de Compra">{{$gasto->detalle_compra}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th style="width:10%">N° Gasto</th>
                                </tr>
                            </thead>
                            <tbody>
                               @if ($gasto->concepto == 'APORTACIONES DE CAPITAL')
                                    <tr>
                                        <td style="width:15%">100-600-100-005</td>
                                        <td style="width:40%">SOCIOS O ACCIONISTAS</td>
                                        <td style="width:10%">{{$gasto->total}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">300-100-100-000</td>
                                        <td style="width:40%">CAPITAL SOCIAL</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{$gasto->total}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                @elseif($gasto->concepto == 'RETIRO DE CAPITAL' || $gasto->concepto == 'VENTA DE ACCIONES')
                                    <tr>
                                        <td style="width:15%">300-100-100-000</td>
                                        <td style="width:40%">CAPITAL SOCIAL</td>
                                        <td style="width:10%">{{$gasto->total}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">100-600-100-005</td>
                                        <td style="width:40%">SOCIOS, ACCIONISTAS O REPRESENTANTE LEGAL</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{$gasto->total}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    
                               @endif
                                   
                                   
                            </tbody>
                        </table>
                       
                    </div>
                </div>   
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>
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

    function calcularTotal(){
        let cantidad = $("#cantidades").val();
        let costo_unitario = convertir($("#costo_unitario").val());
       
        if (isNaN(cantidad) || isNaN(costo_unitario)) {
            $("#total").val("")
        }else{   
            let formula = (cantidad * costo_unitario)
            let resultado = formula.toFixed(2)
            $("#total").val(resultado)
        }

    }
</script>
@endpush