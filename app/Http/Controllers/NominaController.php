<?php

namespace App\Http\Controllers;
use App\Nomina;
use App\Personal;
use App\ConceptoNomina;
use App\DetalleNomina;
use App\PrestamoPersonal;
use App\DetallePrestamo;
use App\MovimientoNomina;
use PDF;
use Illuminate\Http\Request;

class NominaController extends Controller
{
    //
    public function index()
    {
        \DB::statement("SET SQL_MODE=''");
        $nominas = Nomina::select('nomina.*')
        ->selectRaw('SUM(neto_pagar) as total_pagar')
        ->join('detalle_nomina', 'detalle_nomina.nomina_id', '=', 'nomina.id')
        ->groupBy('nomina_id')
        ->paginate(10);
        
        return view('admin.nominas.index', compact('nominas'));
    }

    public function create()
    {
        $personals = Personal::where('state','Activo')->get();
        $conceptoNomina = ConceptoNomina::all();
        return view('admin.nominas.addNomina', compact('personals','conceptoNomina'));
    }

    public function detallesPersonal($id){
        $personals = Personal::where('id', $id)->first();
        return response()->json(["personals" => $personals]);
    }

    // public function store(Request $request)
    // {
    //     //   dd($request);
    //     if($request->idNomina == 0){
    //         $nomina = new Nomina();
    //         $nomina->users_id = auth()->user()->id;
    //         $nomina->personals_id = $request->input('Fk_empleado');
    //         $nomina->modalidad = mb_strtoupper($request->input('txt_modalidad'), 'UTF-8');
    //         $nomina->sueldo = (str_replace(",","",$request->input('sueldo')));
    //         $nomina->fecha_corte_ini = $request->input('fecha_inicial');
    //         $nomina->fecha_corte_fin = $request->input('fecha_final');
    //         $nomina->save();
    //         $nominaID= $nomina["id"];
    //         $sueldo= $nomina["sueldo"];
    //     }else{
    //         $nomina = new Nomina();
    //         $nominaID = $request->idNomina;
    //     }
    
    
       
    //     if($nominaID){
    //         $detalleNom = new DetalleNomina();
    //         $detalleNom->nomina_id = $nominaID;
    //         $detalleNom->conceptos_nomina_id = $request->input('txt_concepto_nomina');
    //         $detalleNom->monto_descuento = (str_replace(",","",$request->input('txt_monto')));
    //         $detalleNom->save();  
    //         $detalleID= $detalleNom["id"];
    //         $Nomina = Nomina::where('id', $nominaID)->first();
    //         $sueldo= $Nomina->sueldo;
    //         $detalleNomina = DetalleNomina::where('id', $detalleID)->get();

    //         $totalPersepcion = 0;
    //         $totalDeduccion = 0;

    //         $detalleP = DetalleNomina::select('detalle_nomina.*')
    //         ->where('nomina_id', $nominaID)
    //         ->where('tipo','=','Persepcion')
    //         ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'detalle_nomina.conceptos_nomina_id')
    //         ->get();
    //         foreach($detalleP as $persepcion){
    //             $totalPersepcion += $persepcion->monto_descuento;

    //         }
    //         $detalleD = DetalleNomina::select('detalle_nomina.*')
    //         ->where('nomina_id', $nominaID)
    //         ->where('tipo','=','Deduccion')
    //         ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'detalle_nomina.conceptos_nomina_id')
    //         ->get();
    //         foreach($detalleD as $deduccion){
    //             $totalDeduccion += $deduccion->monto_descuento;
    //         }


    //        if($detalleNomina[0]->concepto->tipo == 'Persepcion'){
    //             Nomina::where('id', $nominaID)->update([
    //                 'total_persepciones' => $totalPersepcion,
    //             ]);
    //         }else if($detalleNomina[0]->concepto->tipo == 'Deduccion'){
    //             Nomina::where('id', $nominaID)->update([
    //                 'total_deducciones' => $totalDeduccion,
    //             ]);
    //         } 
    //         Nomina::where('id', $nominaID)->update([
    //             'neto_pagar' => ($sueldo + $totalPersepcion) - $totalDeduccion,
    //         ]);
    //     }
    //     return redirect()->route('admin.nomina.edit', [$nominaID]);
    // }
    
    public function store(Request $request)
    {
        $datosEmpleado = Personal::where('id',$request->input('Fk_empleado'))->first();

       

        if($datosEmpleado->sueldo_mensual == null) {
            session()->flash('errorMessage', 'Favor de agregar el sueldo al Empleado: '.$datosEmpleado->nombre.' '.$datosEmpleado->apellido_paterno.' '.$datosEmpleado->apellido_materno);
            return redirect()->back();
        } 
        $prestamos = PrestamoPersonal::where('personals_id', $request->Fk_empleado)->where('estatus','Activo')->count();
        $sueldo_diario = $datosEmpleado->sueldo_mensual /30;
        if($request->idNomina == 0){
            if($request->input('txt_modalidad') == 'SEMANAL'){
                $sueldo = $sueldo_diario * 7;  
            }else if($request->input('txt_modalidad') == 'QUINCENAL'){
                $sueldo = $sueldo_diario * 15;
            }else if($request->input('txt_modalidad') == 'MENSUAL'){
                $sueldo = $sueldo_diario * 30;
            }
            $nomina = new Nomina();
            $nomina->users_id = auth()->user()->id;
            $nomina->modalidad = mb_strtoupper($request->input('txt_modalidad'), 'UTF-8');
            $nomina->num_nomina = mb_strtoupper($request->input('num_nomina'), 'UTF-8');
            $nomina->fecha_corte_ini = $request->input('fecha_inicial');
            $nomina->fecha_corte_fin = $request->input('fecha_final');
            $nomina->save();
            $nominaID= $nomina["id"];

            $detalle = new DetalleNomina();
            $detalle->nomina_id = $nominaID;
            $detalle->personals_id = $request->input('Fk_empleado');
            $detalle->sueldo = $sueldo;
            $detalle->neto_pagar = $sueldo;
            $detalle->save();
            $detalleID= $detalle["id"];

            if(!empty($prestamos)){
                $this->addDescuentoPrestamoPersonal($request,$sueldo,$detalleID);
            }

        }else{
            $employee = DetalleNomina::where('nomina_id', $request->idNomina)->where('personals_id',$request->input('Fk_empleado'))->first();
            if($employee) {
                session()->flash('errorMessage', 'Este empleado ya se encuentra asignado a la Nomina');
                return redirect()->back();
            } 
            if($request->input('modalidad') == 'SEMANAL'){
                $sueldo = $sueldo_diario * 7;  
            }else if($request->input('modalidad') == 'QUINCENAL'){
                $sueldo = $sueldo_diario * 15;
            }else if($request->input('modalidad') == 'MENSUAL'){
                $sueldo = $sueldo_diario * 30;
            }
            $detalle = new DetalleNomina();
            $detalle->nomina_id = $request->idNomina;
            $detalle->personals_id = $request->input('Fk_empleado');
            $detalle->sueldo = $sueldo;
            $detalle->neto_pagar = $sueldo;
            $detalle->save();  
            $detalleID= $detalle["id"];
            $nominaID= $request->idNomina;

            if(!empty($prestamos)){
                $this->addDescuentoPrestamoPersonal($request,$sueldo,$detalleID);
            }
        }
    
        return redirect()->route('admin.nomina.edit', [$nominaID]);
    }
    

    public function addDescuentoPrestamoPersonal(Request $request,$sueldo, $detalleID)
    {
        
        $prestamos = PrestamoPersonal::where('personals_id', $request->Fk_empleado)->where('estatus','Activo')->get();
           
        foreach($prestamos as $val){
            $movimientoNomina = new MovimientoNomina();
            $pagosP = DetallePrestamo::where('prestamo_personal_id',$val->id)->where('estatus','Pendiente')->first();
            $movimientoNomina->detalle_nomina_id = $detalleID;
            $movimientoNomina->monto = $pagosP->monto_pago;
            $movimientoNomina->conceptos_nomina_id = $val->conceptos_nomina_id;
            $movimientoNomina->save();
            $movimientoID= $movimientoNomina["id"];

            DetallePrestamo::where('id', $pagosP->id)->update([
                'estatus' => 'Descontado',
                'detalle_nomina_id' => $detalleID,
                'users_id' => auth()->user()->id,
            ]);

            $numPrestamos = DetallePrestamo::where('prestamo_personal_id', $val->id)->where('estatus','Pendiente')->count();
            if($numPrestamos == 0){
                PrestamoPersonal::where('id', $val->id)->update([
                    'estatus' => 'Inactivo',
                ]);
            }
          
        }
        
        
        $totalPersepcion = 0;
        $totalDeduccion = 0;
        
        $detalleP = MovimientoNomina::select('movimiento_nomina.*')
        ->where('detalle_nomina_id', $detalleID)
        ->where('tipo','=','Persepcion')
        ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'movimiento_nomina.conceptos_nomina_id')
        ->get();

        foreach($detalleP as $persepcion){
            $totalPersepcion += $persepcion->monto;
        }
        $detalleD = MovimientoNomina::select('movimiento_nomina.*')
        ->where('detalle_nomina_id', $detalleID)
        ->where('tipo','=','Deduccion')
        ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'movimiento_nomina.conceptos_nomina_id')
        ->get();

        foreach($detalleD as $deduccion){
            $totalDeduccion += $deduccion->monto;
        }

        $detalleMovimiento = MovimientoNomina::where('id', $movimientoID)->get();
        if($detalleMovimiento[0]->concepto->tipo == 'Persepcion'){
            DetalleNomina::where('id', $detalleID)->update([
                'tot_persepcion' => $totalPersepcion,
            ]);
        }else if($detalleMovimiento[0]->concepto->tipo == 'Deduccion'){
            DetalleNomina::where('id', $detalleID)->update([
                'tot_deduccion' => $totalDeduccion,
            ]);
        } 
        DetalleNomina::where('id', $detalleID)->update([
            // 'sueldo' => $sueldo,
            'neto_pagar' => ($sueldo + $totalPersepcion) - $totalDeduccion,
        ]);
        

    }

    public function edit(Request $request,$nominaID)
    {
        $nomina = Nomina::where('id', $nominaID)->first(); // ->with(')
        $detalleNomina = DetalleNomina::select('detalle_nomina.*')
        ->where('nomina_id', $nominaID)
        ->join('personals', 'personals.id', '=', 'detalle_nomina.personals_id')
        ->orderBy('nombre','ASC')->orderBy('apellido_paterno','ASC')->orderBy('apellido_materno','ASC')
        ->get();
        $personals = Personal::where('state','Activo')->get();
        return view('admin.nominas.editNomina', compact('nomina','detalleNomina','personals'));
    }

    public function pdfRecibo($id){
        $nomina = Nomina::select('nomina.*','detalle_nomina.id as detalle_nomina','detalle_nomina.*','personals.*','puestos.puesto')
        ->where('nomina.id', $id)
        ->join('detalle_nomina', 'detalle_nomina.nomina_id', '=', 'nomina.id')
        ->join('personals', 'personals.id', '=', 'detalle_nomina.personals_id')
        ->join('puestos', 'puestos.id', '=', 'personals.puesto')
        ->get();
        $pdf_name = "RECIBO DE NOMINA".$id.".PDF";
        // return PDF::loadView('pdfs.reciboNomina', compact('nomina'))->setPaper('letter', 'portrait')->download($pdf_name);
        return PDF::loadView('pdfs.reciboNomina', compact('nomina'))->setPaper('letter', 'portrait')->stream($pdf_name);
    }

    public function autorizarNomina($id)
    {
        Nomina::where('id', $id)->update([
            'state' => 'Autorizado',
        ]);
        return redirect()->route('admin.nomina.edit', [$id]);
    }

    public function destroy($idNomina,$idDetalle)
    {
        $detalle = DetalleNomina::find($idDetalle);
        $detalle->delete();
        return redirect()->route('admin.nomina.edit', [$idNomina]);

    }
}
