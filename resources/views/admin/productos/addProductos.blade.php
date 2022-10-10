@extends('layouts.AdminLTE.index')
@section('title', 'Productos')
@section('header', 'Productos')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Alta de producto
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.addProductos') }}" autocomplete="off">
            @csrf
        <div class="card-body">
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="txt_nombre_producto">Nombre del Producto</label>
                    <input type="text" id="txt_nombre_producto" name="txt_nombre_producto" class="form-control text-uppercase" placeholder="Nombre del Producto">
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_frecuencia">Frecuencia de Pago</label>
                        <select class="form-control" id="txt_frecuencia" name="txt_frecuencia">
                            <option>DIARIO</option>
                            <option>SEMANAL</option>
                            <option>QUINCENAL</option>
                            <option>MENSUAL</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_plazo">Plazo</label>
                        <input type="text" id="txt_plazo" name="txt_plazo" class="form-control text-uppercase" placeholder="plazo" onchange="calculo();">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_tasa">Tasa</label>
                        <input type="text" id="txt_tasa" name="txt_tasa" class="form-control text-uppercase" placeholder="Tasa" onchange="calculo();">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_monto_prestamo">Monto del Prestamo</label>
                        <input type="text" id="txt_monto_prestamo" name="txt_monto_prestamo" class="form-control" placeholder="Monto del Prestamo" onchange="calculo();">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_nivel">Nivel</label>
                        <input type="text" id="txt_nivel" name="txt_nivel" class="form-control" placeholder="Nivel" >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_monto_pago">Pago Semanal</label>
                        <input type="text" id="txt_monto_pago" name="txt_monto_pago" class="form-control" placeholder="Pago Semanal" >
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_meses">Meses</label>
                        <input type="text" id="txt_meses" name="txt_meses" class="form-control" placeholder="Meses">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_total">Total</label>
                        <input type="text" id="txt_total" name="txt_total" class="form-control" placeholder="Total">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_cuenta" class="">Cuenta Contable</label>
                        <select type="select" id="txt_cuenta" name="txt_cuenta" class="form-control select2 " required onchange="cargarNumCta()">
                            <option value="">Selecciona</option>
                            @foreach($cuentas as $cuenta)
                                <option {{ old('txt_cuenta') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
                            @endforeach
                        </select>
                        @error('userType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_cuenta">Número de Cuenta</label>
                        <input type="text" id="txt_num_cuenta" name="txt_num_cuenta" class="form-control" readonly placeholder="Número de Cuenta">
                    </div>
                </div>
            </div>
        </div>              
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Guardar</button>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('[data-mask]').inputmask()
    
    $("#txt_cuenta").select2({
        theme:"bootstrap4"
    });

    $("#txt_monto_prestamo").maskMoney({
        decimal: ".",
        thousands: ","
    })

    function calculo(){
        let monto_prestamo = convertir($("#txt_monto_prestamo").val());
        let tasa = $("#txt_tasa").val();
        let plazo = $("#txt_plazo").val();
        let porcentaje = tasa * (1/100);

        if (isNaN(monto_prestamo) || isNaN(tasa) || isNaN(plazo)) {
            $("#txt_monto_pago").val("")
            $("#txt_total").val("")
        }else{   
            let formulaTotal = ((monto_prestamo * porcentaje) + monto_prestamo)
            let formulaMontoP= (formulaTotal / plazo)
            let resultadoT = formulaTotal.toFixed(2)
            let resultadoMp = formulaMontoP.toFixed(2)
            $("#txt_total").val(resultadoT)
            $("#txt_monto_pago").val(resultadoMp)
        }

    }

    function cargarNumCta(){
        id = document.getElementById("txt_cuenta").value;
        $.ajax({
            url: "{{ asset('admin/productos/numCuenta') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
               console.log(data);
                $('#txt_num_cuenta').val(data.cuenta.numero_cuenta);
                
            }
        });
    }
</script>
@endpush