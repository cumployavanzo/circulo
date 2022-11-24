<?php

namespace App\Http\Controllers;

use App\Aval;
use App\Exports\AvalesExport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class AvalController extends Controller
{
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        if($request->estatus){
            $avales = Aval::where('state', $request->estatus)->name($name)->paginate(10);
        }else{
            $avales = Aval::name($name)->paginate(10);
        }
        $estatusInactivo = Aval::where('state', 'Inactivo')->get();
        $estatusActivo = Aval::where('state', 'Activo')->get();
        return view('admin.avales.index', compact('avales','name','estatusActivo','estatusInactivo'));
    }

    public function create()
    {
        $avales = Aval::all();
        return view('admin.avales.addClientes', compact('avales'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $aval = new Aval();
        $aval->users_id = auth()->user()->id;
        $aval->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $aval->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $aval->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $aval->fecha_nacimiento = $request->input('txt_fecha_nac');
        $aval->edad = $request->input('txt_edad');
        $aval->genero = mb_strtoupper($request->input('txt_genero'), 'UTF-8');
        $aval->ciudad_nacimiento = mb_strtoupper($request->input('txt_ciudad_nacimiento'), 'UTF-8');
        $aval->nacionalidad = mb_strtoupper($request->input('txt_nacionalidad'), 'UTF-8');
        $aval->estado_nacimiento = mb_strtoupper($request->input('txt_estado_nacimiento'), 'UTF-8');
        $aval->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $aval->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $aval->parentesco = $request->input('txt_parentesco');
        $aval->celular = $request->input('txt_celular');
        $aval->tipo_vivienda = mb_strtoupper($request->input('txt_tipo_vivienda'), 'UTF-8');
        $aval->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $aval->anios_residencia = mb_strtoupper($request->input('txt_residencia'), 'UTF-8');
        $aval->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $aval->cp = $request->input('txt_codigo_postal');
        $aval->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $aval->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $aval->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $aval->fecha_alta = $request->input('txt_fecha_alta');
        $aval->escolaridad = mb_strtoupper($request->input('txt_escolaridad'), 'UTF-8');
        $aval->profesion = mb_strtoupper($request->input('txt_profesion'), 'UTF-8');
        $aval->religion = mb_strtoupper($request->input('txt_religion'), 'UTF-8');
        $aval->estado_civil = mb_strtoupper($request->input('txt_estado_civil'), 'UTF-8');
        $aval->clave_elector = mb_strtoupper($request->input('txt_clave_elector'), 'UTF-8');
        $aval->anio_vencimiento_ine = $request->input('txt_vencimiento_ine');
        $aval->folio_ine = mb_strtoupper($request->input('txt_folio_ine'), 'UTF-8');
        $aval->ocr = mb_strtoupper($request->input('txt_ocr'), 'UTF-8');
        $aval->numero_tarjeta = $request->input('txt_num_tarjeta');
        $aval->numero_cuenta = $request->input('txt_num_cuenta');
        $aval->clave_interbancaria = $request->input('txt_clave_interbancaria');
        $aval->banco = mb_strtoupper($request->input('txt_banco'), 'UTF-8');
        $aval->save();
        return redirect()->route('admin.aval.index');
    }

    public function edit($id)
    {
        $aval = Aval::where('id', $id)->first();
        return view('admin.avales.edit', compact('aval'));
    }

    public function update(Request $request, $id)
    {
        Aval::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre , 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno, 'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno , 'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => mb_strtoupper($request->txt_genero,'UTF-8'),
            'ciudad_nacimiento' => mb_strtoupper($request->txt_ciudad_nacimiento,'UTF-8'),
            'nacionalidad' => mb_strtoupper($request->txt_nacionalidad, 'UTF-8'),
            'estado_nacimiento' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'rfc' => mb_strtoupper($request->txt_rfc,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'parentesco' => $request->txt_parentesco,
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
            'banco' => mb_strtoupper($request->txt_banco,'UTF-8')
        ]);
        return redirect()->route('admin.aval.edit',[$id])->with('mensaje', 'Se ha editado el Aval exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }

    public function existeCliente($claveElector){
        $clientExiste = Aval::where('clave_elector','LIKE',"%$claveElector%")->count();
        //dd($cliente);
        return response()->json(["clientExiste" => $clientExiste]);
    }

    public function reporteAvales(){
        $data = Aval::orderBy('nombre', 'ASC')->orderBy('apellido_paterno', 'ASC');
        return Excel::download(new AvalesExport($data->get()), 'avales'. '.xlsx');
    }

    public function actualizarEstadoAval($id){
        $state = Aval::where('id', $id)->pluck('state');
        if($state[0] == 'Activo') {
            Aval::where('id', $id)->update([
                'state' => 'Inactivo'
            ]);
        }else{
            Aval::where('id', $id)->update([
                'state' => 'Activo'
            ]);
        }
        return response()->json(["data" => "ok"]);
    }
}
