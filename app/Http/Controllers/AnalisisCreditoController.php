<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cliente;
use App\VariablesRiesgo;
use App\Analisis_credito;
use App\TablaAmortizacion;
use DateTime;
use Carbon\Carbon;
use App\Exports\ColocacionExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnalisisCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $solicitudes = Solicitud::name($name)
        ->join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
        ->paginate(10);
        return view('admin.analisis_credito.index', compact('solicitudes','name'));
    }

    public function create(Request $request)
    {

    }
    

    public function store(Request $request)
    {
        $solicitudes = Solicitud::all();
        $analisis = new Analisis_credito();
        $analisis->solicituds_id = $request->input('txt_idSolicitud');
        $analisis->users_id = auth()->user()->id;
        $analisis->monto_solicitado = (str_replace(",","",$request->input('txt_monto_solicitado')));
        $analisis->monto_autorizado = (str_replace(",","",$request->input('txt_monto_autorizado')));
        $analisis->total = (str_replace(",","",$request->input('txt_total_val')));
        $analisis->pago_semanal = (str_replace(",","",$request->input('txt_pago_val')));
        $analisis->capacidad_pago = $request->input('txt_cal_capPago');
        $analisis->score_riesgo = $request->input('txt_score_val');
        $analisis->probabilidad_incumplimiento = $request->input('txt_incumplimi_val');
        $analisis->indice_severidad = $request->input('txt_indice_val');
        $analisis->calculo_severidad = $request->input('txt_calculo_val');
        $analisis->perdida_esperada = $request->input('txt_perdida_val');
        $analisis->var = $request->input('txt_var_val');
        $analisis->estatus = $request->input('txt_estatus_analisis');
        $analisis->save();
        $idAnalis= $analisis["id"];

        Solicitud::where('id', $request->input('txt_idSolicitud'))->update([
            'estatus' => $request->input('txt_estatus_analisis'),
        ]);
        $this->guardarTablaAmortizacion($request,$idAnalis);
        // $this->guardarTablaAmortizacion($request);
        return redirect()->route('admin.analisis_credito.index');
    }

    
    public function guardarTablaAmortizacion(Request $request,$idAnalis)
    {
        $plazo = $request->txt_plazo;
        $frecuencia_pago = $request->txt_frecuencia_pago;
        $monto_solicitado = (str_replace(",","",$request->txt_monto_solicitado));
        $monto_autorizado = (str_replace(",","",$request->txt_monto_autorizado));
        $tasa = $request->txt_tasa; ////40
        $porcentaje = $tasa * (1/100);
        $saldo = (($monto_autorizado * $porcentaje) + $monto_autorizado); ////3500
        $capital = $monto_autorizado / $plazo; //178.77;
        $cuota = $saldo / $plazo; // 250;
        $interes = ($monto_autorizado * $porcentaje) / $plazo;
        $plazo = range(1,$plazo);
        $gasto_por_cobranza = '10.00';
        $dateS =  str_replace('/', '-', $request->txt_fdesembolso);
        $fecha_desembolso = date('Y-m-d', strtotime($dateS));
        $fecha_pago = Carbon::parse($fecha_desembolso);
       
        foreach($plazo as $plazos) {
           $tablaAmort = new TablaAmortizacion();
                // calcular
            $saldo = $saldo - $cuota;
            $fecha_pago = Carbon::parse($fecha_pago);
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
           
            $tablaAmort->analisis_credito_id = $idAnalis;
            $tablaAmort->solicituds_id = $request->input('txt_idSolicitud');
            $tablaAmort->fecha_pago = $fecha_pago;
            $tablaAmort->pago = $cuota;
            $tablaAmort->capital = $capital;
            $tablaAmort->interes = $interes;
            $tablaAmort->saldo_pendiente = $saldo;
            $tablaAmort->gasto_x_cobranza = $gasto_por_cobranza;
            $tablaAmort->save();     
        }
    }
    
    public function edit($id)
    {
        // dd($id);
        $solicitud = Solicitud::find($id);
        $clientes = Cliente::all();
        $opcionCliente = "N/A";
        if($solicitud->cliente()->first('id') != null){
            $opcionCliente = $solicitud->cliente()->first('id')->id;
        }
        $varEdad = VariablesRiesgo::where('variable', 'Edad')->get(); 
        $varSexo = VariablesRiesgo::where('variable', 'Sexo')->get(); 
        $varVivienda = VariablesRiesgo::where('variable', 'Vivienda')->get(); 
        $varEstadoC = VariablesRiesgo::where('variable', 'EstadoCivil')->get(); 
        $varDepEcon = VariablesRiesgo::where('variable', 'DependientesEconomicos')->get(); 
        $varEscolaridad = VariablesRiesgo::where('variable', 'Escolaridad')->get(); 
        $varCiclo = VariablesRiesgo::where('variable', 'Ciclo')->get(); 
        $varIngreso = VariablesRiesgo::where('variable', 'IngresoMensual')->get(); 
        Solicitud::where('id', $id)->update([
            'estatus' => 'Proceso',
            'users_id_analisis' => auth()->user()->id,
        ]);
        return view('admin.analisis_credito.addAnalisisRiesgo', compact('solicitud','clientes','opcionCliente','varEdad','varSexo','varVivienda','varEstadoC','varDepEcon','varEscolaridad','varCiclo','varIngreso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function obtenerDetalles($id){
        $cliente = Cliente::where('id', $id)->first();
        $asociado = $cliente->asociados->first();
        $operador = $asociado->operadores->first();
        //dd($cliente);
        return response()->json(["cliente" => $cliente, "asociado" => $asociado, "operador" => $operador]);
    }

    public function tablaAmortizacionRiesgo(Request $request)
    {
        //   dd($request, 'ok');

        $plazo = $request->plazo;
        $frecuencia_pago = $request->frecuencia_pago;
        $monto_solicitado = (str_replace(",","",$request->monto_solicitado));
        $monto_autorizado = (str_replace(",","",$request->monto_autorizado));
        $tasa = $request->tasa; ////40
        $porcentaje = $tasa * (1/100);
        $saldo = (($monto_autorizado * $porcentaje) + $monto_autorizado); ////3500
        $capital = $monto_autorizado / $plazo; //178.77;
        $cuota = $saldo / $plazo; // 250;
        $interes = ($monto_autorizado * $porcentaje) / $plazo;
        $tabla = [];
        $mes_anterior = [];
        $plazo = range(1,$plazo);
        $gasto_por_cobranza = '10.00';
        // $today = Carbon::now()->toDateString();
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
                $dateS =  str_replace('/', '-', $request->fecha_desembolso);
                $fecha_desembolso = date('Y-m-d', strtotime($dateS));
                $fecha_pago = Carbon::parse($fecha_desembolso);
                $fecha_pago->addDays(7)->format('d/m/Y');
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
        //  dd('la tabla', $tabla);

        return json_encode($tabla);
    }

    public function tablaRiesgo(Request $request)
    {
       
        $variable = VariablesRiesgo::where('id', $request->variable)->get(); 
        $datos= [
            'calificacion' => $variable[0]->calificacion,
            'beta' => $variable[0]->beta,
            'var' => $variable[0]->var,
            'zeta' => $variable[0]->zeta,
        ];
        $tabla[] = $datos;
        return json_encode($tabla);
    }

    public function colocacionClientes(Request $request){
        $f1 = Carbon::parse($request->fecha_inicial);
        $f2 = Carbon::parse($request->fecha_final);

        $data = Analisis_credito::select('analisis_credito.monto_autorizado','solicituds.fecha_desembolso','solicituds.tasa','solicituds.plazo','clientes.nombre','clientes.apellido_paterno','clientes.apellido_materno')
        ->where('desembolso','=','Desembolsado')
        ->whereBetween(('solicituds.fecha_desembolso'), [$f1, $f2])
        ->join('solicituds', 'solicituds.id', '=', 'analisis_credito.solicituds_id')
        ->join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
        ->get(); 
        return Excel::download(new ColocacionExport($data), 'colocacion'. '.xlsx');
     }

}
