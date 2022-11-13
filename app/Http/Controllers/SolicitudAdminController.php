<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cliente;
use App\Producto;
use App\Referencia;
use App\TablaAmortizacion;
use DateTime;
use Carbon\Carbon;
use PDF;

use Illuminate\Http\Request;

class SolicitudAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $solicitudes = Solicitud::select('solicituds.*')
        ->name($name)
        ->join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
        ->paginate(10);

        return view('admin.solicitudes.index', compact('solicitudes','name'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        $today = Carbon::now();
        $fdesembolso = strtotime ( '+2 day' , strtotime($today));
        $fdesembolso = date ( 'd/m/Y' , $fdesembolso );
        $fprimerPago = strtotime ( '+9 day' , strtotime($today));
        $fprimerPago = date ( 'd/m/Y' , $fprimerPago );
        $fvencimiento = strtotime ( '100 day' , strtotime($today));
        $fvencimiento = date ( 'd/m/Y' , $fvencimiento );
        // dd($date);
        return view('admin.solicitudes.addSolicitud', compact('clientes','today', 'fdesembolso','fprimerPago','fvencimiento','productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request);
        $solicitud = new Solicitud();
        $solicitud->users_id = auth()->user()->id;
        $solicitud->asociado_id = $request->input('idAsociado');
        $solicitud->cliente_id = $request->input('idCliente');
        $solicitud->tipo_negocio = mb_strtoupper($request->input('txt_tipo_negocio'), 'UTF-8');
        $solicitud->direccion_negocio = mb_strtoupper($request->input('txt_direccion_ref'), 'UTF-8');
        $solicitud->entre_calles = mb_strtoupper($request->input('txt_entre_calle'), 'UTF-8');
        $solicitud->cp = mb_strtoupper($request->input('txt_codigo_postal_ref'), 'UTF-8');
        $solicitud->colonia = mb_strtoupper($request->input('txt_colonia_ref'), 'UTF-8');
        $solicitud->ciudad = mb_strtoupper($request->input('txt_ciudad_ref'), 'UTF-8');
        $solicitud->estado = mb_strtoupper($request->input('txt_estado_ref'), 'UTF-8');
        $solicitud->antiguedad_negocio = mb_strtoupper($request->input('txt_antiguedad_negocio'), 'UTF-8');
        $solicitud->num_hijos = mb_strtoupper($request->input('txt_num_hijos'), 'UTF-8');
        $solicitud->anios_exp = mb_strtoupper($request->input('txt_anios_exp'), 'UTF-8');
        $solicitud->tipo_establecimiento = $request->input('txt_establecimiento');
        $solicitud->garantias = mb_strtoupper($request->input('txt_garantia'), 'UTF-8');
        $solicitud->dependientes_economicos = $request->input('txt_dependientes_economicos');
        $solicitud->producto_id = $request->input('txt_producto');
        $solicitud->ingreso_mensual = (str_replace(",","",$request->input('txt_ingreso_mensual')));
        $solicitud->gasto_mensual = (str_replace(",","",$request->input('txt_gasto_mensual')));
        $solicitud->monto_solicitado = (str_replace(",","",$request->input('txt_monto_solicitado')));
        $solicitud->ciclo = $request->input('txt_ciclo');
        $solicitud->plazo = $request->input('txt_plazo');
        $solicitud->tasa = $request->input('txt_tasa');
        $solicitud->capacidad_pago = $request->input('txt_capacidad_pago');
        $solicitud->cuota = $request->input('txt_cuota');
        $solicitud->frecuencia_pago = $request->input('txt_frecuencia_pago');
        $dateS =  str_replace('/', '-', $request->input('txt_fsolicitud'));
        $solicitud->fecha_solicitud = date('Y-m-d', strtotime($dateS));
        $dateD =  str_replace('/', '-', $request->input('txt_fdesembolso'));
        $solicitud->fecha_desembolso = date('Y-m-d', strtotime($dateD));
        $dateP =  str_replace('/', '-', $request->input('txt_fprimer_pago'));
        $solicitud->fecha_primer_pago = date('Y-m-d', strtotime($dateP));
        $dateV =  str_replace('/', '-', $request->input('txt_fvencimiento'));
        $solicitud->fecha_vencimiento = date('Y-m-d', strtotime($dateV));
        $solicitud->estatus = 'Pendiente';
        $solicitud->save();
        return redirect()->route('admin.solicitud.index');
        // return back()->with('mensaje', 'Se agrego la Solicitud exitosamente');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = Solicitud::where('id', $id)->first();
        $clientes = Cliente::all();
        $opcionCliente = "N/A";
        if($solicitud->cliente()->first('id') != null){
            $opcionCliente = $solicitud->cliente()->first('id')->id;
        }
        $productos = Producto::all(); 
        $opcionProducto = "N/A";
        if($solicitud->producto()->first('id') != null){
            $opcionProducto = $solicitud->producto()->first('id')->id;
        }

        return view('admin.solicitudes.edit', compact('solicitud','clientes','opcionCliente','productos','opcionProducto'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $dateS =  str_replace('/', '-', $request->input('txt_fsolicitud'));
        $dateD =  str_replace('/', '-', $request->input('txt_fdesembolso'));
        $dateV =  str_replace('/', '-', $request->input('txt_fvencimiento'));
        $dateP =  str_replace('/', '-', $request->input('txt_fprimer_pago'));

        Solicitud::where('id', $id)->update([
            'anios_exp' => mb_strtoupper($request->txt_anios_exp,'UTF-8'),
            'tipo_negocio' => mb_strtoupper($request->txt_tipo_negocio,'UTF-8'),
            'antiguedad_negocio' => mb_strtoupper($request->txt_antiguedad_negocio,'UTF-8'),
            'direccion_negocio' => mb_strtoupper($request->txt_direccion_ref,'UTF-8'),
            'entre_calles' => mb_strtoupper($request->txt_entre_calle,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal_ref,'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia_ref,'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad_ref,'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado_ref,'UTF-8'),
            'num_hijos' => mb_strtoupper($request->txt_num_hijos,'UTF-8'),
            'garantias' => mb_strtoupper($request->txt_garantia,'UTF-8'),
            'dependientes_economicos' => $request->txt_dependientes_economicos,
            'tipo_establecimiento' => $request->txt_establecimiento,
            'ingreso_mensual' => (str_replace(",","",$request->txt_ingreso_mensual)),
            'gasto_mensual' => (str_replace(",","",$request->txt_gasto_mensual)),
            'ciclo' => $request->txt_ciclo,
            'monto_solicitado' => (str_replace(",","",$request->txt_monto_solicitado)),
            'frecuencia_pago' => $request->txt_frecuencia_pago,
            'producto_id' => $request->txt_producto,
            'tasa' => $request->txt_tasa,
            'plazo' => $request->txt_plazo,
            'capacidad_pago' => $request->txt_capacidad_pago,
            'cuota' => $request->txt_cuota,
            'fecha_solicitud' =>  date('Y-m-d', strtotime($dateS)),
            'fecha_desembolso' => date('Y-m-d', strtotime($dateD)),
            'fecha_primer_pago' => date('Y-m-d', strtotime($dateP)),
            'fecha_vencimiento' => date('Y-m-d', strtotime($dateV)),
        ]);
        return redirect()->route('admin.solicitud.edit',[$id])->with('mensaje', 'Se ha editado la Solicitud exitosamente');
        // return back()->with('mensaje', 'Se ha editado la Solicitud exitosamente');
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

    public function obtenerDetallesCliente($id){
        $cliente = Cliente::where('id', $id)->first();         
        $asociado = $cliente->asociados;
        $operador = $asociado->operadores;
        return response()->json(["cliente" => $cliente, "asociado" => $asociado, "operador" => $operador]);
    }

    public function verProductos($id){
        // dd($id);
        $products = Producto::where('id', $id)->first();
        // dd($products);
        return response()->json(["products" => $products]);
    }

    public function tablaAmortizacion(Request $request)
    {

        $plazo = $request->plazo;
        $frecuencia_pago = $request->frecuencia_pago;
        $monto_solicitado = (str_replace(",","",$request->monto_solicitado));
        $tasa = $request->tasa; ////40
        $porcentaje = $tasa * (1/100);
        $saldo = (($monto_solicitado * $porcentaje) + $monto_solicitado); ////3500
        $capital = $monto_solicitado / $plazo; //178.77;
        $cuota = $saldo / $plazo; // 250;
        $interes = ($monto_solicitado * $porcentaje) / $plazo;
        $tabla = [];
        $mes_anterior = [];
        $plazo = range(1,$plazo);
        $gasto_por_cobranza = '10.00';
        $today = Carbon::now()->toDateString();
        // $fecha_primr_pago = Carbon::parse($today);
        // $fecha_primr_pago->addDays(2)->format('d/m/Y');

        $dateS =  str_replace('/', '-', $request->fecha_desembolso);
        $fecha_desembolso = date('Y-m-d', strtotime($dateS));
        $fecha_pago = Carbon::parse($fecha_desembolso);

        $datos= [
            'mes' => "",
            'cuota' => "-- --",
            'saldo' => number_format($saldo, 2),
            'capital' => "-- --",
            'interes' => "-- --",
            'gasto_por_cobranza' => $gasto_por_cobranza,
            'fecha_pago' => $fecha_pago,
        ];
        $tabla[] = $datos;

        foreach($plazo as $plazos) {
          
            if (empty($mes_anterior)) {
                // primero
                $saldo = $saldo - $cuota;
                // $fecha_pago = Carbon::parse($today);
                // $fecha_pago->addDays(9)->format('d/m/Y');
                $dateS =  str_replace('/', '-', $request->fecha_desembolso);
                $fecha_desembolso = date('Y-m-d', strtotime($dateS));
                $fecha_pago = Carbon::parse($fecha_desembolso);
                if($frecuencia_pago == 'DIARIO'){
                    $fecha_pago->addDays(1)->format('d/m/Y');
                }else if($frecuencia_pago == 'SEMANAL'){
                    $fecha_pago->addDays(7)->format('d/m/Y');
                }else if($frecuencia_pago == 'QUINCENAL'){
                    $fecha_pago->addDays(15)->format('d/m/Y');
                }else if($frecuencia_pago == 'MENSUAL'){
                    $fecha_pago->addDays(30)->format('d/m/Y');
                }else{
                    $fecha_pago->addDays(7)->format('d/m/Y');
                }
                
                $calculo_mes = [
                    'mes' => $plazos,
                    'cuota' => number_format($cuota, 2),
                    'saldo' => number_format($saldo, 2),
                    'capital' => round($capital, 2),
                    'interes' => round($interes, 2),
                    'gasto_por_cobranza' => $gasto_por_cobranza,
                    'fecha_pago' => $fecha_pago,
                ];
                $tabla[] = $calculo_mes;
            } else {
                // calcular
                $saldo = $saldo - $cuota;
                $fecha_pago = Carbon::parse($mes_anterior['fecha_pago']);

                if($frecuencia_pago == 'DIARIO'){
                    $fecha_pago->addDays(1)->format('d/m/Y');
                }else if($frecuencia_pago == 'SEMANAL'){
                    $fecha_pago->addDays(7)->format('d/m/Y');
                }else if($frecuencia_pago == 'QUINCENAL'){
                    $fecha_pago->addDays(15)->format('d/m/Y');
                }else if($frecuencia_pago == 'MENSUAL'){
                    $fecha_pago->addDays(30)->format('d/m/Y');
                }else{
                    $fecha_pago->addDays(7)->format('d/m/Y');
                }

                // if ($saldo < $cuota) {
                //     $cuota = $saldo;
                // }

                $calculo_mes = [
                    'mes' => $plazos,
                    'cuota' => number_format($cuota, 2),
                    'saldo' => number_format($saldo, 2),
                    'capital' => round($capital, 2),
                    'interes' => round($interes, 2),
                    'gasto_por_cobranza' => $gasto_por_cobranza,
                    'fecha_pago' => $fecha_pago,
                ];
                $tabla[] = $calculo_mes;
            }
            $mes_anterior = $calculo_mes;
        }
        // dd('la tabla', $tabla);

        return json_encode($tabla);
    }


    public function pdfSolicitud($id){
        $solicitud = Solicitud::where('id', $id)->get();
        $tablaAmortizacion = TablaAmortizacion::where('solicituds_id', $id)->get();
        $referencia_familiar = Referencia::where('clientes_id',$solicitud[0]->cliente_id)->where('tipo_referencia', 'FAMILIAR')->first();
        $referencia_comercial = Referencia::where('clientes_id',$solicitud[0]->cliente_id)->where('tipo_referencia', 'COMERCIAL')->first();
        $pdf_name = "SOLICITUD".$id.".PDF";
        return PDF::loadView('pdfs.solicitudCliente', compact('solicitud','tablaAmortizacion','referencia_familiar','referencia_comercial'))->setPaper('letter', 'portrait')->stream($pdf_name);
    }
}
