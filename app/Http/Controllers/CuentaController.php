<?php

namespace App\Http\Controllers;
use App\Cuenta;
use App\Exports\CuentasExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuenta::orderBy('numero_cuenta', 'ASC')->paginate(10);
        // $puestos = Puesto::all();
        return view('admin.cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        
        return view('admin.cuentas.addCuentas');
    }

    public function store(Request $request)
    {
        // dd($request);
        $cuentas = new Cuenta();
        $cuentas->nombre_cuenta = mb_strtoupper($request->input('txt_nombre_cuenta'), 'UTF-8');
        $cuentas->numero_cuenta = $request->input('txt_num_cuenta');
        $cuentas->naturaleza = mb_strtoupper($request->input('txt_naturaleza'), 'UTF-8');
        $cuentas->tipo = mb_strtoupper($request->input('txt_tipo'), 'UTF-8');
        $cuentas->nivel = $request->input('txt_nivel');
        $cuentas->codigo_agrupador = $request->input('txt_codigo_agrupador');
        $cuentas->nombre_cuenta_ca = mb_strtoupper($request->input('txt_cuenta_ca'), 'UTF-8');
        $cuentas->save();
        return redirect()->route('admin.cuenta.index');
        // return redirect('admin/cuentas/addcuentas')->with('success', 'Se ha agregado la cuenta exitosamente');
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

    public function edit($id)
    {
        $cuenta = Cuenta::where('id', $id)->first();
        return view('admin.cuentas.editCuentas', compact('cuenta'));
    }

    public function update(Request $request, $id)
    {
        Cuenta::where('id', $id)->update([
            'nombre_cuenta' => mb_strtoupper($request->txt_nombre_cuenta, 'UTF-8'),
            'numero_cuenta' => $request->txt_num_cuenta,
            'naturaleza' => mb_strtoupper($request->txt_naturaleza,'UTF-8'),
            'tipo' => mb_strtoupper($request->txt_tipo,'UTF-8'),
            'nivel' => $request->txt_nivel,
            'codigo_agrupador' => $request->txt_codigo_agrupador,
            'nombre_cuenta_ca' => mb_strtoupper($request->txt_cuenta_ca,'UTF-8')
        ]);
        // return back()->with('mensaje', 'Se ha editado la Cuenta exitosamente');
        return redirect()->route('admin.cuenta.edit',[$id])->with('mensaje', 'Se ha editado la Cuenta exitosamente');
    }

    public function destroy($id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->delete();
        return redirect()->route('admin.cuenta.index');
        // return back()->with('success','Se ha borrado la Cuenta exitosamente');
    }

    public function reporteCuentas(){
        $data = Cuenta::orderBy('numero_cuenta', 'ASC');
        return Excel::download(new CuentasExport($data->get()), 'cuentas'. '.xlsx');
     }
}
