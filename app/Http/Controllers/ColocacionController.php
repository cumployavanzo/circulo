<?php

namespace App\Http\Controllers;
use App\Colocacion;
use App\ProductosSeg;
use App\Cliente;
use App\PrimaSuma;
use App\Personal;

use Illuminate\Http\Request;

class ColocacionController extends Controller
{
    //

    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
       
        if($request->estatus){
            $solicitudes = Colocacion::select('solicitudseguros.*')->where('solicitudseguros.estado_solseg', $request->estatus) ->name($name)
            ->join('clientes', 'clientes.id', '=', 'solicitudseguros.clientes_id')
            ->paginate(10);
        }else{
            $solicitudes = Colocacion::select('solicitudseguros.*')
            ->name($name)
            ->join('clientes', 'clientes.id', '=', 'solicitudseguros.clientes_id')
            ->paginate(10);
        }

      
        return view('admin.colocacion.index', compact('solicitudes','name'));
    }


    public function create()
    {
        $productoSeg = ProductosSeg::all();
        $personal = Personal::all();
        return view('admin.colocacion.addSolicitudSeguro', compact('productoSeg','personal'));

    }

    public function store(Request $request)
    {
        //  dd($request);
        $colocacion = new Colocacion();
        $colocacion->users_id = auth()->user()->id;
        $colocacion->clientes_id = $request->input('idCliente');
        $colocacion->fecha_solicitud = date("Y-m-d"); ;
        $colocacion->personals_id = $request->input('txt_nombre_promotor');
        $colocacion->primasuma_id = $request->input('txt_montos'); /// aqui viene el id de la primasuma        
        $colocacion->estado_solseg = 'Terminado';
        $colocacion->save();
        return redirect()->route('admin.colocacion.index');
    }


    public function obtenerDetallesCliente($curp){
        $curpstr = strtoupper($curp);
        $cliente = Cliente::where('curp','LIKE',"%$curpstr%")->first();
        return response()->json(["cliente" => $cliente]);
    }


    public function verPeriodo($idProducto){
        \DB::statement("SET SQL_MODE=''");
        $periodos = PrimaSuma::select('periodo.id','periodo.descripcion')
        ->where('productoSeguro_id', $idProducto)
        ->join('periodo', 'periodo.id', '=', 'primas_sumas.periodo_id')
        ->groupBy('primas_sumas.periodo_id')
        ->get();
        // $periodos = Personal::where('id', $idProducto)->first()->puestoid->areas;
        return response()->json(["periodos" => $periodos]);
    }

    public function detallesMontoSeg(Request $request){
        $montos = PrimaSuma::where('productoSeguro_id', $request->idProducto)->where('periodo_id',$request->idPeriodo)->get();
        return response()->json(["montos" => $montos]);
    }

    public function obtenerMonto($idPrimaSuma){
        $precios = PrimaSuma::where('id_primasuma',$idPrimaSuma)->pluck('monto');
        return response()->json(["precios" => $precios]);
    }
}
