<?php

namespace App\Http\Controllers;
use App\Caja;
use App\Banco;
use App\Articulo;
use App\Analisis_credito;
use App\DetalleDesembolso;
use App\Cuenta;
use App\MovimientoGasto;


use Illuminate\Http\Request;

class DesembolsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $creditos = Analisis_credito::paginate(10);
        $creditos = Analisis_credito::where('estatus', 'Autorizado')->paginate(10);
        return view('admin.desembolsos.index', compact('creditos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $desembolso = new MovimientoGasto();
        $desembolso->analisis_credito_id = $request->input('idAnalisisCred');
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
        $desembolso->bandera = 'Desembolso';

        $desembolso->save();

        $creditos = Analisis_credito::where('estatus', 'Autorizado')->paginate(10);
        Analisis_credito::where('id', $request->input('idAnalisisCred'))->update([
            'desembolso' => 'Desembolsado',
        ]);
        // return redirect()->route('admin.desembolso.index',[$id]);
        return redirect()->route('admin.desembolso.show', [$request->input('idAnalisisCred')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credito = Analisis_credito::find($id);
        $detalle = MovimientoGasto::where('analisis_credito_id', $id)->first();
        if($detalle->tipo_pago == 'Efectivo' || $detalle->tipo_pago == 'Especie'){
            $cuentaTipoPago = Cuenta::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de cuentas
        }else if($detalle->tipo_pago == 'Transferencia' || $detalle->tipo_pago == 'Cheque'){
            $cuentaTipoPago = Banco::where('id', $detalle->cuentas_id)->first(); //// es el id del catalogo de bancos
        }
        $bancos = Banco::all();
        $cuentasCaja = Caja::all();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();
        $cuentaCliente = Analisis_credito::where('id',$id)->first()->solicitud->cliente->cuentas;
        $producto = Analisis_credito::where('id',$id)->first()->solicitud->producto;
        

        return view('admin.desembolsos.detalles', compact('credito','cuentaTipoPago','bancos','cuentasCaja','cuentaActivo','detalle','cuentaCliente','producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentasCaja = Caja::all();
        $bancos = Banco::all();
        $cuentaActivo = Articulo::where('tipo_producto','ACTIVO')->get();
        $credito = Analisis_credito::find($id);
        // dd($credito);
        return view('admin.desembolsos.desembolso', compact('credito','cuentaActivo','cuentasCaja','bancos'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
