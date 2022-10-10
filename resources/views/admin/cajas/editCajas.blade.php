@extends('layouts.AdminLTE.index')
@section('title', 'Cajas')
@section('header', 'Cajas')
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
                Editar Caja
            </h4>
        </div>
        <form method="POST" action="{{action('CajaController@update', $caja->id)}}" autocomplete="off">
        @method('PUT')	
        @csrf
        <div class="card-body">
            <div class="col-sm-10">
                <div class="form-group">
                    <label for="txt_nombre_caja">Nombre caja</label>
                    <input type="text" id="txt_nombre_caja" name="txt_nombre_caja" class="form-control text-uppercase" placeholder="Nombre de la caja" required value="{{ $caja->nombre_caja}}">
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="txt_name_responsable" class="">Nombre del Responsable</label>
                        <select type="select" id="txt_name_responsable" name="txt_name_responsable" class="form-control select2 " required onchange="cargarPuesto();">
                            <option value="">Selecciona</option>
                            @foreach($personals as $personal)
                                <option {{ old('txt_name_responsable') == $personal->id ? 'selected' :  ($opcionResponsable != "N/A" ? ($opcionResponsable == $personal->id ? 'selected' : '')  : '') }} value="{{$personal->id}}">{{$personal->getFullName()}}</option>
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
                        <input type="text" id="txt_puesto_responsable" name="txt_puesto_responsable" class="form-control text-uppercase" placeholder="Puesto del responsable" >
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txt_cuenta_contable" class="">Cuenta Contable</label>
                    <select type="select" id="txt_cuenta_contable" name="txt_cuenta_contable" class="form-control select2 " required>
                        <option value="">Seleccionar</option>
                        @foreach($cuentas as $cuenta)
                            <option {{ old('txt_cuenta_contable') == $cuenta->id ? 'selected' : ($opcionCuenta != "N/A" ? ($opcionCuenta == $cuenta->id ? 'selected' : '')  : '') }} value="{{$cuenta->id}}">{{$cuenta->nombre_cuenta}}</option>
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
                    <label for="txt_saldo_minimo">Saldo Mínimo</label>
                    <input type="text" id="txt_saldo_minimo" name="txt_saldo_minimo" class="form-control" placeholder="Saldo Minimo" value="{{ number_format($caja->saldo_minimo,2) }}">
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

    $("#txt_name_responsable").select2({
        theme:"bootstrap4"
    });

    cargarPuesto();

    function cargarPuesto(){
        idEmpleado = document.getElementById("txt_name_responsable").value;
        $.ajax({
            url: "{{ asset('admin/cajas/puestoPers') }}/" + idEmpleado,
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