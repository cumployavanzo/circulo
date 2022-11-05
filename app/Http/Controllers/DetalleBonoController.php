<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleBono;
use App\Bono;


class DetalleBonoController extends Controller
{
    //

    public function verDetallesBono($id){
        $detalles = DetalleBono::where('id', $id)->first();
        return response()->json(["detalles" => $detalles]);
    }

    public function store(Request $request)
    {
        if($request->txt_monto_recuperado){
            $monto_recuperado =  (str_replace(",","",$request->input('txt_monto_recuperado')));
        }else{
            $monto_recuperado = "0.00";
        }

        if($request->txt_monto_recuperar){
            $monto_recuperar =  (str_replace(",","",$request->input('txt_monto_recuperar')));
        }else{
            $monto_recuperar = "0.00";
        } 
        DetalleBono::where('id', $request->idDetalleBono)->update([
            'sucursales_id' => $request->txt_ruta,
            'cuentas_asignadas' => $request->txt_cuentas_asignadas,
            'cuentas_cobradas' => $request->txt_cuentas_cobradas,
            'monto_a_recuperar' => $monto_recuperar,
            'monto_recuperado' => $monto_recuperado,
        ]);

        if(!empty($request->txt_cuentas_cobradas)){
            $porcentaje_cobrado = ($request->txt_cuentas_cobradas / $request->txt_cuentas_asignadas) * 100;
            DetalleBono::where('id', $request->idDetalleBono)->update([
                'porcentaje_cobrado' => $porcentaje_cobrado,
            ]);
        }
        if(!empty($request->txt_monto_recuperado)){
            $porcentaje_recuperado = ((str_replace(",","",$request->input('txt_monto_recuperado'))) / (str_replace(",","",$request->input('txt_monto_recuperar')))) * 100;
            DetalleBono::where('id', $request->idDetalleBono)->update([
                'porcentaje_recuperado' => $porcentaje_recuperado,
            ]);

        }

        $bonos = DetalleBono::where('bonos_id', $request->idBono)->get(); // ->with(')
        $porcentajeCobrado = round(($bonos->sum('porcentaje_cobrado') / 6),2);
        $porcentajeRecuperado = round(($bonos->sum('porcentaje_recuperado') / 6),2);
        Bono::where('id', $request->idBono)->update([
            'tot_porcent_cobrado' => $porcentajeCobrado,
            'tot_porcent_recuperado' => $porcentajeRecuperado,
        ]);


        return redirect()->route('admin.bono.edit', [$request->idBono]);
    }

   
}
