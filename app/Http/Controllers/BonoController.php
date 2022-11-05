<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bono;
use App\Personal;
use App\SucursalRuta;
use App\DetalleBono;
use DateTime;
use Carbon\Carbon;


class BonoController extends Controller
{
    //
    public function index(Request $request)
    {
        // $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $bonos = Bono::paginate(10);
        return view('admin.bonos.index', compact('bonos'));
    }

    public function create()
    {
        $bonos = Bono::all();
        $rutas = SucursalRuta::where('state','Activo')->get();
        $personals = Personal::where('state','Activo')->get();
        return view('admin.bonos.addBonos', compact('bonos','personals','rutas'));
    }

    public function store(Request $request)
    {
        $bono = new Bono();
        $bono->users_id = auth()->user()->id;
        $bono->personals_id = $request->input('Fk_empleado');
        $bono->save();
        $bonoID= $bono["id"];
        $idEmpleado= $request->Fk_empleado;


        $semana = array(
                "Lunes",
                "Martes",
                "Miercoles",
                "Jueves",
                "Viernes",
                "Sabado",
        );
        $dateS =  str_replace('/', '-', $request->fecha_inicial);
        $fecha = date('Y-m-d', strtotime($dateS));
        $fecha = Carbon::parse($fecha);
        
        foreach($semana as $dia){
            $detalles = new DetalleBono();
            $detalles->bonos_id = $bonoID;
            $detalles->fecha = $fecha;
            $detalles->dia = $dia;
            $detalles->save();
            $fecha->addDays(1)->format('d/m/Y');
        }
        
    
        return redirect()->route('admin.bono.edit', [$bonoID]);
    }

    public function edit(Request $request,$bonoID)
    {
        $bonos = Bono::where('id', $bonoID)->first(); // ->with(')
        $detalles = DetalleBono::where('bonos_id', $bonoID)->get();
        $rutas = SucursalRuta::where('state','Activo')->get();

        return view('admin.bonos.editBonos', compact('bonos','detalles','rutas'));
    }
}
