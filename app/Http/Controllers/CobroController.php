<?php

namespace App\Http\Controllers;
use App\Gasto;
use App\Caja;
use App\Banco;
use App\Articulo;
use App\Cuenta;
use App\DetalleGasto;
use App\DetalleCobro;
use App\MovimientoGasto;


use Illuminate\Http\Request;

class CobroController extends Controller
{
    //
    public function index()
    {
        $gastos = Gasto::where('concepto','=', 'APORTACIONES DE CAPITAL')->paginate(10);
        return view('admin.cobros.index', compact('gastos'));
    }

    public function edit($gasto_id)
    {
        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();
        // $cuentaIvaPagado = Cuenta::where('id', 328)->first();
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();
        // $cobro = DetalleCobro::where('compras_id', $gasto_id)->first(); asi estaba antes
        $cobro = MovimientoGasto::where('compras_id', $gasto_id)->first();
        $cuentaTipoPago = Cuenta::where('id', $cobro->first()->cuentas_id)->first();
        return view('admin.cobros.addCobro', compact('gasto','cuentasCaja','bancos','gastoProducto','cuentaTipoPago','cobro','cuentaActivo'));
    }

    public function store(Request $request)
    {
        $movimientos = new MovimientoGasto();
        $movimientos->compras_id = $request->input('idGasto');
        $movimientos->bandera = 'Cobro';
        if($request->input('txt_tipo_pago') == 'Efectivo'){
            $movimientos->cuentas_id = $request->input('txt_cuenta_efectivo');
        }else if($request->input('txt_tipo_pago') == 'Transferencia'){
            $movimientos->cuentas_id = $request->input('txt_cuenta_transferencia');
        }else if($request->input('txt_tipo_pago') == 'Cheque'){
            $movimientos->cuentas_id = $request->input('txt_cuenta_cheque');
        }else if($request->input('txt_tipo_pago') == 'Especie'){
            $movimientos->cuentas_id = $request->input('txt_cuenta_especie');
        }
        $movimientos->tipo_pago = $request->input('txt_tipo_pago');
        $movimientos->fecha_pago = $request->input('fecha_pago');
        $movimientos->observaciones = mb_strtoupper($request->input('concepto'), 'UTF-8');
        $movimientos->save(); 
        Gasto::where('id', $request->input('idGasto'))->update([
            'estatus' => 'Cobrado',
        ]);
        return redirect()->route('admin.cobro.show', [$request->input('idGasto')]);
    }

    public function show($gasto_id)
    {
        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();
        // $cobro = DetalleCobro::where('compras_id', $gasto_id)->first(); asi estaba antes
        $cobro = MovimientoGasto::where('compras_id', $gasto_id)->where('bandera','=','Cobro')->first();
        $cuentaTipoPago = Cuenta::where('id', $cobro->cuentas_id)->first();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();

        return view('admin.cobros.edit', compact('gasto','cuentasCaja','bancos','cuentaActivo','gastoProducto','cuentaTipoPago','cobro'));
    }
}
