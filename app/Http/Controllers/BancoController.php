<?php

namespace App\Http\Controllers;
use App\Banco;
use App\Cuenta;
use App\Personal;

use Illuminate\Http\Request;

class BancoController extends Controller
{
    //
    public function index()
    {
        $bancos = Banco::paginate(10);
        // $puestos = Puesto::all();
        return view('admin.bancos.index', compact('bancos'));
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        $personals = Personal::all();
        return view('admin.bancos.addBancos', compact('cuentas','personals'));
    }
   
    public function verPuesto($idEmpleado){
        $personalsPuesto = Personal::where('id', $idEmpleado)->first()->puestoid;
        return response()->json(["personalsPuesto" => $personalsPuesto]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $bancos = new Banco();
        $bancos->users_id = auth()->user()->id;
        $bancos->banco = mb_strtoupper($request->input('txt_nombre_banco'), 'UTF-8');
        $bancos->nombre_cuenta = mb_strtoupper($request->input('txt_nombre_cuenta'), 'UTF-8');
        $bancos->numero_cuenta = mb_strtoupper($request->input('txt_num_cuenta'), 'UTF-8');
        $bancos->cuenta_clave = mb_strtoupper($request->input('txt_cuenta_clabe'), 'UTF-8');
        $bancos->num_tarjeta = mb_strtoupper($request->input('txt_num_tarjeta'), 'UTF-8');
        $bancos->uso_cuenta = mb_strtoupper($request->input('txt_uso_cuenta'), 'UTF-8');
        $bancos->cuentas_id = $request->input('txt_cuenta_contable');
        $bancos->personals_id_firmante = $request->input('txt_name_firmante');
        $bancos->personals_id_responsable = $request->input('txt_responsable_cuenta');
        $bancos->saldo_minimo = (str_replace(",","",$request->input('txt_saldo_minimo')));
        $bancos->save();
        return redirect()->route('admin.banco.index');
    }

    public function edit($id)
    {
        $banco = Banco::where('id', $id)->first();
        $personals = Personal::all(); 
        $cuentas = Cuenta::all();

        $opcionFirmante = "N/A";
        if($banco->personalsFirmante()->first('id') != null){
            $opcionFirmante = $banco->personalsFirmante()->first('id')->id;
        }
        $opcionResponsable = "N/A";
        if($banco->personalsResponsable()->first('id') != null){
            $opcionResponsable = $banco->personalsResponsable()->first('id')->id;
        }

        $opcionCuenta = "N/A";
        if($banco->cuenta()->first('id') != null){
            $opcionCuenta = $banco->cuenta()->first('id')->id;
        }

        return view('admin.bancos.editBancos', compact('banco','personals','opcionFirmante','opcionResponsable','cuentas','opcionCuenta'));
    }

    public function update(Request $request, $id)
    {
        Banco::where('id', $id)->update([
            'banco' => mb_strtoupper($request->txt_nombre_banco, 'UTF-8'),
            'nombre_cuenta' => mb_strtoupper($request->txt_nombre_cuenta,'UTF-8'),
            'numero_cuenta' => mb_strtoupper($request->txt_num_cuenta,'UTF-8'),
            'cuenta_clave' => mb_strtoupper($request->txt_cuenta_clabe,'UTF-8'),
            'num_tarjeta' => mb_strtoupper($request->txt_num_tarjeta,'UTF-8'),
            'uso_cuenta' => mb_strtoupper($request->txt_uso_cuenta,'UTF-8'),
            'cuentas_id' => $request->txt_cuenta_contable,
            'personals_id_firmante' => $request->txt_name_firmante,
            'personals_id_responsable' => $request->txt_responsable_cuenta,
            'saldo_minimo' => (str_replace(",","",$request->txt_saldo_minimo))
        ]);
        return redirect()->route('admin.banco.edit',[$id])->with('mensaje', 'Se ha editado el Banco exitosamente');
    }

    public function destroy($id)
    {
        $banco = Banco::find($id);
        $banco->delete();
        return redirect()->route('admin.banco.index');
    }
}
