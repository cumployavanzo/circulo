<?php

namespace App\Http\Controllers;

use App\Asociado;
use App\Cliente;
use App\EstadoNacimiento;
use App\Cuenta;
use App\Aval;
use App\Prospecto;

use Illuminate\Http\Request;

use App\Http\Controllers\ClienteController;

class ClienteAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ClienteController = new ClienteController();
        // $clientes = $ClienteController->name($name)->getClientesPaginate();
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $clientes = Cliente::name($name)->paginate(10);
        $asociados = Asociado::all(); 
        return view('admin.clientes.index', compact('clientes','asociados','name'));
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        $asociados = Asociado::all();
        $avales = Aval::all();
        $estados_nac = EstadoNacimiento::all();
        $prospectos = Prospecto::where('estatus','Prospecto')->get();
        return view('admin.clientes.addClientes', compact('avales','asociados','cuentas','estados_nac','prospectos'));
    }

    public function store(Request $request)
    {
        //  dd($request);
        $cliente = new Cliente();
        if($request->txt_nombre_prospecto){
            Prospecto::where('id', $request->txt_nombre_prospecto)->update([
                'estatus' => 'Cliente',
            ]);
        }
        $cliente->user_id = auth()->user()->id;
        $cliente->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $cliente->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $cliente->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $cliente->fecha_nacimiento = $request->input('txt_fecha_nac');
        $cliente->edad = $request->input('txt_edad');
        $cliente->genero = $request->input('txt_genero');
        $cliente->ciudad_nacimiento = mb_strtoupper($request->input('txt_ciudad_nacimiento'), 'UTF-8');
        $cliente->nacionalidad = mb_strtoupper($request->input('txt_nacionalidad'), 'UTF-8');
        $cliente->estados_nacimientos_clave = mb_strtoupper($request->input('txt_estado_nacimiento'), 'UTF-8');
        $cliente->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $cliente->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $cliente->celular = $request->input('txt_celular');
        $cliente->tipo_vivienda = mb_strtoupper($request->input('txt_tipo_vivienda'), 'UTF-8');
        $cliente->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $cliente->anios_residencia = mb_strtoupper($request->input('txt_residencia'), 'UTF-8');
        $cliente->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $cliente->cp = $request->input('txt_codigo_postal');
        $cliente->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $cliente->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $cliente->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $cliente->fecha_alta = $request->input('txt_fecha_alta');
        $cliente->escolaridad = mb_strtoupper($request->input('txt_escolaridad'), 'UTF-8');
        $cliente->profesion = mb_strtoupper($request->input('txt_profesion'), 'UTF-8');
        $cliente->religion = mb_strtoupper($request->input('txt_religion'), 'UTF-8');
        $cliente->estado_civil = mb_strtoupper($request->input('txt_estado_civil'), 'UTF-8');
        $cliente->clave_elector = mb_strtoupper($request->input('txt_clave_elector'), 'UTF-8');
        $cliente->anio_vencimiento_ine = $request->input('txt_vencimiento_ine');
        $cliente->folio_ine = mb_strtoupper($request->input('txt_folio_ine'), 'UTF-8');
        $cliente->ocr = mb_strtoupper($request->input('txt_ocr'), 'UTF-8');
        $cliente->numero_tarjeta = $request->input('txt_num_tarjeta');
        $cliente->numero_cuenta = $request->input('txt_num_cuenta');
        $cliente->clave_interbancaria = $request->input('txt_clave_interbancaria');
        $cliente->banco = mb_strtoupper($request->input('txt_banco'), 'UTF-8');
        $cliente->tipo_cliente = mb_strtoupper($request->input('txt_tipo_cliente'), 'UTF-8');
        $cliente->asociado_id = $request->input('txt_nombre_asociado');
        $cliente->aval_id = $request->input('txt_nombre_aval');
        $cliente->cuentas_id = $request->input('txt_cuenta');

        $cliente->save();
        //  return redirect('admin/asociados/addasociados')->with('success', 'Se ha agregado el puesto exitosamente');
         return redirect()->route('admin.cliente.index');

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $ClienteController = new ClienteController();
        $cliente = $ClienteController->getCliente($id); // Cliente::where('id', $id)->first();
        $asociados = Asociado::all(); 
        $personAsociado = "N/A";
        if($cliente->asociados()->first('id') != null){
            $personAsociado = $cliente->asociados()->first('id')->id;
        }

        $avales = Aval::all(); 
        $personAval = "N/A";
        if($cliente->aval()->first('id') != null){
            $personAval = $cliente->aval()->first('id')->id;
        }
        $cuentas = Cuenta::all();
        $opcionCuenta = "N/A";
        if($cliente->cuentas()->first('id') != null){
            $opcionCuenta = $cliente->cuentas()->first('id')->id;
        }

        $estados_nac = EstadoNacimiento::all(); 
        $opcionEstado = "N/A";
        if($cliente->estadoNac()->first('clave') != null){
            $opcionEstado = $cliente->estadoNac()->first('clave')->clave;
        }
        return view('admin.clientes.edit', compact('cliente', 'asociados','personAsociado','cuentas','opcionCuenta','avales','personAval','estados_nac','opcionEstado'));
    }

    public function update(Request $request, $id)
    {
        Cliente::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre , 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno, 'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno , 'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => $request->txt_genero,
            'ciudad_nacimiento' => mb_strtoupper($request->txt_ciudad_nacimiento,'UTF-8'),
            'nacionalidad' => mb_strtoupper($request->txt_nacionalidad, 'UTF-8'),
            'estados_nacimientos_clave' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'rfc' => mb_strtoupper($request->txt_rfc,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'celular' => $request->txt_celular,
            'tipo_vivienda' => mb_strtoupper($request->txt_tipo_vivienda,'UTF-8'),
            'direccion' => mb_strtoupper($request->txt_direccion,'UTF-8'),
            'anios_residencia' => mb_strtoupper($request->txt_residencia,'UTF-8'),
            'referencia' => mb_strtoupper($request->txt_referencia,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal,'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia,'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad,'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado,'UTF-8'),
            'fecha_alta' => $request->txt_fecha_alta,
            'escolaridad' => mb_strtoupper($request->txt_escolaridad,'UTF-8'),
            'profesion' => mb_strtoupper($request->txt_profesion,'UTF-8'),
            'religion' => mb_strtoupper($request->txt_religion,'UTF-8'),
            'estado_civil' => mb_strtoupper($request->txt_estado_civil,'UTF-8'),
            'clave_elector' => mb_strtoupper($request->txt_clave_elector,'UTF-8'),
            'anio_vencimiento_ine' => mb_strtoupper($request->txt_vencimiento_ine,'UTF-8'),
            'folio_ine' => mb_strtoupper($request->txt_folio_ine,'UTF-8'),
            'ocr' => mb_strtoupper($request->txt_ocr,'UTF-8'),
            'numero_tarjeta' => $request->txt_num_tarjeta,
            'numero_cuenta' => $request->txt_num_cuenta,
            'clave_interbancaria' => $request->txt_clave_interbancaria,
            'banco' => mb_strtoupper($request->txt_banco,'UTF-8'),
            'tipo_cliente' => mb_strtoupper($request->txt_tipo_cliente,'UTF-8'),
            'asociado_id' => $request->txt_nombre_asociado,
            'aval_id' => $request->txt_nombre_aval,
            'cuentas_id' => $request->txt_cuenta
        ]);
        return redirect()->route('admin.cliente.edit',[$id])->with('mensaje', 'Se ha editado el Cliente exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('admin.cliente.index');
        // return back()->with('success','Se ha borrado el asociado exitosamente');
    }

    public function existeCliente($claveElector){
        $clientExiste = Cliente::where('clave_elector','LIKE',"%$claveElector%")->count();
        //dd($cliente);
        return response()->json(["clientExiste" => $clientExiste]);
    }

    public function verProspecto($id){
        $prospectos = Prospecto::where('id', $id)->first();
        return response()->json(["prospectos" => $prospectos]);
    }
}
