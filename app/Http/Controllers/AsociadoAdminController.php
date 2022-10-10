<?php

namespace App\Http\Controllers;

use App\Asociado;
use App\Personal;
use App\Puesto;
use App\SucursalRuta;

use Illuminate\Http\Request;

class AsociadoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $asociados = Asociado::name($name)->paginate(10);
        return view('admin.asociados.index', compact('asociados','name'));
    }

    public function create()
    {
        $operadores = Personal::all();
        $puestos = Puesto::all();
        $rutas = SucursalRuta::all();
        return view('admin.asociados.addAsociados', compact('operadores','puestos','rutas'));

    }

    public function store(Request $request)
    {
        // dd($request);
        $asociado = new Asociado();
        $asociado->users_id = auth()->user()->id;
        $asociado->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $asociado->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $asociado->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $asociado->fecha_nacimiento = $request->input('txt_fecha_nac');
        $asociado->edad = $request->input('txt_edad');
        $asociado->genero = mb_strtoupper($request->input('txt_genero'), 'UTF-8');
        $asociado->ciudad_nacimiento = mb_strtoupper($request->input('txt_ciudad_nacimiento'), 'UTF-8');
        $asociado->nacionalidad = mb_strtoupper($request->input('txt_nacionalidad'), 'UTF-8');
        $asociado->estado_nacimiento = mb_strtoupper($request->input('txt_estado_nacimiento'), 'UTF-8');
        $asociado->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $asociado->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $asociado->celular = $request->input('txt_celular');
        $asociado->tipo_vivienda = mb_strtoupper($request->input('txt_tipo_vivienda'), 'UTF-8');
        $asociado->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $asociado->anios_residencia = mb_strtoupper($request->input('txt_residencia'), 'UTF-8');
        $asociado->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $asociado->cp = $request->input('txt_codigo_postal');
        $asociado->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $asociado->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $asociado->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $asociado->puesto = mb_strtoupper($request->input('txt_puesto'), 'UTF-8');
        $asociado->fecha_alta = $request->input('txt_fecha_alta');
        $asociado->escolaridad = mb_strtoupper($request->input('txt_escolaridad'), 'UTF-8');
        $asociado->profesion = mb_strtoupper($request->input('txt_profesion'), 'UTF-8');
        $asociado->religion = mb_strtoupper($request->input('txt_religion'), 'UTF-8');
        $asociado->estado_civil = mb_strtoupper($request->input('txt_estado_civil'), 'UTF-8');
        $asociado->clave_elector = mb_strtoupper($request->input('txt_clave_elector'), 'UTF-8');
        $asociado->anio_vencimiento_ine = $request->input('txt_vencimiento_ine');
        $asociado->folio_ine = mb_strtoupper($request->input('txt_folio_ine'), 'UTF-8');
        $asociado->ocr = mb_strtoupper($request->input('txt_ocr'), 'UTF-8');
        $asociado->numero_tarjeta = $request->input('txt_num_tarjeta');
        $asociado->numero_cuenta = $request->input('txt_num_cuenta');
        $asociado->clave_interbancaria = $request->input('txt_clave_interbancaria');
        $asociado->banco = mb_strtoupper($request->input('txt_banco'), 'UTF-8');
        $asociado->minimo_clientes = $request->input('txt_min_cliente');
        $asociado->maximo_clientes = $request->input('txt_max_cliente');
        $asociado->personals_id = $request->input('txt_operador');
        $asociado->sucursales_id = $request->input('txt_ruta');
        $asociado->save();
        // return redirect('admin/asociados/addasociados')->with('success', 'Se ha agregado el puesto exitosamente');
        return redirect()->route('admin.asociado.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $asociado = Asociado::where('id', $id)->first();
        $operadores = Personal::all(); 
        $personOperador = "N/A";
        if($asociado->operadores()->first('id') != null){
            $personOperador = $asociado->operadores()->first('id')->id;
        }
        $puestos = Puesto::all(); 
        $namePuesto = "N/A";
        if($asociado->namePuesto()->first('id') != null){
            $namePuesto = $asociado->namePuesto()->first('id')->id;
        }

        $rutas = SucursalRuta::all(); 
        $nameRuta = "N/A";
        if($asociado->ruta()->first('id') != null){
            $nameRuta = $asociado->ruta()->first('id')->id;
        }
        return view('admin.asociados.editAsociados', compact('asociado', 'operadores','personOperador','puestos','namePuesto','rutas','nameRuta'));
    }

    public function update(Request $request, $id)
    {
        Asociado::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre, 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno,'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno,'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => mb_strtoupper($request->txt_genero,'UTF-8'),
            'ciudad_nacimiento' => mb_strtoupper($request->txt_ciudad_nacimiento,'UTF-8'),
            'estado_nacimiento' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'rfc' => mb_strtoupper($request->txt_rfc,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'celular' => $request->txt_celular,
            'tipo_vivienda' => mb_strtoupper($request->txt_tipo_vivienda, 'UTF-8'),
            'direccion' => mb_strtoupper($request->txt_direccion, 'UTF-8'),
            'anios_residencia' => mb_strtoupper($request->txt_residencia,'UTF-8'),
            'referencia' => mb_strtoupper($request->txt_referencia,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal, 'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia, 'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad, 'UTF-8'),
            'nacionalidad' => mb_strtoupper($request->txt_nacionalidad, 'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado, 'UTF-8'),
            'puesto' => mb_strtoupper($request->txt_puesto, 'UTF-8'),
            'fecha_alta' => $request->txt_fecha_alta,
            'escolaridad' =>  mb_strtoupper($request->txt_escolaridad, 'UTF-8'),
            'profesion' =>  mb_strtoupper($request->txt_profesion, 'UTF-8'),
            'religion' =>  mb_strtoupper($request->txt_religion, 'UTF-8'),
            'estado_civil' =>  mb_strtoupper($request->txt_estado_civil, 'UTF-8'),
            'clave_elector' =>  mb_strtoupper($request->txt_clave_elector, 'UTF-8'),
            'anio_vencimiento_ine' =>  mb_strtoupper($request->txt_vencimiento_ine, 'UTF-8'),
            'folio_ine' =>  mb_strtoupper($request->txt_folio_ine, 'UTF-8'),
            'ocr' =>  mb_strtoupper($request->txt_ocr, 'UTF-8'),
            'numero_tarjeta' => $request->txt_num_tarjeta,
            'numero_cuenta' => $request->txt_num_cuenta,
            'clave_interbancaria' => $request->txt_clave_interbancaria,
            'banco' => mb_strtoupper($request->txt_banco, 'UTF-8'),
            'minimo_clientes' => $request->txt_min_cliente,
            'maximo_clientes' => $request->txt_max_cliente,
            'personals_id' => $request->txt_operador,
            'sucursales_id' => $request->txt_ruta
        ]);
        return redirect()->route('admin.asociado.edit',[$id])->with('mensaje', 'Se ha editado el Asociado exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }

    public function destroy($id)
    {
        $asociado = Asociado::find($id);
        $asociado->delete();
        return redirect()->route('admin.asociado.index');
        // return back()->with('success','Se ha borrado el asociado exitosamente');
    }
}
