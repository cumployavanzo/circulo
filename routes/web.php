<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('login', 'HomeController@login')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'HomeController@logout')->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('index');


    Route::resource('solicitud', 'SolicitudAdminController');
    Route::resource('usuario', 'UserAdminController');
    Route::resource('empresa', 'EmpresaController');
    Route::resource('area', 'AreaController');
    Route::resource('articulo', 'ArticuloController');
    Route::resource('producto', 'ProductoController');
    Route::resource('puesto', 'PuestoAdminController');
    Route::resource('personal', 'PersonalAdminController');
    Route::resource('asociado', 'AsociadoAdminController');
    Route::resource('cliente', 'ClienteAdminController');
    Route::resource('cuenta', 'CuentaController');
    Route::resource('proveedor', 'ProveedorController');
    Route::resource('analisis_credito', 'AnalisisCreditoController');
    Route::resource('desembolso', 'DesembolsoController');
    Route::resource('cartera_vigente', 'CarteraVigenteController');
    Route::resource('reporte', 'ReporteController');
    Route::resource('gasto', 'GastoController');
    Route::resource('activo', 'ActivoController');
    Route::resource('movimiento', 'MovimientoGastoController');
    Route::resource('pago', 'PagoController');
    Route::resource('aval', 'AvalController');
    Route::resource('banco', 'BancoController');
    Route::resource('caja', 'CajaController');
    Route::resource('sucursal_ruta', 'SucursalRutaController');
    Route::resource('capital', 'CapitalController');
    Route::resource('cobro', 'CobroController');
    Route::resource('noDeducible', 'NoDeducibleController');
    Route::resource('nomina', 'NominaController');
    Route::resource('concepto', 'ConceptoNominaController');
    Route::resource('movNomina', 'MovimientoNominaController');
    Route::resource('prestamoP', 'PrestamoPersonalController');
    Route::resource('vencimiento', 'VencimientoController');

    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');


    Route::get('usuarios/addusuarios', 'UserAdminController@create')->name('addusuario');
    Route::post('usuarios/addusuarios', 'UserAdminController@store')->name('addUsuarios');
    Route::put('usuarios/{id}', 'UserAdminController@actualizarEstadoUser');

    Route::post('empresas/addempresas', 'EmpresaController@store')->name('addEmpresas');


    Route::get('areas/addareas', 'AreaController@create')->name('addarea');
    Route::post('areas/addareas', 'AreaController@store')->name('addAreas');
    Route::delete('areas/deleteArea/{id}', 'AreaController@destroy')->name('deleteArea');



    Route::get('puestos/addpuestos', 'PuestoAdminController@create')->name('addpuesto');
    Route::post('puestos/addpuestos', 'PuestoAdminController@store')->name('addPuestos');
    Route::delete('puestos/deletePuesto/{id}', 'PuestoAdminController@destroy')->name('deletePuesto');

    Route::get('personales/addpersonal', 'PersonalAdminController@create')->name('addpersona');
    Route::post('personales/addpersonal', 'PersonalAdminController@store')->name('addpersonal');
    Route::delete('personales/deletePersonal/{id}', 'PersonalAdminController@destroy')->name('deletePersonal');
    Route::post('personales/detalleTablaEmpleados/', 'PersonalAdminController@tablaEmpleados')->name('tablaEmpleados');
    Route::post('personales/bajaPersonal', 'PersonalAdminController@baja')->name('bajaEmpleado');
    Route::get('personales/datosPersonal/{idEmpleado}', 'PersonalAdminController@verDetalleEmpleado')->name('verDetalleEmpleado');




    Route::get('asociados/addasociados', 'AsociadoAdminController@create')->name('addasociado');
    Route::post('asociados/addasociados', 'AsociadoAdminController@store')->name('addAsociados');
    Route::delete('asociados/deleteAsociado/{id}', 'AsociadoAdminController@destroy')->name('deleteAsociado');

    Route::get('clientes/addclientes', 'ClienteAdminController@create')->name('addcliente');
    Route::post('clientes/addclientes', 'ClienteAdminController@store')->name('addClientes');
    Route::delete('clientes/deleteCliente/{id}', 'ClienteAdminController@destroy')->name('deleteCliente');
    Route::get('clientes/validarClaveElector/{id}', 'ClienteAdminController@existeCliente');


    Route::get('aval/validarClave/{id}', 'AvalController@existeCliente');


    Route::get('solicitud/detalleClienteSolicitud/{id}', 'SolicitudAdminController@obtenerDetallesCliente');
    Route::post('solicitud/detalleTablaAmortizacion/', 'SolicitudAdminController@tablaAmortizacion')->name('tablaAmortizacion');
    Route::get('solicitud/productos/{id}', 'SolicitudAdminController@verProductos')->name('verProductos');

    Route::get('cuentas/addcuentas', 'CuentaController@create')->name('addcuenta');
    Route::post('cuentas/addcuentas', 'CuentaController@store')->name('addCuentas');
    Route::delete('cuentas/deleteCuenta/{id}', 'CuentaController@destroy')->name('deleteCuenta');
    Route::post('cuentas/reporteCuenta/','CuentaController@reporteCuentas')->name('reporteCuentas');


    Route::get('proveedores/addproveedores', 'ProveedorController@create')->name('addproveedor');
    Route::post('proveedores/addproveedores', 'ProveedorController@store')->name('addProveedores');
    Route::delete('proveedores/deleteProveedor/{id}', 'ProveedorController@destroy')->name('deleteProveedor');

    Route::get('analisis_credito/detalleCliente/{id}', 'AnalisisCreditoController@obtenerDetalles');
    Route::post('analisis_credito/detalleTablaAmortizacion/', 'AnalisisCreditoController@tablaAmortizacionRiesgo')->name('tablaAmortizacionRiesgo');
    Route::post('analisis_credito/variableRiesgo/', 'AnalisisCreditoController@tablaRiesgo')->name('tablaRiesgo');
    Route::post('analisis_credito/reporteColocacion/','AnalisisCreditoController@colocacionClientes')->name('colocacionClientes');


    Route::get('productos/addproductos', 'ProductoController@create')->name('addproducto');
    Route::post('productos/addproductos', 'ProductoController@store')->name('addProductos');
    Route::delete('productos/deleteProducto/{id}', 'ProductoController@destroy')->name('deleteProducto');
    Route::get('productos/numCuenta/{id}', 'ProductoController@verNumCuenta')->name('verNumCuenta');


    Route::get('articulos/addarticulos', 'ArticuloController@create')->name('addarticulo');
    Route::get('articulos/clasificacion/{id}', 'ArticuloController@verClasificacion')->name('verClasificacion');
    Route::post('articulos/addarticulos', 'ArticuloController@store')->name('addArticulos');
    Route::delete('articulos/deleteArticulo/{id}', 'ArticuloController@destroy')->name('deleteArticulo');

    Route::post('reportes/reporteCliente/','ReporteController@reporteClientes')->name('reporteClientes');

    Route::get('gasto/articulos/{id}', 'GastoController@verArticulo')->name('verArticulo');
    Route::post('gastos/addSolicitud', 'GastoController@store')->name('addNuevaSolicitud');
    Route::delete('gastos/deleteProductoGasto/{idProducto}/{idCompra}', 'GastoController@destroy')->name('deleteProductoGasto');
    Route::get('gasto/rfcProveedor/{id}', 'GastoController@verRfc')->name('verRfc');
    Route::get('gasto/areaPersonals/{id}', 'GastoController@verArea')->name('verArea');
    Route::post('gasto/reporteGasto/','GastoController@reporteGastos')->name('reporteGastos');
    Route::post('gasto/reporteArticulo/','GastoController@reporteArticulos')->name('reporteArticulos');
    Route::post('gasto/reporteGlobal/','GastoController@reporteGastosGlobal')->name('reporteGastosGlobal');


    Route::post('activos/addSolicitudActivo', 'ActivoController@store')->name('addNuevoActivo');
    Route::get('activo/articulosActivo/{id}', 'ActivoController@verArticuloactivo')->name('verArticuloactivo');
    Route::get('activo/rfcProveedorActivo/{id}', 'ActivoController@verRfcActivo')->name('verRfcActivo');
    Route::get('activo/areaPersonalsActivo/{id}', 'ActivoController@verAreaActivo')->name('verAreaActivo');


    Route::get('banco/addbancos', 'BancoController@create')->name('addbanco');
    Route::get('banco/puestoPersonals/{idEmpleado}', 'BancoController@verPuesto')->name('verPuesto');
    Route::post('banco/addbancos', 'BancoController@store')->name('addBancos');
    Route::delete('banco/deleteBanco/{id}', 'BancoController@destroy')->name('deleteBanco');

    Route::get('cajas/addcajas', 'CajaController@create')->name('addcaja');
    Route::get('cajas/puestoPers/{idEmpleado}', 'CajaController@verPuesto')->name('verPuesto');
    Route::post('cajas/addcajas', 'CajaController@store')->name('addCajas');
    Route::delete('cajas/deleteCaja/{id}', 'CajaController@destroy')->name('deleteCaja');

    Route::get('sucursales/addsucursales', 'SucursalRutaController@create')->name('addSucursales');
    Route::put('sucursales/{id}', 'SucursalRutaController@actualizarEstadoSuc');

    // Route::post('pagos/addpagos', 'PagoController@store')->name('addPagos');
    Route::get('pagos/verContabilidad', 'PagoController@verContabilidad')->name('verContabilidad');

    Route::get('capital/detallesPersonals/{id}', 'CapitalController@verDetallesPersonal')->name('verDetallesPersonal');
    Route::post('capital/addSolicitud', 'CapitalController@store')->name('addSolicitudCapital');

    Route::post('noDeducible/addNodeducible', 'NoDeducibleController@store')->name('addNodeducible');
    Route::get('noDeducible/articulosNoDeducible/{id}', 'NoDeducibleController@verArticuloNoDeducible')->name('verArticuloNoDeducible');
    Route::get('noDeducible/rfcProveedorNoDeducible/{id}', 'NoDeducibleController@verRfcNoDeducible')->name('verRfcNoDeducible');
    Route::get('noDeducible/areaPersonalsNoDeducible/{id}', 'NoDeducibleController@verAreaNoDeducible')->name('verAreaNoDeducible');
    
    Route::get('nomina/allDetallesPersonals/{id}', 'NominaController@detallesPersonal')->name('detallesPersonal');
    Route::get('nomina/pdf/reciboNomina/{idEmpleado}','NominaController@pdfRecibo')->name('reciboNomina');
    Route::post('nominas/updateNom/{id}', 'NominaController@autorizarNomina')->name('updateNomina');
    Route::delete('nominas/deleteEmpleadoNom/{idNomina}/{idDetalle}', 'NominaController@destroy')->name('deleteEmpleadoNom');

    Route::post('movNomina/verificarPrestamos/', 'MovimientoNominaController@detallesPrestamoP')->name('detallesPrestamoP');
    Route::get('concepto/detalleConcepto/{id}', 'ConceptoNominaController@verDetallesConcepto')->name('verDetallesConcepto');

    Route::post('prestamoP/reportePrestamo/','PrestamoPersonalController@reportePrestamos')->name('reportePrestamos');
    Route::get('detallesPrestamos/{id}', 'PrestamoPersonalController@show');












    // Route::get('analisis_credito/addanalisis/{id}', 'AnalisisCreditoController@create')->name('addanalisis');
    // Route::post('analisis_credito/{id}', 'AnalisisCreditoController@analisisCredito')->name('addanalisis');









});
/*

php artisan make:controller UserController
php artisan make:controller UserAdminController --resource
php artisan make:seeder UserTableSeeder

php artisan make:controller PuestoAdminController --resource
php artisan make:controller PuestoController --resource

php artisan make:model Puesto -mfc
php artisan make:seeder PuestosTableSeeder

php artisan make:controller AsociadoAdminController --resource
php artisan make:model Asociado -mfc
php artisan make:seeder AsociadosTableSeeder

php artisan make:controller ClienteAdminController --resource
php artisan make:model Cliente -mfc
php artisan make:seeder ClientesTableSeeder

php artisan make:controller SolicitudAdminController --resource
php artisan make:model Solicitud -mfc
php artisan make:seeder SolicitudesTableSeeder

*/