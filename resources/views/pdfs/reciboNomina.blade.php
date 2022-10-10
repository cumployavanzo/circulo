<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>

        </style>
        <title>RECIBO DE NOMINA</title>
    </head>
    <style>

    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    

    .lineaP{
        border: 1px dashed;
    }

    .bold{
        font-weight: bold;
    }
    .linea{
        border-top: 1px solid;
        border-right: 1px solid;
        border-bottom: 1px solid;
        border-left: 1px solid;
    }

    .linea2{
        border-top: 1px solid;
        border-right: 1px solid;
        border-bottom: 1px solid;
        border-left: 0;
    }
    .linea3{
        border-top: 1px solid;
        border-right: 1px solid;
        border-bottom: 0;
        border-left: 1px solid;
    }

    .linea4{
        border-top: 0;
        border-right: 1px solid;
        border-bottom: 1px solid;
        border-left: 1px solid;
    }
    .rfc_ptr div {
        /* color: red; */
        /* display: inline-block;    */

    } */
    .cabecera div {
        font-size: 20px;   
    }
    
    #fecha{
        font-size: 15px;
        float: right;
    }

    #cajon1{
        float:left;
        height: 90; 
        width: 48%;
        padding: 4px;
        font-size: 14px;
    }

    #cajon2{
        float:right;
        height: 90; 
        width: 50%;
        padding: 4px;
        font-size: 14px;
    }

    #cajon3{
        float:left;
        height: 110; 
        width: 58%;
        padding: 4px;
        font-size: 14px;
    }

    #cajon4{
        float:right;
        height: 110; 
        width: 40%;
        padding: 4px;
        font-size: 14px;
    }

    #cajon5{
        float:right;
        height: 70; 
        width: 40%;
        padding: 4px;
        font-size: 14px;
    }

    .one {
        margin-bottom: 550px;
    }  

   

    </style>
  @php
    function eliminar_acentos($cadena){
    
        //Reemplazamos la A y a
        $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena );

        //Reemplazamos la I y i
        $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena );

        //Reemplazamos la O y o
        $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena );

        //Reemplazamos la U y u
        $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
        );
    
        return $cadena;
    }
  @endphp
    <body>
        @forelse ($nomina as $value )
        @php
            $empresa = App\Empresa::select('empresas.*')->first();
           $persepciones =  App\DetalleNomina::select('detalle_nomina.*','movimiento_nomina.*','conceptos_nomina.*')
            ->where('movimiento_nomina.detalle_nomina_id', $value->detalle_nomina)
            ->where('conceptos_nomina.tipo', 'Persepcion')
            ->join('personals', 'personals.id', '=', 'detalle_nomina.personals_id')
            ->join('movimiento_nomina', 'movimiento_nomina.detalle_nomina_id', '=', 'detalle_nomina.id')
            ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'movimiento_nomina.conceptos_nomina_id')
            ->get(); 
           $deducciones =  App\DetalleNomina::select('detalle_nomina.*','movimiento_nomina.*','conceptos_nomina.*')
            ->where('movimiento_nomina.detalle_nomina_id', $value->detalle_nomina)
            ->where('conceptos_nomina.tipo', 'Deduccion')
            ->join('personals', 'personals.id', '=', 'detalle_nomina.personals_id')
            ->join('movimiento_nomina', 'movimiento_nomina.detalle_nomina_id', '=', 'detalle_nomina.id')
            ->join('conceptos_nomina', 'conceptos_nomina.id', '=', 'movimiento_nomina.conceptos_nomina_id')
            ->get(); 
            $carbonNow = \Carbon\Carbon::now()->toDateTimeString();
            $carbonNowHora = \Carbon\Carbon::now()->toTimeString();
            $actualDate = \Carbon\Carbon::parse($carbonNow)->format('d/m/Y'); 
        @endphp
        <div class="linea">
            <div class="cabecera">
                <div><b>&nbsp;{{ucwords(strtolower($empresa->razon_social))}}</b>
                    <span id="fecha">Fecha: &nbsp;&nbsp;{{ $actualDate }}&nbsp;</span>
                </div> 
            </div>
            <div>&nbsp;RFC:&nbsp; {{$empresa->rfc}}<span style="float:right; font-size: 15px;">Hora: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$carbonNowHora}}&nbsp;</span></div>
            <div>&nbsp;Reg Fiscal: {{ucwords(strtolower($empresa->regimen_capital))}} &nbsp;&nbsp;&nbsp;&nbsp; Reg Pat: {{$empresa->registro_patronal}}</div>
            <div>&nbsp;Lugar de Expedición:&nbsp; {{$empresa->cp}}&nbsp; {{ucwords(strtolower(eliminar_acentos($empresa->municipio)))}}</div>
        </div>
        <br>
        <div class="linea" id="cajon1 ">
            <div class="bold">{{$value->id}} - {{ucfirst(strtolower($value->apellido_paterno))}} {{ucfirst(strtolower($value->apellido_materno))}} {{ucwords(strtolower($value->nombre))}}</div>
            <div>RFC:  <span style="margin-left: 34%">{{$value->rfc}}</span></div>
            <div>CURP: <span style="margin-left: 31%">{{$value->curp}}</span></div>
            <div>Fecha Ini Relación Lab:<span style="margin-left: 5%">{{$value->fecha_alta}}</span></div>
            <div>Jornada: <span style="margin-left: 29%">01 Diurna</span></div>
            <div>NSS: <span style="margin-left: 34%">{{$value->imss}}</span></div>
            <div>Tipo Salario: <span style="margin-left: 21%">Fijo</span></div>
        </div>
        <div class="linea2"  id="cajon2">
            
            <div style="padding-left: 5px">
                <div class="bold">Ejercicio: 2020</div>
                {{-- <div class="bold">Periodo: 16 04 Quincenal &nbsp; 16/Ago/2022 - 31/Ago/2022</div> --}}
                <div class="bold">Periodo: <span style="margin-left: 6%">16 04 {{$nomina[0]->modalidad}}</span><span style="margin-left: 7%"> {{ date('d/m/Y', strtotime($nomina[0]->fecha_corte_ini))}} - {{ date('d/m/Y', strtotime($nomina[0]->fecha_corte_fin))}}</span></div>
                <div>Días de Pago:<span style="margin-left: 13%">15210</span></div>
                <div>Fecha Pago: <span style="margin-left: 15%">{{ date('d/m/Y', strtotime($nomina[0]->fecha_corte_fin))}}</span></div>
                <div>Puesto:<span style="margin-left: 24%">{{ucwords(strtolower($value->puesto))}}</span></div>
                <div>Depto:<span style="margin-left: 25%">-- --</span></div>
                <div>SBC: $<span style="margin-left: 24%">{{number_format($value->sueldo_mensual/30, 2, '.', '')}}</span> </div>
            </div>
        </div>
        <div class="linea3">
            <div class="bold"><span style="margin-left: 20%">Persepciones</span> <span style="margin-left: 40%"> Deducciones </span></div>
        </div>
        <div class="linea"  id="cajon3 ">
            <div class="bold"><span>Agrup</span><span style="margin-left: 5%">N°.</span><span style="margin-left:17%">Concepto</span><span style="margin-left: 42%">Total</span></div>
            <div class="bold"><span>&nbsp;SAT</span></div>
            <div style="position: relative">P<span style="position: absolute; left: 7%">001</span><span style="position: absolute; left: 20%">001</span><span style="position: absolute; left: 30%">Sueldo</span><span style="position: absolute; right: 1%">{{number_format($value->sueldo, 2, '.', '')}}</span></div>
            @php
                $sumaPersepcion = 0;
            @endphp
            @forelse ($persepciones as $persepcion)
                <div style="position: relative">P<span style="position: absolute; left: 7%">{{$persepcion->clave}}</span><span style="position: absolute; left: 20%">003</span><span style="position: absolute; left: 30%">{{ucwords(strtolower($persepcion->conceptos))}}</span><span style="position: absolute; right: 1%">{{number_format($persepcion->monto, 2, '.', '')}}</span></div>
                @php
                    $sumaPersepcion += $persepcion->monto;
                @endphp
            @empty
               
           @endforelse
            @php                  
                $totalPersepcion = $value->sueldo + $sumaPersepcion;
            @endphp
            {{-- <div style="position: relative">P<span style="position: absolute; left: 7%">049</span><span style="position: absolute; left: 20%">014</span><span style="position: absolute; left: 30%">Premios de Asistencia</span><span style="position: absolute; right: 1%">333.56</span></div>
            <div style="position: relative">P<span style="position: absolute; left: 7%">010</span><span style="position: absolute; left: 20%">015</span><span style="position: absolute; left: 30%">Premio de Puntualidad</span><span style="position: absolute; right: 1%">333.56</span></div>
            <div style="position: relative">P<span style="position: absolute; left: 7%">010</span><span style="position: absolute; left: 20%">015</span><span style="position: absolute; left: 30%">Despensa en Efectivo</span><span style="position: absolute; right: 1%">500.33</span></div> --}}
        </div>
        <div class="linea2"  id="cajon4 ">
            <div style="padding-left: 6px">
                <div class="bold"><span>Agrup</span><span style="margin-left: 5%">N°.</span><span style="margin-left:15%">Concepto</span><span style="margin-left: 27%">Total</span></div>
                <div class="bold"><span>&nbsp;SAT</span></div>
                @php
                    $sumaDeduccion = 0;
                @endphp
                @forelse ($deducciones as $deduccion)
                        <div style="position: relative">&nbsp;<span style="position: absolute; left: 3%">{{$deduccion->clave}}</span><span style="position: absolute; left: 15%">045</span><span style="position: absolute; left: 25%">{{ucwords(strtolower($deduccion->conceptos))}}</span><span style="position: absolute; right: 1%">{{number_format($deduccion->monto, 2, '.', '')}}</span></div>
                    @php
                        $sumaDeduccion += $deduccion->monto;
                    @endphp
                @empty
                    
                @endforelse
                @php                  
                    $totalDeduccion = $sumaDeduccion;
                @endphp
                {{-- <div style="position: relative">&nbsp;<span style="position: absolute; left: 3%">004</span><span style="position: absolute; left: 16%">079</span><span style="position: absolute; left: 30%">Otros descuentos</span><span style="position: absolute; right: 1%">3.56</span></div> --}}
            </div>
        </div>
        <div class="linea">
            <div class="bold"><span style="margin-left:1%">Total Percepc. más otros Pagos &nbsp;$</span> <span style="margin-left: 17%">{{number_format($totalPersepcion, 2, '.', '')}}</span></div>
        </div>
        <div class="linea4"  id="cajon5 ">
            <div class="bold" style="padding-left: 6px">
                <div style="position: relative">&nbsp;<span style="position: absolute; right: 45%">Subtotal $</span><span style="position: absolute; right: 1%">{{number_format($totalPersepcion, 2, '.', '')}}</span></div>
                <div style="position: relative">&nbsp;<span style="position: absolute; right: 45%">Descuentos $</span><span style="position: absolute; right: 1%">{{number_format($totalDeduccion, 2, '.', '')}}</span></div>
                <div style="position: relative">&nbsp;<span style="position: absolute; right: 45%">Retenciones $</span><span style="position: absolute; right: 1%">0.00</span></div>
                <div style="position: relative">&nbsp;<span style="position: absolute; right: 45%">Total $</span><span style="position: absolute; right: 1%">{{number_format($totalPersepcion - $totalDeduccion, 2, '.', '')}}</span></div>
                <div style="position: relative">&nbsp;<span style="position: absolute; right: 45%">Neto del recibo $</span><span style="position: absolute; right: 1%">{{number_format($totalPersepcion - $totalDeduccion, 2, '.', '')}}</span></div>
            </div>
        </div>
        <div class="pagebreak"> </div>
        @empty
            
        @endforelse
       
        
    </body>
</html>

