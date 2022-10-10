<?php

namespace App\Http\Controllers;
use App\Gasto;
use App\Caja;
use App\Banco;
use App\Cuenta;
use App\DetalleGasto;
use App\DetallePago;
use App\MovimientoGasto;
use App\Articulo;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    //
    public function index()
    {
        $gastos = Gasto::where('concepto','!=', 'APORTACIONES DE CAPITAL')->paginate(10);
        return view('admin.pagos.index', compact('gastos'));
    }
    
    public function edit($gasto_id)
    {
        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();
        $cuentaIvaPagado = Cuenta::where('id', 328)->first(); 
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();
        return view('admin.pagos.addPago', compact('gasto','cuentasCaja','bancos','gastoProducto','cuentaIvaPagado','cuentaActivo'));
    }

    public function store(Request $request)
    {
        
        $movimientos = new MovimientoGasto();
        $movimientos->compras_id = $request->input('idGasto');
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
        $movimientos->bandera = 'Pago';
        $movimientos->save(); 
        Gasto::where('id', $request->input('idGasto'))->update([
            'estatus' => 'Pagado',
        ]);
        return redirect()->route('admin.pago.show', [$request->input('idGasto')]);
    }


    public function show($gasto_id)
    {
        //

        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $cuentaIvaPagado = Cuenta::where('id', 328)->first(); 
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();
        // $pago = DetallePago::where('compras_id', $gasto_id)->first(); asi estaba antes
        $pago = MovimientoGasto::where('compras_id', $gasto_id)->where('bandera','=','Pago')->first();
        $cuentaTipoPago = Cuenta::where('id', $pago->cuentas_id)->first();
        return view('admin.pagos.edit', compact('gasto','cuentasCaja','bancos','gastoProducto','cuentaIvaPagado','cuentaTipoPago','pago'));
    }
}
