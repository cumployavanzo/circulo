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
Route::resource('registro', 'Auth\RegisterController');
Route::get('cargaExp/verify/{idCliente}', 'ProspectoController@verifyExp')->name('cargaExpediente');
Route::get('/encuesta-prospecto', 'ProspectoController@loginCliente')->name('loginCliente'); // primera vista que verá el cliente al hacer la encuesta
Route::get('/subir-expediente/{idCliente}', 'ProspectoController@subirExpedientes')->name('subirExpedientes'); // primera vista que verá el cliente al hacer la encuesta
Route::post('/encuesta-prospecto', 'ProspectoController@listadoEncuestas')->name('listadoEncuestas');
Route::post('/perfil/foto', 'ExpedienteController@upExp');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('index');


   
    Route::resource('usuario', 'UserAdminController')->middleware('permiso');
    Route::resource('rol', 'RolController')->middleware('permiso');
    Route::resource('empresa', 'EmpresaController')->middleware('permiso');
    Route::resource('area', 'AreaController')->middleware('permiso');
    Route::resource('puesto', 'PuestoAdminController')->middleware('permiso');
    Route::resource('personal', 'PersonalAdminController')->middleware('permiso');
    Route::resource('cliente', 'ClienteAdminController')->middleware('permiso');
    Route::resource('aval', 'AvalController')->middleware('permiso');
    Route::resource('sucursal_ruta', 'SucursalRutaController')->middleware('permiso');
    


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
    


    Route::post('sucursal_ruta/reporteSuc/','SucursalRutaController@reporteSucursales')->name('reporteSucursales');



    Route::get('clientes/addclientes', 'ClienteAdminController@create')->name('addcliente');
    Route::post('clientes/addclientes', 'ClienteAdminController@store')->name('addClientes');
    Route::delete('clientes/deleteCliente/{id}', 'ClienteAdminController@destroy')->name('deleteCliente');
    Route::get('clientes/validarClaveElector/{id}', 'ClienteAdminController@existeCliente');
    Route::get('clientes/cargaProspecto/{id}', 'ClienteAdminController@verProspecto')->name('verProspecto');
    Route::put('clientes/{id}', 'ClienteAdminController@actualizarEstadoCliente');
    Route::post('clientes/addreferencias/{id}', 'ClienteAdminController@guardarReferencias')->name('addreferencias');
    Route::post('clientes/editRefer/{id}', 'ClienteAdminController@editarReferencias')->name('editRefer');
    Route::get('clientes/datosReferencia/{id}', 'ClienteAdminController@verReferencia')->name('verReferencia');
    Route::post('clientes/clientesimport', 'ClienteAdminController@import')->name('importClients');
    Route::post('reportes/reporteCliente/','ReporteController@reporteClientes')->name('reporteClientes');
    Route::get('cientes/consultaCirculoCredito/{idCliente}','ClienteAdminController@cdcTest')->name('ccCliente');



    Route::get('sucursales/addsucursales', 'SucursalRutaController@create')->name('addSucursales');
    Route::put('sucursales/{id}', 'SucursalRutaController@actualizarEstadoSuc');

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