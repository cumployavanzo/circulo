<?php

namespace App\Http\Controllers;

use App\Personal;
use App\Puesto;
use App\HistorialBaja;
use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PersonalAdminController extends Controller
{
    public $PersonalController;

    public function __construct()
    {
        $this->PersonalController = new PersonalController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        if($request->estatus){
            $personales = Personal::where('state', $request->estatus)->name($name)->paginate(10);
        }else{
            $personales = Personal::name($name)->paginate(10);
        }
        $stateBaja = Personal::where('state', 'Baja')->get();
        $stateActivo = Personal::where('state', 'Activo')->get();
        // $personales =  $this->PersonalController->getPersonalPaginate($request); /////esto es igual, funciona con el metodo
        return view('admin.personales.index', compact('personales','stateBaja','stateActivo','name'));
    }

    public function create()
    {
        $puestos = Puesto::all();
        return view('admin.personales.addPersonal', compact('puestos'));

    }

    public function store(Request $request)
    {
        $personal = new Personal();
        $personal->users_id = auth()->user()->id;
        $personal->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $personal->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $personal->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $personal->fecha_nacimiento = $request->input('txt_fecha_nac');
        $personal->edad = $request->input('txt_edad');
        $personal->genero = mb_strtoupper($request->input('txt_genero'), 'UTF-8');
        $personal->ciudad_nacimiento = mb_strtoupper($request->input('txt_ciudad_nacimiento'), 'UTF-8');
        $personal->nacionalidad = mb_strtoupper($request->input('txt_nacionalidad'), 'UTF-8');
        $personal->estado_nacimiento = mb_strtoupper($request->input('txt_estado_nacimiento'), 'UTF-8');
        $personal->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $personal->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $personal->celular = $request->input('txt_celular');
        $personal->imss = $request->input('txt_imss');
        $personal->tipo_vivienda = mb_strtoupper($request->input('txt_tipo_vivienda'), 'UTF-8');
        $personal->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $personal->anios_residencia = mb_strtoupper($request->input('txt_residencia'), 'UTF-8');
        $personal->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $personal->cp = $request->input('txt_codigo_postal');
        $personal->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $personal->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $personal->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $personal->puesto = mb_strtoupper($request->input('txt_puesto'), 'UTF-8');
        $personal->fecha_alta = $request->input('txt_fecha_alta');
        $personal->escolaridad = mb_strtoupper($request->input('txt_escolaridad'), 'UTF-8');
        $personal->profesion = mb_strtoupper($request->input('txt_profesion'), 'UTF-8');
        $personal->religion = mb_strtoupper($request->input('txt_religion'), 'UTF-8');
        $personal->estado_civil = mb_strtoupper($request->input('txt_estado_civil'), 'UTF-8');
        $personal->clave_elector = mb_strtoupper($request->input('txt_clave_elector'), 'UTF-8');
        $personal->anio_vencimiento_ine = $request->input('txt_vencimiento_ine');
        $personal->folio_ine = mb_strtoupper($request->input('txt_folio_ine'), 'UTF-8');
        $personal->ocr = mb_strtoupper($request->input('txt_ocr'), 'UTF-8');
        $personal->numero_tarjeta = $request->input('txt_num_tarjeta');
        $personal->numero_cuenta = $request->input('txt_num_cuenta');
        $personal->clave_interbancaria = $request->input('txt_clave_interbancaria');
        $personal->banco = mb_strtoupper($request->input('txt_banco'), 'UTF-8');
        $personal->sueldo_mensual = (str_replace(",","",$request->input('txt_sueldo_mensual')));
        $personal->tipo_contrato = $request->input('txt_tipo_contrato');

        $personal->save();
        // return redirect('admin/personales/addpersonal')->with('success', 'Se ha agregado el puesto exitosamente');
        return redirect()->route('admin.personal.index');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::where('id', $id)->first();
        $puestos = Puesto::all(); 
        $opcionPuesto = "N/A";
        if($personal->puestoid()->first('id') != null){
            $opcionPuesto = $personal->puestoid()->first('id')->id;
        }

        return view('admin.personales.editPersonal', compact('personal','puestos','opcionPuesto'));
    }

    public function update(Request $request, $id)
    {
        Personal::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre, 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno,'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno,'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => mb_strtoupper($request->txt_genero,'UTF-8'),
            'ciudad_nacimiento' => mb_strtoupper($request->txt_ciudad_nacimiento,'UTF-8'),
            'nacionalidad' => mb_strtoupper($request->txt_nacionalidad, 'UTF-8'),
            'estado_nacimiento' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'rfc' => mb_strtoupper($request->txt_rfc,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'celular' => $request->txt_celular,
            'imss' => mb_strtoupper($request->txt_imss,'UTF-8'),
            'tipo_vivienda' => mb_strtoupper($request->txt_tipo_vivienda,'UTF-8'),
            'direccion' => mb_strtoupper($request->txt_direccion,'UTF-8'),
            'anios_residencia' => mb_strtoupper($request->txt_residencia,'UTF-8'),
            'referencia' => mb_strtoupper($request->txt_referencia,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal,'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia,'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad,'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado,'UTF-8'),
            'puesto' => mb_strtoupper($request->txt_puesto,'UTF-8'),
            'fecha_alta' => $request->txt_fecha_alta,
            'escolaridad' => mb_strtoupper($request->txt_escolaridad,'UTF-8'),
            'profesion' => mb_strtoupper($request->txt_profesion,'UTF-8'),
            'religion' => mb_strtoupper($request->txt_religion,'UTF-8'),
            'estado_civil' => mb_strtoupper($request->txt_estado_civil,'UTF-8'),
            'clave_elector' => mb_strtoupper($request->txt_clave_elector,'UTF-8'),
            'anio_vencimiento_ine' => mb_strtoupper($request->txt_vencimiento_ine,'UTF-8'),
            'folio_ine' => mb_strtoupper($request->txt_folio_ine,'UTF-8'),
            'ocr' => $request->txt_ocr,
            'numero_tarjeta' => $request->txt_num_tarjeta,
            'numero_cuenta' => $request->txt_num_cuenta,
            'clave_interbancaria' => $request->txt_clave_interbancaria,
            'banco' => mb_strtoupper($request->txt_banco,'UTF-8'),
            'sueldo_mensual' => (str_replace(",","",$request->txt_sueldo_mensual)),
            'tipo_contrato' => $request->txt_tipo_contrato
        ]);
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
        return redirect()->route('admin.personal.edit',[$id])->with('mensaje', 'Se ha editado el Personal exitosamente');

    }

    public function destroy($id)
    {
        $personal = Personal::find($id);
        $personal->delete();
        // return back()->with('success','Se ha borrado el Personal exitosamente');
        return redirect()->route('admin.personal.index');

    }

    public function verDetalleEmpleado($idEmpleado){
        $personal = Personal::where('id', $idEmpleado)->first();
        return response()->json(["personal" => $personal]);
    }

    public function baja(Request $request)
    {
        // dd($request);
        $baja = new HistorialBaja();
        $baja->users_id = auth()->user()->id;
        $baja->personals_id = $request->input('idEmpleado');
        $baja->motivo_baja = $request->input('txt_motivo_baja');
        $baja->fecha_baja = $request->input('fecha_baja');
        $baja->tipo_movimiento = 'BAJA';
        $baja->observaciones = mb_strtoupper($request->input('observaciones'), 'UTF-8');
        $baja->save();
        Personal::where('id', $request->input('idEmpleado'))->update([
            'state' => 'Baja',
        ]);
        return redirect()->route('admin.personal.index');
    }

    public function tablaEmpleados(Request $request){
        $row = HistorialBaja::where('personals_id', $request->idEmpleado)->get();
        $tableEmpleado['tbody'] = '';
        if($row){  
            foreach ($row as $val){
                $tableEmpleado['tbody'].='<tr><td>'.$val->id.'</td>
                <td>'.$val->usuario->personal->getFullName().'</td>
                <td>'.Carbon::parse($val->created_at)->format('d/m/Y H:i:s').'</td>
                <td>'.$val->tipo_movimiento.'</td>
                <td>'.Carbon::parse($val->fecha_baja)->format('d/m/Y').'</td>
                <td>'.$val->observaciones.'</td></tr>';
            }
        }else{
            $tableEmpleado['tbody']='<tr align="center"><td colspan="6">No existen registros</td></tr>';
        }

        return json_encode($tableEmpleado);

    }  
}
