<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrestamoPersonal;
use App\Personal;
use App\ConceptoNomina;
use App\DetallePrestamo;

class PrestamoPersonalController extends Controller
{
    //

    public function index()
    {
        $prestamosP = PrestamoPersonal::paginate(10);
        return view('admin.prestamos_personal.index', compact('prestamosP'));
    }

    public function create()
    {
        $personals = Personal::where('state','Activo')->get();
        $conceptoNomina = ConceptoNomina::where('tipo','Deduccion')->get();
        return view('admin.prestamos_personal.addPrestamo', compact('personals','conceptoNomina'));
    }

    public function store(Request $request)
    {
        
        $prestamos = new PrestamoPersonal();
        $prestamos->personals_id = $request->input('Fk_empleado');
        $prestamos->fecha_prestamo = $request->input('fecha_prestamo');
        $prestamos->conceptos_nomina_id = $request->input('txt_concepto_nomina');
        $prestamos->num_pagos = $request->input('num_pagos');
        $prestamos->total_prestamo = (str_replace(",","",$request->input('txt_monto')));
        $montoPago = (str_replace(",","",$request->input('txt_monto'))) / $request->input('num_pagos');
        $prestamos->save();
        $detalle_prestamoID= $prestamos["id"];
        for($i=1;$i<=$request->input('num_pagos');$i++){
            $detalles = new DetallePrestamo();
            $detalles->prestamo_personal_id = $detalle_prestamoID;
            $detalles->monto_pago = $montoPago;
            $detalles->save();
        }

        return redirect()->route('admin.prestamoP.index');
    
        // return redirect()->route('admin.pago.show', [$request->input('idGasto')]);
    }
}
