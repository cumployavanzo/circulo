<?php

namespace App\Http\Controllers;
use App\Caja;
use App\Cuenta;
use App\Personal;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    //
    public function index()
    {
        $cajas = Caja::paginate(10);
        return view('admin.cajas.index', compact('cajas'));
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        $personals = Personal::all();
        return view('admin.cajas.addCajas', compact('cuentas','personals'));
    }
   
    public function verPuesto($idEmpleado){
        $personalsPuesto = Personal::where('id', $idEmpleado)->first()->puestoid;
        return response()->json(["personalsPuesto" => $personalsPuesto]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $cajas = new Caja();
        $cajas->users_id = auth()->user()->id;
        $cajas->nombre_caja = mb_strtoupper($request->input('txt_nombre_caja'), 'UTF-8');
        $cajas->personals_id = $request->input('txt_name_responsable');
        $cajas->cuentas_id = $request->input('txt_cuenta_contable');
        $cajas->saldo_minimo = (str_replace(",","",$request->input('txt_saldo_minimo')));
        $cajas->save();
        return redirect()->route('admin.caja.index');
    }

    public function edit($id)
    {
        $caja = Caja::where('id', $id)->first();
        $personals = Personal::all(); 
        $cuentas = Cuenta::all();

        $opcionResponsable = "N/A";
        if($caja->personalsResponsable()->first('id') != null){
            $opcionResponsable = $caja->personalsResponsable()->first('id')->id;
        }

        $opcionCuenta = "N/A";
        if($caja->cuenta()->first('id') != null){
            $opcionCuenta = $caja->cuenta()->first('id')->id;
        }
        return view('admin.cajas.editCajas', compact('caja','personals','opcionResponsable','cuentas','opcionCuenta'));
    }

    public function update(Request $request, $id)
    {
        Caja::where('id', $id)->update([
            'nombre_caja' => mb_strtoupper($request->txt_nombre_caja, 'UTF-8'),
            'personals_id' => $request->txt_name_responsable,
            'cuentas_id' => $request->txt_cuenta_contable,
            'saldo_minimo' => (str_replace(",","",$request->txt_saldo_minimo))
        ]);
        return redirect()->route('admin.caja.edit',[$id])->with('mensaje', 'Se ha editado la Caja exitosamente');
    }

    public function destroy($id)
    {
        $caja = Caja::find($id);
        $caja->delete();
        return redirect()->route('admin.caja.index');
    }
}
