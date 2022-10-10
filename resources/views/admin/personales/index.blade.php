@extends('layouts.AdminLTE.index')

@section('title', 'Personal')
@section('header', 'Personal')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Personal</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.personal.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Personal"><li class="fas fa-plus"></li>&nbsp; Nuevo Personal</a>
            </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" autocomplete="off">
                <div class="form-group row text-right">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm text-uppercase" placeholder="Introduce nombre a buscar " id="txt_name" name="txt_name" value="{{$name}}">    
                    </div> 
                    <div class="col-sm-2 text-left">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i>&nbsp; Buscar</button>
                    </div>
                </div>
            </form>
            <div class="form-group float-right">
                <div class="d-flex">
                    <form action="{{ route('admin.personal.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Activo">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-success">{{$stateActivo->count()}}</span>
                            <i class="fas fa-user-check"></i> Activos
                        </button>
                    </form>
                    <form action="{{ route('admin.personal.index') }}">
                        @csrf
                        <input type="hidden" id="estatus" name="estatus" value="Baja">
                        <button type="submit" class="btn btn-app">
                            <span class="badge bg-danger">{{$stateBaja->count()}}</span>
                            <i class="fas fa-user-times"></i> Bajas
                        </button>
                    </form>
                </div>
            </div>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Curp</th>
                        <th>IMSS</th>
                        <th>Estatus</th>
                        <th>Acción&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="tbl_empleados">
                    @foreach($personales as $personal)
                    <tr>
                        <td>#{{ $personal->id }}</td>
                        <td><a>{{ $personal->getFullName() }}</a></td>
                        <td>{{ $personal->genero }}</td>
                        <td>{{ $personal->curp }}</td>
                        <td>{{ $personal->imss }}</td>
                        @if ($personal->state == 'Activo')
                            <td><small class="badge badge-success">{{ $personal->state }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-info" href="{{ route('admin.personal.edit', [$personal->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#mymodalBajas" class="btn btn-danger" title="Aplicar Baja" onclick="datosEmpleado('{{ $personal->id }}')"><i class="fas fa-user-slash"></i></a>
                                </div>
                            </td>
                        @else
                            <td><small class="badge badge-danger">{{ $personal->state }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-info" href="{{ route('admin.personal.edit', [$personal->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-default" href="#" data-toggle="modal" data-target="#mymodalDetalles" title="Detalles" onclick="vistaModalEmpleado('{{ $personal->id }}')"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        @endif   
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $personales->appends(request()->query())->links()}}</div>
        </div>
    </div>

    <div class="modal fade" id="mymodalBajas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.bajaEmpleado') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><strong>BAJA DE EMPLEADO</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                    
                </div>
                <div class="modal-body">
                    <div class="row" id="encabezado"></div>                  
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user"></i>&nbsp; <strong><span id="promotor_baja"></span></strong></h3>
                                </div>
                                <div class="card-body">
                                    <div class="callout callout-info">
                                        <address>
                                            N° Empleado: <strong id="num_empleado">#</strong><br>
                                            <strong class="text-danger">Fecha Ingreso: <span id="fecha_ingreso"></span></strong>
                                        </address>
                                    </div>
                                    <input type="hidden" id="idEmpleado" name="idEmpleado" value="">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Fecha Baja:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" id="fecha_baja" name="fecha_baja" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">    
                                        <div class="form-group">
                                            <label>Motivo de Baja:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                                </div>
                                                <select class="form-control" id="txt_motivo_baja" name="txt_motivo_baja" required>
                                                    <option>-- Selecciona --</option>
                                                    <option value="Renuncia Voluntaria">Renuncia Voluntaria</option>
                                                    <option value="Terminacion de Contrato">Terminación de Contrato</option>
                                                    <option value="Abandono de Empleo">Abandono de Empleo</option>
                                                    <option value="Baja Productividad">Baja Productividad</option>
                                                    <option value="Defunsion">Defunsión</option>
                                                    <option value="Cierre">Cierre</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">   
                                        <div class="form-group">
                                            <label>Observaciones:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                                </div>
                                                <textarea class="form-control text-uppercase" id="observaciones" name="observaciones" placeholder="Observaciones.."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm" title="Guardar Registro">
                        <i class="fas fa-paper-plane"></i> 
                        &nbsp;Guardar
                    </button>
                    <button class="btn btn-danger btn-sm" title="Cancelar" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-ban"></i>
                        &nbsp; Cancelar
                    </button>
                </div>
            </form>    
          </div>
        </div>
    </div>

    <div class="modal fade" id="mymodalDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form class="form-horizontal" id="f_detalles">
                <input type="hidden" id="detalles" name="detalles" value="0">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel" style="color: #FFFFFF;"><strong>HISTORIAL MOVIMIENTOS</strong></h5>
                    <button type="button" style="color: #FFFFFF;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="encabezado">
                        <div class="col-lg-12 connectedSortable">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title" id="namePromotor"></h3>
                                </div>
                                <div class="card-body">
                                    <div class="callout callout-danger">
                                        <address>
                                            CURP: <strong id="curp"></strong><br>
                                            RFC: <strong id="rfc"></strong><br>
                                            Dirección: <strong id="direccion"></strong><br>
                                            Fecha nacimiento: <strong id="fecha_nac"></strong><br>
                                            <strong class="text-danger">  Fecha Ingreso: <span id="f_ingreso"></span> </strong>
                                        </address>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                           <div class="table-responsive">
                                               <table class="table table-striped table-sm table-condensed table-bordered">
                                                   <thead>
                                                          <tr>
                                                               <th>#</th>
                                                               <th>Usuario</th>
                                                               <th>Fecha Movimiento</th>
                                                               <th>Tipo movimiento</th>
                                                               <th>Fecha Baja</th>
                                                               <th>Observaciones</th>
                                                          </tr>
                                                    </thead>
                                                    <tbody id='tablaListaEmpleado'></tbody>
                                               </table>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger btn-sm" data-dismiss="modal" title="Cerrar">
                        <i class="fas fa-times"></i>
                        &nbsp; Cerrar
                    </a>
                </div>
            </form>    
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

    function datosEmpleado(idEmpleado){
        $.ajax({
            url: "{{ asset('admin/personales/datosPersonal') }}/" + idEmpleado,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                $('#idEmpleado').val(data.personal.id);
                $('#promotor_baja').html(data.personal.nombre+' '+data.personal.apellido_paterno+' '+data.personal.apellido_materno);
                $('#num_empleado').html(data.personal.id);
                $('#fecha_ingreso').html(data.personal.fecha_alta);

            }
        });
    }

    function vistaModalEmpleado(idEmpleado){
        $.ajax({
            url: "{{ asset('admin/personales/datosPersonal') }}/" + idEmpleado,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                $('#namePromotor').html(data.personal.nombre+' '+data.personal.apellido_paterno+' '+data.personal.apellido_materno);
                $('#rfc').html(data.personal.rfc);
                $('#curp').html(data.personal.curp);
                $('#direccion').html(data.personal.direccion);
                $('#fecha_nac').html(data.personal.fecha_nacimiento);
                $('#f_ingreso').html(data.personal.fecha_alta);
                listaModalpromot(idEmpleado);
            }
        });
    }


function listaModalpromot(idEmpleado){
    csrfc = $('meta[name="csrf-token"]').attr('content')
      $.ajax({
        type: 'POST',
        url: '/admin/personales/detalleTablaEmpleados',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            _token: csrfc,
            idEmpleado : idEmpleado,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $('#tablaListaEmpleado').html('')
            $('#tablaListaEmpleado').html(data.tbody);
        }
    });//fin de ajax
}

</script>
@endpush