<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>  

<body>
   
    <h6 class="text-center">CALENDARIO DE PAGOS</h6>

    <TABLE BORDER WIDTH="100%">
        <TR>
            <TH width="5">N°</TH>
            <TH width="40">Fecha de Pago</TH>
            <TH width="10">Pago</TH>
            <TH  width="50" >Firma</TH>
        </TR>

        @php
        $cont = 0;
        $fecha_pago ="";
        @endphp
        @foreach($tablaAmortizacion as $tAmortizacion)      
            @php
                $cont ++;
            @endphp  
        <tr>
            <td TD width="5">{{$cont}}</td>
            <td width="40" ALIGN=center>{{ date('d/m/Y', strtotime($tAmortizacion->fecha_pago))}}</td> 
            <td width="10" ALIGN=center>$ {{ $tAmortizacion->pago }}</td>
            <TD width="50"></TD>
        </tr>
        @php
            $newFecha_pago = date("d-m-Y",strtotime($tAmortizacion->fecha_pago."+ 7 days"));
            $newCont = $cont + 1;
            $newPago = $tAmortizacion->pago;
        @endphp  

        @endforeach
        <tr>
            <td TD width="5">{{$newCont}}</td>
            <td width="40" ALIGN=center>{{ date('d/m/Y', strtotime($newFecha_pago))}}</td> 
            <td width="10" ALIGN=center>$ ______</td>
            <TD width="50"></TD>
        </tr>
    </TABLE>

    <br>
    <table class="table"  width="100%">
        <tbody > 
           
            <tr style="height:2.1cm;text-align:left;">
                <td  style="text-align: justify;font-size:8pt" colspan="4"><br>
                    ACEPTO Y ME COMPROMETO A RESPETAR LAS POLITICAS ESTABLECIDAS EN ESTE PRESTAMO Y PAGAR UNA PENALIZACIÓN POR FALTA DE PAGO POR CADA DÍA DE <strong>$ 20.00 (VEINTE PESOS 00/100 M.N.) DE MORATORIO, DESPUES DE LAS 18:00 HRS.</strong><br><br>
                </td>
            </tr>
            <br>
            <tr>
                <td width="150px" ></td>
                <td class="" style="font-size:7px !important;" width="305px" align="center">
                    <b class="text-center">{{$solicitud[0]->cliente->getFullName()}}
                        ______________________________________________________________________________________________
                    </b>
                    <b class="text-center">NOMBRE Y FIRMA DEL SOLICITANTE</b>
                </td>
                <td width="150px" ></td>
            </tr>
          
        </tbody>
    </table> 
</body>
</html>