<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>  

<style>
   
        td {
            font-size: 8px;
            
        }
        
        h6{
            font-size:9px !important;
            padding-top: -12px;
            height: 12px;
            background-color:rgba(192,192,192,0.3);
        }
        table{
        padding-top: -10px !important;
        /*padding-buttom: -20px !important
        border-spacing: none !important;
        margin-buttom:none !important;
        margin-buttom:-250px !important;*/
        
        }
        .table td, .table th{
            padding:0px !important;
            min-width:1px !important;
            
        }
        label{
            font-size:8px;
        }
        input[type=checkbox]{
            /* Doble-tamaño Checkboxes */
            -ms-transform: scale(2); /* IE */
            -moz-transform: scale(2); /* FF */
            -webkit-transform: scale(2); /* Safari y Chrome */
            -o-transform: scale(2); /* Opera */
            
        }

        #contenidoTabla {
  font-size: 105px;
}
        .answer{
            text-align:left;
        }
        /*tr{
            height: 20px !important;
        }*/
        .tr-borderless > td{
            border-top: none !important;
        }
        .border-topless{
            border-top: none !important;
        }
        .border-right{
            border-right: 1px solid black;
        }
        .signatures {
            margin-top:0px !important; /* tenia 5 */
            font-size:5.5px !important;
            width:125px !important;
            padding:5px;
        }
        .signature  td {
            padding:5px !important;
        }

        /*para los saltos de pagina del aval*/
        .wrapper-page {
            page-break-after: always;
        }<
        
        .wrapper-page:last-child {
            page-break-after: avoid;
        }

        .cuadrado {
            width: 70px;           /* Ancho de 150 píxeles */
            height: 70px;          /* Alto de 150 píxeles */
            background: rgb(224, 221, 221);        /* Fondo de color rojo */
            border: 1px solid #000; /* Borde color negro y de 1 píxel de grosor */
        }
    </style>
<body>
   
    <h6 class="text-center">TABLA DE AMORTIZACIÓN</h6>
    <table class="table" style="border: black 1px solid" style='font-size: 45px;'>
            <tr style="border: black 1px solid">
                <td style="border: black 1px solid">N°</td>
                <td style="border: black 1px solid">Fecha de Pago</td>
                <td style="border: black 1px solid">Pago</td>               
                <td style="border: black 1px solid">Firma</td>
            </tr>
        <tbody>
            @php
                $cont = 0;
            @endphp
            @foreach($tablaAmortizacion as $tAmortizacion)      
                @php
                    $cont ++;
                @endphp  
            <tr class="text-center" style="border: black 1px solid">
                <td style="border: black 1px solid" align="center">{{$cont}}</td>
                <td style="border: black 1px solid" style="border: black 1px solid"align="center">{{ date('d/m/Y', strtotime($tAmortizacion->fecha_pago))}}</td> 
                <td style="border: black 1px solid" align="center">{{ $tAmortizacion->pago }}</td>

                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table"  width="100%"> {{--  style="padding-top: 80px !important;" --}}
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