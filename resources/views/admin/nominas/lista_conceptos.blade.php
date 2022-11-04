@extends('layouts.AdminLTE.index')

@section('title', 'Conceptos')
@section('header', 'Conceptos')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Conceptos</h3>
            <div class="card-tools pull-right">
                <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#mymodalConceptos" title="Detalles"><li class="fas fa-plus"></li>&nbsp; Nuevo</a>
                <a href="{{ route('admin.nomina.index') }}"  type="button" class="btn btn-sm btn-danger" title="Regresar"><i class="fas fa-arrow-left"></i>&nbsp; Regresar</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Clave</th>
                        <th>Concepto</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conceptos as $concepto)
                    <tr>
                        <td>#{{ $concepto->id }}</td>
                        <td>{{ $concepto->clave }}</td>
                        <td>{{ $concepto->conceptos }}</td>
                        <td>{{ $concepto->tipo }}</td>
                        <td>
                            {{-- <a href="#" data-toggle="modal" data-target="#mymodalBajas" class="btn btn-danger" title="Aplicar Baja" onclick="datosEmpleado('{{ $personal->id }}')"><i class="fas fa-user-slash"></i></a> --}}
                            <a href="#" data-toggle="modal" data-target="#mymodalConceptos" class="btn btn-primary btn-sm" title="Editar" onclick="cargarIdNomina('{{ $concepto->id }}')"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $conceptos->links()}}</div>
        </div>
    </div>

    <div class="modal fade" id="mymodalConceptos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.concepto.store') }}" autocomplete="off" id="f_nomina" name="f_nomina">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel" style="color: #FFFFFF;"><strong>CONCEPTOS</strong></h5>
                    <button type="button" style="color: #FFFFFF;" class="close" data-dismiss="modal"  onclick="limpiaForm(f_nomina)"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idConceptoNomina" name="idConceptoNomina" value="0">
                    <div class="row" id="encabezado">
                        <div class="col-lg-12 connectedSortable">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-start">
                                        <div class="col-lg-5">
                                            <label for="txt_clave">Clave:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-slack-hash"></i></span>
                                                </div>
                                                <input id="txt_clave" class="form-control text-uppercase" type="text" name="txt_clave" placeholder="Clave">
                                            </div>
                                        </div>  
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label>Tipo:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                                    </div>
                                                    <select class="form-control" id="txt_tipo" name="txt_tipo" required>
                                                        <option>-- Selecciona --</option>
                                                        <option value="Persepcion">Persepción</option>
                                                        <option value="Deduccion">Deducción</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-11">
                                        <label for="txt_concepto">Concepto:</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-asterisk"></i></span>
                                            </div>
                                            <input id="txt_concepto" class="form-control text-uppercase" type="text" name="txt_concepto" placeholder="Concepto" required>
                                        </div>
                                    </div> 
                                    <div class="d-flex justify-content-start">
                                        <div class="col-sm-6">
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
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="txt_num_cuenta">Número de Cuenta</label>
                                                <input type="text" id="txt_num_cuenta" name="txt_num_cuenta" class="form-control" readonly placeholder="Número de Cuenta">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm" title="Guardar Registro">
                        <i class="fas fa-paper-plane"></i> 
                        &nbsp;Guardar
                    </button>
                    <button class="btn btn-danger btn-sm" title="Cancelar" data-dismiss="modal" aria-label="Close" onclick="limpiaForm(f_nomina)">
                        <i class="fas fa-ban"></i>
                        &nbsp; Cancelar
                    </button>
                </div>
            </form>    
          </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $("#txt_cuenta").select2({
        theme:"bootstrap4"
    });
    
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

    function cargarIdNomina(id){
        $.ajax({
            url: "{{ asset('admin/concepto/detalleConcepto') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
               console.log(data);
                $('#idConceptoNomina').val(data.concepto.id);
                $('#txt_clave').val(data.concepto.clave);
                $('#txt_tipo').val(data.concepto.tipo);
                $('#txt_concepto').val(data.concepto.conceptos);
                $('#txt_cuenta').val(data.concepto.cuentas_id).trigger('change.select2');
            }
        });
    }

    function limpiaForm(miForm) {
        
    // recorremos todos los campos que tiene el formulario
    $(':input', miForm).each(function() {
        var type = this.type;
        var tag = this.tagName.toLowerCase();
        //limpiamos los valores de los campos…
        if (type == 'text' || type == 'number' || type == 'password' || tag == 'textarea' || type == 'hidden')
        this.value = '';
        // excepto de los checkboxes y radios, le quitamos el checked
        // pero su valor no debe ser cambiado
        else if (type == 'checkbox' || type == 'radio')
        this.checked = false;
        // los selects le ponesmos el indice a -
        else if (tag == 'select')
        this.selectedIndex = "";
        else if (type == 'file')
        this.value = '';
    });
}
</script>
@endpush