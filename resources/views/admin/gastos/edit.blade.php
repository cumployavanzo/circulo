@extends('layouts.AdminLTE.index')
@section('title', 'Gastos')
@section('header', 'Gastos')
@section('content')
 <div class="card card-gray">
        <div class="card-header">
            <h4 class="card-title">
                Nuevo solicitud
            </h4>
        </div>
        <form action="{{ route('admin.addNuevoActivo') }}" method="POST" autocomplete="off"> 
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" id="idGasto" name="idGasto" value="{{$gasto->id}}">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="fecha_compra">Fecha de Compra:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" id="fecha_compra" name="fecha_compra" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{ date('Y-m-d', strtotime($gasto['fecha_compra'])) }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="num_factura">N° de Factura:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-slack-hash"></i></span>
                                </div>
                                <input id="num_factura" class="form-control text-uppercase" type="text" name="num_factura" placeholder="N° de Factura" required="" maxlength="20" value="{{$gasto->num_factura}}">
                            </div>
                        </div>                                                  
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-8">                                               
                            <label for="Fk_proveedor">Proveedor:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-truck"></i></span>
                                </div>
                                <select type="select" id="Fk_proveedor" name="Fk_proveedor" class="form-control select2 " required onchange="cargarRfc();">
                                    <option value="">Seleccionar</option>
                                    @foreach($proveedores as $provedor)
                                        <option {{ old('Fk_proveedor') == $provedor->id ? 'selected' : ($opcionProveedor != "N/A" ? ($opcionProveedor == $provedor->id ? 'selected' : '')  : '') }} value="{{$provedor->id}}">{{$provedor->nombre_proveedor}}</option>
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
                            <label for="txt_rfc">RFC:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-asterisk"></i></span>
                                </div>
                                <input id="txt_rfc" class="form-control text-uppercase" type="text" name="txt_rfc" placeholder="RFC" disabled>
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
                                <select type="select" id="Fk_empleado" name="Fk_empleado" class="form-control select2 " required onchange="cargarArea();">
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
                            <label for="txt_area">Area:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building"></i></span>
                                </div>
                                <input id="txt_area" class="form-control text-uppercase" type="text" name="txt_area" placeholder="Area" disabled>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">                                            
                        <div class="col-lg-12">
                            <label for="detalle_compra">Detalle de Compra:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                                </div>
                                <textarea class="form-control text-uppercase" id="detalle_compra" name="detalle_compra" placeholder="Detalle de Compra">{{$gasto->detalle_compra}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card-header"></div> <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-lg-1 col-form-label" for="Fk_articulo">Articulo</label>
                                            <div class="col-lg-7">
                                                <select type="select" id="Fk_articulo" name="Fk_articulo" class="form-control select2 " onchange="cargarArticulo();">
                                                    <option value="">Selecciona</option>
                                                    @foreach($articulos as $articulo)
                                                        <option {{ old('Fk_articulo') == $articulo->id ? 'selected' : '' }} value="{{$articulo->id}}">{{$articulo->nombre_producto}}</option>
                                                    @endforeach
                                                </select>
                                                @error('userType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <input id="unidad_medida" class="form-control text-uppercase"  name="unidad_medida"  placeholder="Unidad de Medida" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-1 col-form-label">Cant.</label>
                                            <div class="col-lg-3">
                                                <input id="cantidades" class="form-control text-uppercase"  name="cantidades"  placeholder="Cantidad" onkeypress="return soloNumeros(event)"  required="">
                                            </div>
                                            <label class="col-lg-2 col-form-label">Costo Unitario</label>
                                            <div class="col-lg-5">
                                                <input id="costo_unitario" class="form-control text-uppercase"  name="costo_unitario"  placeholder="Costo S/iva" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-1 col-form-label">Control</label>
                                            <div class="col-lg-10">
                                                <textarea id="num_serie" class="form-control text-uppercase" rows="2" type="text" name="num_serie" placeholder="Introduce Modelo/Número de serie"></textarea>
                                            </div>
                                        </div>
                                        <hr class="m-6">
                                        <button type="submit" class="btn btn-block btn-info">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </div>                                                     
                    </div><!-- /.card-body -->
                </div>
        </form>
                @if (!empty($gasto) && !empty($gastoP))
                <div class="form-group" >  
                    <div class="row">
                        <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Unidad de Medida</th>
                                    <th>Núm. Serie</th>
                                    <th>Cant.</th>
                                    <th>Costo Unit.</th>
                                    <th>Importe</th>
                                    <th>IVA</th>
                                    <th>Ret IVA</th>
                                    <th>Ret ISR</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $totalIsr = 0;
                                    $totalRiva = 0;
                                    $totalIva = 0;
                                    $totalImp = 0;
                                @endphp
                                
                                @foreach($gastoProducto as $producto)
                                    <tr>
                                        <td>{{ $producto->articulo->nombre_producto }}</td>
                                        <td>{{ $producto->articulo->unidad_medida }}</td>
                                        <td>{{ $producto->numero_serie }}</td>
                                        <td>{{ $producto->cantidad }}</td>
                                        <td>{{ $producto->costo_unitario }}</td>
                                        <td style="width:5%">{{ $producto->importe }}</td>
                                        <td style="width:5%">{{ $producto->p_iva }}</td>
                                        <td style="width:5%">{{ $producto->p_riva }}</td>
                                        <td style="width:5%">{{ $producto->p_risr }}</td>
                                        <td style="width:5%">{{ $producto->total }}</td>
                                        <td style="width:5%">
                                            <form action="{{ route('admin.deleteProductoGasto', ['idProducto'=>$producto->id, 'idCompra'=>$producto->compras_id]) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit" href="#"><i class="fas fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $total += $producto->total;
                                        $totalIsr += $producto->p_risr;
                                        $totalRiva += $producto->p_riva;
                                        $totalIva += $producto->p_iva;
                                        $totalImp += $producto->importe;
                                        $sumaIgualDebe = $totalImp + $totalIva;
                                        $sumasIguales = $totalRiva + $totalIsr + $total;
                                    @endphp
                                   
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="float-right">{{ $gastoProducto->links()}}</div>
                        </div>   --}}
                    </div>  
                    <br>
                   
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th><b>Totales:</b></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-bold" style="width:5%">{{number_format($totalImp, 4, '.', '')}}</td>
                            <td class="text-bold" style="width:5%">{{number_format($totalIva, 4, '.', '')}}</td>
                            <td class="text-bold" style="width:5%">{{number_format($totalRiva, 4, '.', '')}}</td>
                            <td class="text-bold" style="width:5%">{{number_format($totalIsr, 4, '.', '')}}</td>
                            <td class="text-bold" style="width:5%">{{number_format($total, 4, '.', '')}}</td>
                            <td style="width:5%"></td>
                          </tr>
                        </table>
                      </div>
                      
                    </div>
                </div> 
                <br>
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
                                    <th style="width:15%">Factura</th>
                                    <th style="width:10%">N° compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gastoProducto as $producto)
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentas->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentas->nombre_cuenta }}</td>
                                        <td style="width:10%">{{number_format( $producto->importe, 4, '.', '')}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentasIva->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasIva->nombre_cuenta }}</td>
                                        <td style="width:10%">{{number_format($producto->p_iva, 4, '.', '')}}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentasRetIva->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasRetIva->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{number_format($totalRiva, 4, '.', '')}}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%">{{ $producto->articulo->cuentasRetIsr->numero_cuenta }}</td>
                                        <td style="width:40%">{{ $producto->articulo->cuentasRetIsr->nombre_cuenta }}</td>
                                        <td style="width:10%"></td>
                                        <td style="width:10%">{{number_format($totalIsr, 4, '.', '')}}</td>
                                        <td style="width:15%">{{ $gasto->num_factura}}</td>
                                        <td style="width:10%">{{ $gasto->id}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table">
                            <tr>
                                <td style="width:15%">{{ $gasto->proveedor->cuentas->numero_cuenta }}</td>
                                <td style="width:40%">{{ $gasto->proveedor->cuentas->nombre_cuenta }}</td>
                                <td style="width:10%"></td>
                                <td style="width:10%">{{number_format($total, 4, '.', '')}}</td>
                                <td style="width:15%">{{ $gasto->num_factura}}</td>
                                <td style="width:10%">{{ $gasto->id}}</td>
                            </tr>
                            <tr>
                                <td style="width:15%"></td>
                                <td style="width:40%">Sumas Iguales</td>
                                <td style="width:10%">{{number_format($sumaIgualDebe, 4, '.', '')}}</td>
                                <td style="width:10%">{{number_format($sumasIguales, 4, '.', '')}}</td>
                                <td style="width:15%">{{ $gasto->num_factura}}</td>
                                <td style="width:10%">{{ $gasto->id}}</td>
                            </tr>
                        </table>
                    </div>
                </div>   
                <div class="card-footer">
                    <a type="button" href="{{ route('admin.gasto.index') }}" class="btn btn-primary float-right">Terminar</a>
                </div>    
                @endif
            </div><!-- /.card-body -->                                       
       
    
</div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    cargarArticulo();
    cargarRfc();
    cargarArea();
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

    function cargarArticulo(){
        id = document.getElementById("Fk_articulo").value;
        $.ajax({
            url: "{{ asset('admin/gasto/articulos') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
               console.log(data);
                $('#unidad_medida').val(data.articulo.unidad_medida);
            }
        });
       
    }

    function cargarRfc(){
        id = document.getElementById("Fk_proveedor").value;
        $.ajax({
            url: "{{ asset('admin/gasto/rfcProveedor') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                $('#txt_rfc').val(data.provedorRfc.rfc);
            }
        });
       
    }

    function cargarArea(){
        id = document.getElementById("Fk_empleado").value;
        $.ajax({
            url: "{{ asset('admin/gasto/areaPersonals') }}/" + id,
            type: 'get',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data.personalsArea)
                $('#txt_area').val(data.personalsArea.nombre);
            }
        });
       
    }
    
</script>
@endpush