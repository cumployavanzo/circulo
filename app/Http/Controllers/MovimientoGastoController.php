<?php

namespace App\Http\Controllers;

use App\MovimientoGasto;
use App\DetalleGasto;
use App\Gasto;
use App\Cuenta;
use App\Caja;
use App\Banco;
use App\Articulo;
use App\Analisis_credito;
use App\Vencimiento;


use Illuminate\Http\Request;

class MovimientoGastoController extends Controller
{
    //
    public function index()
    {
        // $movimientoGastos=MovimientoGasto::select('compras_id','id', 'state','bandera','users_contabilizo')->where('state', '!=', 'Contabilizado')->distinct('compras_id')->paginate(10); asi estaba antes
        $movimientoGastos=MovimientoGasto::where('state', '!=', 'Contabilizado')->paginate(10);
        return view('admin.movimientos.index', compact('movimientoGastos'));
    }


    // public function edit($gasto_id)
    // {
    //     $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->paginate(10);
    //     $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
    //     $cuentaProvedor = Cuenta::where('id', 101)->first(); 
    //     MovimientoGasto::where('compras_id', $gasto_id)->update([
    //         'state' => 'Proceso',
    //         'users_contabilizo' => auth()->user()->id,
    //     ]);
        
    //     return view('admin.movimientos.edit', compact('gasto','gastoProducto','cuentaProvedor'));
    // }

    public function edit($id_movimiento)
    {
        $movimientoGastos=MovimientoGasto::where('id', '=', $id_movimiento)->first();
        MovimientoGasto::where('id', $id_movimiento)->update([
            'state' => 'Proceso',
            'users_contabilizo' => auth()->user()->id,
        ]);
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $articulos = Articulo::all();
        $gasto = Gasto::where('id', $movimientoGastos->compras_id)->first(); // ->with(')
        $gastoProducto = DetalleGasto::where('compras_id', $movimientoGastos->compras_id)->get();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();

        if($movimientoGastos->bandera == 'Compra'){
            $gastoProducto = DetalleGasto::where('compras_id', $movimientoGastos->compras_id)->paginate(10);
            $gasto = Gasto::where('id', $movimientoGastos->compras_id)->first(); // ->with(')
            $cuentaProvedor = Cuenta::where('id', 101)->first(); 
            return view('admin.movimientos.edit', compact('gasto','gastoProducto','cuentaProvedor','movimientoGastos'));
        }elseif($movimientoGastos->bandera == 'Pago'){
            $cuentaIvaPagado = Cuenta::where('id', 328)->first(); 
            $pago = MovimientoGasto::where('compras_id', $movimientoGastos->compras_id)->where('bandera','=','Pago')->first();
            $cuentaTipoPago = Cuenta::where('id', $pago->cuentas_id)->first();
            return view('admin.movimientos.editPago', compact('gasto','cuentasCaja','bancos','gastoProducto','cuentaIvaPagado','cuentaTipoPago','pago','movimientoGastos'));
        }elseif($movimientoGastos->bandera == 'Cobro'){
            $cobro = MovimientoGasto::where('compras_id', $movimientoGastos->compras_id)->where('bandera','=','Cobro')->first();
            $cuentaTipoPago = Cuenta::where('id', $cobro->cuentas_id)->first();
            return view('admin.movimientos.editCobro', compact('gasto','cuentasCaja','bancos','cuentaActivo','gastoProducto','cuentaTipoPago','cobro','movimientoGastos'));
        }elseif($movimientoGastos->bandera == 'Desembolso'){
            $credito = Analisis_credito::find($movimientoGastos->analisis_credito_id);
            $detalle = MovimientoGasto::where('analisis_credito_id', $movimientoGastos->analisis_credito_id)->first();
            if($detalle->tipo_pago == 'Efectivo' || $detalle->tipo_pago == 'Especie'){
                $cuentaTipoPago = Cuenta::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de cuentas
            }elseif($detalle->tipo_pago == 'Transferencia' || $detalle->tipo_pago == 'Cheque'){
                $cuentaTipoPago = Banco::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de bancos
            }
            $cuentaCliente = Analisis_credito::where('id',$movimientoGastos->analisis_credito_id)->first()->solicitud->cliente->cuentas;
            $producto = Analisis_credito::where('id',$movimientoGastos->analisis_credito_id)->first()->solicitud->producto;
            return view('admin.movimientos.editDesembolso', compact('credito','cuentaTipoPago','bancos','cuentasCaja','cuentaActivo','detalle','cuentaCliente','producto'));
        }elseif($movimientoGastos->bandera == 'Capital'){
            $gastoP = DetalleGasto::where('compras_id', $movimientoGastos->compras_id)->first();
            return view('admin.movimientos.editCapital', compact('gasto', 'gastoProducto','gastoP','movimientoGastos'));
        }elseif($movimientoGastos->bandera == 'Activo'){
            $gastoP = DetalleGasto::where('compras_id', $movimientoGastos->compras_id)->first();
            return view('admin.movimientos.editActivo', compact('gasto', 'gastoProducto','articulos','gastoP','movimientoGastos'));
        }elseif($movimientoGastos->bandera == 'No deducible'){    
            $gastoP = DetalleGasto::where('compras_id', $movimientoGastos->compras_id)->first();
            return view('admin.movimientos.editNoDeducible', compact('gasto', 'gastoProducto','articulos','gastoP','movimientoGastos'));
        }elseif($movimientoGastos->bandera == 'Vencimiento'){
            $vencimiento = Vencimiento::find($movimientoGastos->tabla_amortizacion_id);
            $detalle = MovimientoGasto::where('tabla_amortizacion_id', $movimientoGastos->tabla_amortizacion_id)->first();
            if($detalle->tipo_pago == 'Efectivo' || $detalle->tipo_pago == 'Especie'){
                $cuentaTipoPago = Cuenta::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de cuentas
            }elseif($detalle->tipo_pago == 'Transferencia' || $detalle->tipo_pago == 'Cheque'){
                $cuentaTipoPago = Banco::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de bancos
            }
            $cuentaCliente = Vencimiento::where('id',$movimientoGastos->tabla_amortizacion_id)->first()->analisisC->solicitud->cliente->cuentas;
            $cuentaProducto = Vencimiento::where('id',$movimientoGastos->tabla_amortizacion_id)->first()->analisisC->solicitud->producto->cuentas;
            $producto = Vencimiento::where('id',$movimientoGastos->tabla_amortizacion_id)->first()->analisisC->solicitud->producto;
            return view('admin.movimientos.editVencimiento', compact('vencimiento','cuentaTipoPago','bancos','cuentasCaja','cuentaActivo','detalle','cuentaCliente','producto','cuentaProducto'));
        }
       
    }


    public function update(Request $request, $id)
    {
        // $movimientoGastos=MovimientoGasto::select('compras_id', 'state','bandera','users_contabilizo')->where('state', '!=', 'Contabilizado')->distinct('compras_id')->paginate(10);
        $movimientoGastos=MovimientoGasto::where('state', '!=', 'Contabilizado')->paginate(10);
        MovimientoGasto::where('id', $id)->update([
            'state' => 'Contabilizado',
            'users_contabilizo' => auth()->user()->id,
        ]);
        return redirect()->route('admin.movimiento.index')->with('mensaje', 'Se ha editado la Solicitud exitosamente');
    }

}
