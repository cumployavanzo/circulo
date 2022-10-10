<?php

namespace App\Http\Controllers;
use App\ConceptoNomina;
use App\Cuenta;
use Illuminate\Http\Request;

class ConceptoNominaController extends Controller
{
    //
    public function index()
    {
        $conceptos = ConceptoNomina::paginate(10);
        $cuentas = Cuenta::all();
        return view('admin.nominas.lista_conceptos', compact('conceptos','cuentas'));
    }

    public function store(Request $request)
    {
        $conceptoN = new ConceptoNomina();
        if($request->idConceptoNomina == 0){
            $conceptoN->clave = $request->input('txt_clave');
            $conceptoN->conceptos = mb_strtoupper($request->input('txt_concepto'), 'UTF-8');
            $conceptoN->tipo = $request->input('txt_tipo');
            $conceptoN->cuentas_id = $request->input('txt_cuenta');
            $conceptoN->save();
        }else{
            ConceptoNomina::where('id', $request->idConceptoNomina)->update([
                'cuentas_id' => $request->input('txt_cuenta'),
                'clave' => $request->input('txt_clave'),
                'conceptos' => mb_strtoupper($request->input('txt_concepto'), 'UTF-8'),
                'tipo' => $request->input('txt_tipo'),
            ]);
        }
        return redirect()->route('admin.concepto.index');
        // return redirect('admin/puestos/addpuestos')->with('success', 'Se ha agregado el puesto exitosamente');
    }

    public function verDetallesConcepto($id){
        $concepto = ConceptoNomina::where('id', $id)->first();
        return response()->json(["concepto" => $concepto]);
    }
}
