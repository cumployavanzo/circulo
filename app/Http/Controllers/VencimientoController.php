<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Vencimiento;
use App\Caja;
use App\Banco;
use App\Articulo;
use App\MovimientoGasto;


class VencimientoController extends Controller
{
    //
    public function index()
    {
        $hoy = Carbon::today();
        \DB::statement("SET SQL_MODE=''");
        $vencimientos = Vencimiento::select('tabla_amortizacion.*','clientes.nombre','clientes.apellido_paterno','clientes.apellido_materno')
        ->where('tabla_amortizacion.estatus', 'Pendiente')
        ->join('analisis_credito', 'analisis_credito.id', '=', 'tabla_amortizacion.analisis_credito_id')
        ->join('solicituds', 'solicituds.id', '=', 'analisis_credito.solicituds_id')
        ->join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
        ->whereDate('tabla_amortizacion.fecha_pago', '<=', $hoy)
        ->orderBy('tabla_amortizacion.fecha_pago', 'DESC')
        ->paginate(10);
        return view('admin.vencimientos.index', compact('vencimientos'));
    }

    public function edit($id)
    {
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();
        $vencimiento = Vencimiento::find($id);
        // dd($vencimiento);
        return view('admin.vencimientos.cobro_vencimiento', compact('vencimiento','cuentaActivo','cuentasCaja','bancos'));
    }

    public function store(Request $request)
    {
        $desembolso = new MovimientoGasto();
        $desembolso->tabla_amortizacion_id = $request->input('idAmortizacion');
        if($request->input('txt_tipo_pago') == 'Efectivo'){
            $desembolso->cuentas_id = $request->input('txt_cuenta_efectivo');
        }else if($request->input('txt_tipo_pago') == 'Transferencia'){
            $desembolso->cuentas_id = $request->input('txt_cuenta_transferencia');
        }else if($request->input('txt_tipo_pago') == 'Cheque'){
            $desembolso->cuentas_id = $request->input('txt_cuenta_cheque');
        }else if($request->input('txt_tipo_pago') == 'Especie'){
            $desembolso->cuentas_id = $request->input('txt_cuenta_especie');
        }
        $desembolso->tipo_pago = $request->input('txt_tipo_pago');
        $desembolso->fecha_pago = $request->input('fecha_pago');
        $desembolso->observaciones = mb_strtoupper($request->input('concepto'), 'UTF-8');
        $desembolso->bandera = 'Vencimiento';

        $desembolso->save();

        // $creditos = Analisis_credito::where('estatus', 'Autorizado')->paginate(10);
        Vencimiento::where('id', $request->input('idAmortizacion'))->update([
            'estatus' => 'Pagado',
            'user_id_cobro' => auth()->user()->id,
        ]);

        return redirect()->route('admin.vencimiento.show', [$request->input('idAmortizacion')]);

    }

    public function show($id)
    {
        $vencimiento = Vencimiento::find($id);
        $detalle = MovimientoGasto::where('tabla_amortizacion_id', $id)->first();
        if($detalle->tipo_pago == 'Efectivo' || $detalle->tipo_pago == 'Especie'){
            $cuentaTipoPago = Cuenta::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de cuentas
        }else if($detalle->tipo_pago == 'Transferencia' || $detalle->tipo_pago == 'Cheque'){
            $cuentaTipoPago = Banco::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de bancos
        }
        $bancos = Banco::all();
        $cuentasCaja = Caja::all();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();
        $cuentaCliente = Vencimiento::where('id',$id)->first()->analisisC->solicitud->cliente->cuentas;
        $cuentaProducto = Vencimiento::where('id',$id)->first()->analisisC->solicitud->producto->cuentas;
        $producto = Vencimiento::where('id',$id)->first()->analisisC->solicitud->producto;
        return view('admin.vencimientos.detalles', compact('vencimiento','cuentaTipoPago','bancos','cuentasCaja','cuentaActivo','detalle','cuentaCliente','producto','cuentaProducto'));
    }
}
