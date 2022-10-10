@extends('layouts.AdminLTE.index')
@section('title', 'Bancos')
@section('header', 'Bancos')
@section('content')
<div class="col-md-12">
    <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo Banco
            </h4>
        </div>
        <form method="POST" action="{{ route('admin.addBancos') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="txt_nombre_banco">Nombre banco</label>
                    <input type="text" id="txt_nombre_banco" name="txt_nombre_banco" class="form-control text-uppercase" placeholder="Nombre del Banco" required>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="txt_nombre_cuenta">Nombre cuenta</label>
                        <input type="text" id="txt_nombre_cuenta" name="txt_nombre_cuenta" class="form-control text-uppercase" placeholder="Nombre de la Cuenta" required>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="txt_num_cuenta">Número de cuenta</label>
                        <input type="text" id="txt_num_cuenta" name="txt_num_cuenta" class="form-control text-uppercase" placeholder="Número de la Cuenta" maxlength="20">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_cuenta_clabe">Número cuenta clave</label>
                        <input type="text" id="txt_cuenta_clabe" name="txt_cuenta_clabe" class="form-control text-uppercase" placeholder="Número cuenta clave">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_num_tarjeta">Número de tarjeta</label>
                        <input type="text" id="txt_num_tarjeta" name="txt_num_tarjeta" class="form-control text-uppercase " placeholder="Número de tarjeta" maxlength="20">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="txt_uso_cuenta">Uso de la cuenta</label>
                        <input type="text" id="txt_uso_cuenta" name="txt_uso_cuenta" class="form-control text-uppercase" placeholder="Uso de la cuenta">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txt_cuenta_contable" class="">Cuenta contable</label>
                    <select type="select" id="txt_cuenta_contable" name="txt_cuenta_contable" class="form-control select2 " required>
                        <option value="">Selecciona</option>
                        @foreach($cuentas as $cuenta)
                            <option {{ old('txt_cuenta_contable') == $cuenta->id ? 'selected' : '' }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
                        @endforeach
                    </select>
                    @error('userType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_name_firmante" class="">Nombre del firmante</label>
                        <select type="select" id="txt_name_firmante" name="txt_name_firmante" class="form-control select2 " required onchange="cargarPuesto();">
                            <option value="">Selecciona</option>
                            @foreach($personals as $personal)
                                <option {{ old('txt_name_firmante') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
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
                        <label for="txt_puesto_firmante">Puesto del Firmante</label>
                        <input type="text" id="txt_puesto_firmante" name="txt_puesto_firmante" class="form-control text-uppercase" placeholder="Puesto del firmante">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_responsable_cuenta" class="">Responsable de la Cuenta</label>
                        <select type="select" id="txt_responsable_cuenta" name="txt_responsable_cuenta" class="form-control select2 " required onchange="cargarPuestoResp();">
                            <option value="">Selecciona</option>
                            @foreach($personals as $personal)
                                <option {{ old('txt_responsable_cuenta') == $personal->id ? 'selected' : '' }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
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
                        <label for="txt_puesto_responsable">Puesto del Responsable</label>
                        <input type="text" id="txt_puesto_responsable" name="txt_puesto_responsable" class="form-control text-uppercase" placeholder="Puesto del responsable">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txt_saldo_minimo">Saldo Mínimo</label>
                    <input type="text" id="txt_saldo_minimo" name="txt_saldo_minimo" class="form-control" placeholder="Saldo Minimo">
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
     $("#txt_saldo_minimo").maskMoney({
        decimal: ".",
        thousands: ","
    });

    $("#txt_cuenta_contable").select2({
        theme:"bootstrap4"
    });

    $("#txt_name_firmante").select2({
        theme:"bootstrap4"
    });

    $("#txt_responsable_cuenta").select2({
        theme:"bootstrap4"
    });

    function cargarPuesto(){
        idEmpleado = document.getElementById("txt_name_firmante").value;
        $.ajax({
            url: 'puestoPersonals/' + idEmpleado,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data.personalsPuesto)
                $('#txt_puesto_firmante').val(data.personalsPuesto.puesto);
            }
        });
       
    }

    function cargarPuestoResp(){
        idEmpleado = document.getElementById("txt_responsable_cuenta").value;
        $.ajax({
            url: 'puestoPersonals/' + idEmpleado,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data.personalsPuesto)
                $('#txt_puesto_responsable').val(data.personalsPuesto.puesto);
            }
        });
       
    }
</script>
@endpush