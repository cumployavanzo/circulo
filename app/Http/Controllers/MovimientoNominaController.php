<?php

namespace App\Http\Controllers;
use App\MovimientoNomina;
use App\DetalleNomina;
use App\ConceptoNomina;
use App\Nomina;
use App\PrestamoPersonal;
use App\DetallePrestamo;

use Illuminate\Http\Request;

class MovimientoNominaController extends Controller
{
    //
    public function create(Request $request)
    {

        $detalleNomina = DetalleNomina::where('id', $request->idDetalle)->first(); 
        $nomina = Nomina::where('id', $detalleNomina->nomina_id)->first(); 
        $movDetalles = MovimientoNomina::where('detalle_nomina_id', $request->idDetalle)->get(); 
        $conceptoNomina = ConceptoNomina::all();
        
        return view('admin.nominas.addMovimientos', compact('detalleNomina','conceptoNomina','nomina','movDetalles'));
    }

    public function edit(Request $request,$idDetalleN)
    {
        $detalleNomina = DetalleNomina::where('id', $idDetalleN)->first(); 
        $nomina = Nomina::where('id', $detalleNomina->nomina_id)->first(); 
        $movDetalles = MovimientoNomina::where('detalle_nomina_id', $idDetalleN)->get(); 
        $conceptoNomina = ConceptoNomina::all();
        
        return view('admin.nominas.editMovimientos', compact('detalleNomina','conceptoNomina','nomina','movDetalles'));
    }


    public function store(Request $request)
    {
        // dd($request);
            $movimientoNom = new MovimientoNomina();

            $mov = MovimientoNomina::where('detalle_nomina_id', $request->idDetalle)->where('conceptos_nomina_id',$request->txt_concepto_nomina)->first();
            if($mov) {
                session()->flash('errorMessage', '¡¡ Este concepto ya fue agregado !!');
                return redirect()->back();
            } 

            $movimientoNom->detalle_nomina_id = $request->idDetalle;
            $movimientoNom->conceptos_nomina_id = $request->input('txt_concepto_nomina');
            if($request->idDetallePrestamo){
                $movimientoNom->monto = (str_replace(",","",$request->input('monto_prestamo')));
                DetallePrestamo::where('id', $request->idDetallePrestamo)->update([
                    'estatus' => 'Descontado',
                    'detalle_nomina_id' => $request->idDetalle,
                    'users_id' => auth()->user()->id,
                ]);
            }else{
                $movimientoNom->monto = (str_replace(",","",$request->input('txt_monto')));
            }
            $movimientoNom->save();  
            $movimientoID= $movimientoNom["id"];
            // $Nomina = Nomina::where('id', $nominaID)->first();
            $sueldo= $request->sueldo;
            $detalleMovimiento = MovimientoNomina::where('id', $movimientoID)->get();

            $totalPersepcion = 0;
            $totalDeduccion = 0;

            $detalleP = MovimientoNomina::select('movimiento_nomina.*')
            ->where('detalle_nomina_id', $request->idDetalle)
            ->where('tipo','=','Persepcion')
            ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'movimiento_nomina.conceptos_nomina_id')
            ->get();
            foreach($detalleP as $persepcion){
                $totalPersepcion += $persepcion->monto;
            }
            $detalleD = MovimientoNomina::select('movimiento_nomina.*')
            ->where('detalle_nomina_id', $request->idDetalle)
            ->where('tipo','=','Deduccion')
            ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'movimiento_nomina.conceptos_nomina_id')
            ->get();
            foreach($detalleD as $deduccion){
                $totalDeduccion += $deduccion->monto;
            }


           if($detalleMovimiento[0]->concepto->tipo == 'Persepcion'){
                DetalleNomina::where('id', $request->idDetalle)->update([
                    'tot_persepcion' => $totalPersepcion,
                ]);
            }else if($detalleMovimiento[0]->concepto->tipo == 'Deduccion'){
                DetalleNomina::where('id', $request->idDetalle)->update([
                    'tot_deduccion' => $totalDeduccion,
                ]);
            } 
            DetalleNomina::where('id', $request->idDetalle)->update([
                // 'sueldo' => $sueldo,
                'neto_pagar' => ($sueldo + $totalPersepcion) - $totalDeduccion,
            ]);
        
        return redirect()->route('admin.movNomina.edit', [$request->idDetalle]);
    }

    public function detallesPrestamoP(Request $request){
        $prestamos = PrestamoPersonal::where('personals_id', $request->idEmpleado)->where('conceptos_nomina_id',$request->IDconcepto)->first();
        $pagosP = DetallePrestamo::where('prestamo_personal_id',$prestamos->id)->where('estatus','Pendiente')->count();

        if($pagosP){
            $detalles = DetallePrestamo::where('prestamo_personal_id',$prestamos->id)->where('estatus','Pendiente')->first();
        }else{
            $detalles = '';
            $pagosP ='';
        }
        return response()->json(["prestamos" => $prestamos,"detalles" => $detalles,"pagosP" => $pagosP]);
    }
}
