<?php

namespace App\Http\Controllers;

use App\Prospecto;
use App\EstadoNacimiento;
use App\SucursalRuta;
use App\User;
use Illuminate\Http\Request;

class ProspectoController extends Controller
{
    //
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        if(auth()->user()->roles_id == 1){ ///si es administrador ve todo
            $prospectos = Prospecto::name($name)->where('estatus','Prospecto')->paginate(10);
        }else{
            $prospectos = Prospecto::name($name)->where('users_id',  auth()->user()->id)->where('estatus','Prospecto')->paginate(10);
        }
        return view('admin.prospectos.index', compact('prospectos','name'));
    }

    public function create()
    {
        $prospectos = Prospecto::all();
        $estados_nac = EstadoNacimiento::all();
        $rutas = SucursalRuta::all();
        return view('admin.prospectos.addProspectos', compact('prospectos','estados_nac','rutas'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $prospecto = new Prospecto();
        $user = User::where('id', auth()->user()->id)->first();
        $prospecto->users_id = auth()->user()->id;
        $prospecto->personals_id = $user["personals_id"];
        $prospecto->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $prospecto->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $prospecto->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $prospecto->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $prospecto->telefono = $request->input('txt_celular');
        $prospecto->fecha_nacimiento = $request->input('txt_fecha_nac');
        $prospecto->edad = mb_strtoupper($request->input('txt_edad'), 'UTF-8');
        $prospecto->genero = mb_strtoupper($request->input('txt_genero'), 'UTF-8');
        $prospecto->clave_estado_nacimiento = $request->input('txt_estado_nacimiento');
        $prospecto->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $prospecto->cp = $request->input('txt_codigo_postal');
        $prospecto->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $prospecto->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $prospecto->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $prospecto->sucursales_id = $request->input('txt_ruta');
        $prospecto->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $prospecto->tipo_vialidad = $request->input('txt_vialidad');
        $prospecto->entre_calles = mb_strtoupper($request->input('txt_entre_calles'), 'UTF-8');
        $prospecto->save();
        return redirect()->route('admin.prospecto.index');
    }

    public function edit($id)
    {
        $prospecto = Prospecto::where('id', $id)->first();
        $rutas = SucursalRuta::all(); 
        $nameRuta = "N/A";
        if($prospecto->ruta()->first('id') != null){
            $nameRuta = $prospecto->ruta()->first('id')->id;
        }

        $estados_nac = EstadoNacimiento::all(); 
        $opcionEstado = "N/A";
        if($prospecto->estadoNac()->first('clave') != null){
            $opcionEstado = $prospecto->estadoNac()->first('clave')->clave;
        }
        return view('admin.prospectos.edit', compact('prospecto','rutas','nameRuta','estados_nac','opcionEstado'));
    }

    public function update(Request $request, $id)
    {
        Prospecto::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre , 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno, 'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno , 'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => mb_strtoupper($request->txt_genero,'UTF-8'),
            'clave_estado_nacimiento' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'telefono' => $request->txt_celular,
            'direccion' => mb_strtoupper($request->txt_direccion,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal,'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia,'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad,'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado,'UTF-8'),
            'referencia' => mb_strtoupper($request->txt_referencia,'UTF-8'),
            'tipo_vialidad' => $request->txt_vialidad,
            'entre_calles' => mb_strtoupper($request->txt_entre_calles,'UTF-8')
        ]);
        return redirect()->route('admin.prospecto.edit',[$id])->with('mensaje', 'Se ha editado el Prospecto exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }

    public function loginCliente(){
        $estados_nac = EstadoNacimiento::all();
        return view('admin.prospectos.loginCliente', compact('estados_nac'));
    }

    public function listadoEncuestas(Request $request){
        if($request->txt_curp){
            $prospectos = Prospecto::where('curp','LIKE',"%$request->txt_curp%")->count();
            if(!empty($prospectos)){
                return back()->with('mensaje', 'Este Cliente ya existe');
            }else{
                $prospecto = new Prospecto();
                $prospecto->nombre = mb_strtoupper($request->input('nombres'), 'UTF-8');
                $prospecto->apellido_paterno = mb_strtoupper($request->input('apellido_paterno'), 'UTF-8');
                $prospecto->apellido_materno = mb_strtoupper($request->input('apellido_materno'), 'UTF-8');
                $prospecto->direccion = mb_strtoupper($request->input('direccion'), 'UTF-8');
                $prospecto->telefono = $request->input('txt_celular');
                $prospecto->fecha_nacimiento = $request->input('txt_fecha_nac');
                $prospecto->edad = mb_strtoupper($request->input('txt_edad'), 'UTF-8');
                $prospecto->genero = mb_strtoupper($request->input('genero'), 'UTF-8');
                $prospecto->clave_estado_nacimiento = $request->input('txt_estado_nacimiento');
                $prospecto->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
                $prospecto->cp = $request->input('txt_codigo_postal');
                $prospecto->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
                $prospecto->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
                $prospecto->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
                $prospecto->referencia = mb_strtoupper($request->input('referencias'), 'UTF-8');
                $prospecto->entre_calles = mb_strtoupper($request->input('entre_calles'), 'UTF-8');
                $prospecto->save();
                return back()->with('mensaje', 'Tus datos se han enviado exitosamente');
            }
        }
    }
    

}
