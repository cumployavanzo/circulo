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
            font-size: 7px;
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
            font-size:7px;
        }
        input[type=checkbox]{
            /* Doble-tamaño Checkboxes */
            -ms-transform: scale(2); /* IE */
            -moz-transform: scale(2); /* FF */
            -webkit-transform: scale(2); /* Safari y Chrome */
            -o-transform: scale(2); /* Opera */
            
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
</style>

<body>
    <table width="100%">
        <tr>
            <td width="10%" align="left">
                <table width="100%" >
                    <tr>
                        <td>Fecha de Entrega:</td>
                        <td width="70%"><b>09/11/2022</b></td>
                    </tr>
                    <tr>
                        <td >Folio:</td>
                        <td width="70%"><b>000012</b></td>
                    </tr>
                </table>
            </td>
            <td  width="10%" align="center">
                <P><b>S.O.S Prestamos</b><br><b>SOLICITUD</P>
            </td>
            <td width="10%" align="right">
                <img style="width: 25%;" src="../public/img/logo.jpg"  alt="logo">
            </td>
        </tr>
    </table>
    <h6 class="text-center">DATOS DEL SOLICITANTE</h6>
    <table class="table">
        <tr class="tr-borderless">
            <td  width="60px">Nombre Completo:</td>
            <td  width="150px"><b>{{$solicitud[0]->cliente->getFullName()}}</b></td>
            <td  width="50px" >Fecha Nacimiento:</td>
            <td  width="90px"><b>{{$solicitud[0]->cliente->fecha_nacimiento}}</b></td>
            <td  width="10px" >Edad:</td>
            <td  width="95px"><b>{{$solicitud[0]->cliente->edad}} Años</b></td>
            <td  width="10px" >Telefono:</td>
            <td  width="50px"><b>{{$solicitud[0]->cliente->celular}}</b></td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <td  width="15px">Colonia:</td>
            <td  width="20px"><b>{{$solicitud[0]->cliente->colonia}}</b></td>
            <td  width="5px">Ciudad:</td>
            <td  width="50px"><b>{{$solicitud[0]->cliente->ciudad}}</b></td>
            <td  width="15px" >Estado:</td>
            <td  width="25px"><b>{{$solicitud[0]->cliente->estado}}</b></td>
            <td  width="10px" >País:</td>
            <td  width="50px"  ><b>MÉXICO</b></td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <td  width="60px" >Dirección del Hogar:</td>
            <td  width="140px"><b>{{$solicitud[0]->cliente->direccion}}</b></td>
            <td  width="40px">Tipo Vialidad:</td>
            <td  width="40px"><b>{{$solicitud[0]->cliente->tipo_vialidad}}</b></td>
            <td  width="30px">Entre calles:</td>
            <td  width="100px"><b>{{$solicitud[0]->cliente->entre_calles}}</b></td>
            <td  width="20px">C.P:</td>
            <td  width="25px"><b>{{$solicitud[0]->cliente->cp}}</b></td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <td  width="15px">Colonia:</td>
            <td  width="20px"><b>{{$solicitud[0]->cliente->colonia}}</b></td>
            <td  width="5px">Ciudad:</td>
            <td  width="50px"><b>{{$solicitud[0]->cliente->ciudad}}</b></td>
            <td  width="15px" >Estado:</td>
            <td  width="25px"><b>{{$solicitud[0]->cliente->estado}}</b></td>
            <td  width="10px" >País:</td>
            <td  width="50px"  ><b>MÉXICO</b></td>
        </tr>
    </table>
    <table class="table ">
        <tbody>
            <tr>
                <td width="40px">Tipo de casa:</td>
                <td width="0px"><label><input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;Propia&nbsp;&nbsp;</label></td>
                <td width="0px"><label><input type="checkbox" class="" name="" id="" checked >&nbsp;&nbsp;Rentada&nbsp;&nbsp;</label></td>
                <td width="0px"><label><input type="checkbox" class="" name="" id="" checked >&nbsp;&nbsp;Familiar&nbsp;&nbsp;</label></td>
                <td  width="15px" >Estado:</td>
            <td  width="25px"><b>{{$solicitud[0]->cliente->estado}}</b></td>
            <td  width="10px" >País:</td>
            <td  width="50px"  ><b>MÉXICO</b></td>

            </tr>
           
        </tbody>
    </table>   
    <h6 class="text-center">DOMICILIO DE LA IDENTIFICACIÓN OFICIAL</h6>
    <table class="table ">
        <tr>
            <td  width="15px" >Calle y Número:</td>
            <td  width="200px" ><b>--</b></td>
            <td  width="10px"><b>1112</b></td>
            <td  width="30px" >No. Int.:</td>
            <td  width="10px"><b></b></td>
            <td  width="20px" >Colonia:</td>
            <td  width="100px"  ><b>--</b></td>
            <td  width="50px" >C.P:</td>
            <td  width="25px"  ><b>--</b></td>
        </tr>
    </table>
   
    <h6 class="text-center">DOMICILIO DEL COMPROBANTE DE DOMICILIO</h6>
    <table class="table">
        <tr>
            <td  width="15px" >Calle y Número:</td>
            <td  width="200px"  ><b>--</b></td>
            <td  width="20px" >Colonia:</td>
            <td  width="100px"  ><b>--</b></td>
            <td  width="50px" >C.P:</td>
            <td  width="25px"><b>-- </b></td>
        </tr>
    </table>
    <table class="table  ">
        <tr>
            <td  width="15px" >Municipio:</td>
            <td  width="20px"  ><b>--</b></td>
            <td  width="5px">Localidad:</td>
            <td  width="50px"><b>--</b></td>
            <td  width="15px" >Estado:</td>
            <td  width="25px"><b>--</b></td>
            <td  width="10px" >País:</td>
            <td  width="50px"  ><b>MÉXICO</b></td>
        </tr>
    </table>
    <table class="table  ">
        <tr class="tr-borderless">
            <td style="line-height: 1px" width="612px">
                <b>¿Se verificó la existencia de la Clave Única de Registro de Población en el registro oficial? </b> &nbsp;&nbsp; <label><input type="checkbox" class="" name="registro_oficial_si" id="" checked>&nbsp;&nbsp;Sí&nbsp;&nbsp;</label> <label><input type="checkbox" class="" name="registro_oficial_no" id="" >&nbsp;&nbsp;No&nbsp;&nbsp;</label><br>    
                    <b>¿Se verificó la coincidencia de los datos de la credencial para votar, en su caso, en ellos registros del Instituto Nacional Electoral? </b> &nbsp;&nbsp;<label><input type="checkbox" class="" name="registro_oficial_si" id="" checked>&nbsp;&nbsp;Sí&nbsp;&nbsp;</label> <label><input type="checkbox" class="" name="registro_oficial_no" id="" >&nbsp;&nbsp;No&nbsp;&nbsp;</label>
                
            </td>
        </tr>
    </table>
    <h6 class="text-center">CONOCIMIENTO DEL CLIENTE</h6>
    <table class="table ">
        <tbody>
            <tr>
                <td colspan="3" class="">1.- ¿El Cliente DECLARA utilizar el dinero del crédito para su beneficio?</td>
                <td colspan="3">2.- ¿El Cliente DECLARA utilizar el dinero del crédito es para otra persona? <br> <small>Si la respuesta anterior es Si, o su actividad es el hogar o estudiante, recabar el formato identificación de otras figuras.</small></td>
            </tr>
            <tr class="tr-borderless">
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id="" checked  >&nbsp;&nbsp;Si&nbsp;&nbsp;
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;No&nbsp;&nbsp;
                    </label>
                </td>
                <td class=""><b></b></td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""   >&nbsp;&nbsp;Si&nbsp;&nbsp;
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""  checked >&nbsp;&nbsp;No&nbsp;&nbsp;
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table ">
        <tbody>
            <tr class="tr-borderless">
                <td colspan="2" class="">
                    
                        3.- ¿Usted desempeña o ha desempeñado en los últimos 12 meses alguna función pública o política*,en el país o en el extranjero? <small>
                            *Presidente, Jefe de Gobierno, Secretario de Estado, Senador, Diputado, Gobernador, Presidente Municipal, Regidurías, Síndicos.
                        </small><br>

                        <label>
                            <input type="checkbox" class="" name="registro_oficial_si" id="" >&nbsp;&nbsp; Sí&nbsp;&nbsp;
                        </label> 
                        <label><input type="checkbox" class="" name="registro_oficial_no" id="" checked>
                            &nbsp;&nbsp;No
                        </label><br>
                        Cargo que desempeña: <br>
                        Dependencia o Intitución: <br>
                        Periodo: <br>
                        Pais: <br>
                        
                    
                </td>
                <td colspan="2">
                    
                        4.- ¿Algún familiar suyo, desempeña o ha desempeñado **Cónyuge, Concubina, Concubinario, Madre/Padre, Abuelo(a), Hijo(a), Nieto(a), Hermano(a), Cuñado(a), Yerno y/o Nuera, Suegro(a)? <small>
                            <i>*Presidente, Jefe de Gobierno, Secretario de Estado, Senador, Diputado, Gobernador, Presidente Municipal, Regidurías, Síndicos.</i>
                        </small><br>
                        <label>
                            <input type="checkbox" class="" name="registro_oficial_si" id="" >&nbsp;&nbsp;Sí&nbsp;&nbsp;
                        </label> 
                        <label><input type="checkbox" class="" name="registro_oficial_no" id="" checked>
                            &nbsp;&nbsp;No&nbsp;&nbsp;
                        </label>
                        <br>
                        Nombre del Familiar: <br>
                        Cargo y Dependencia<br>
                        Parentesco: <br>
                        Periodo: <br>
                    
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table ">
        <tbody>
            <tr>
                <td colspan="4" class=""> 5.- ¿Usted cuenta con participación en el capital social en alguna Persona Moral? <small>(PM)</small></td>
                <td colspan="4">6.- ¿De dónde provienen principalmente sus ingresos/recursos?</td>
            </tr>
            <tr class="tr-borderless">
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;Si&nbsp;&nbsp;
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id="" checked >&nbsp;&nbsp;No&nbsp;&nbsp;
                    </label>
                </td>
                <td>Nombre de la PM:</td>
                <td class=""><b></b></td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id="" checked >&nbsp;&nbsp;Actividad económica&nbsp;&nbsp;
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;Proveedor de recursos&nbsp;&nbsp;
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;Otros:&nbsp;&nbsp;
                    </label>
                </td>
            </tr>
        </tbody>
    </table>   
    <table class="table ">
        <tbody>
            <tr>
                <td colspan="5" class="border-right">7.- ¿Sus operaciones financieras generalmente las realiza vía? <small>(Instrumento monetario)</small> </td>
                <td>8.- Ubicación del proyecto(Estado)</td>
                <td>9.- Destino de los recursos <small>(especificar en que se invierte)</small> </td>
            </tr>
            <tr class="tr-borderless">
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id="" checked >&nbsp;&nbsp;Efectivo&nbsp;&nbsp;
                    </label>
                </td>
                <td style="padding-top:5px !important;">Monto Efectivo:</td>
                <td style="padding-top:5px !important;"> <b>$</b></td>
                <td>
                    <label>
                        <input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;Transferencia&nbsp;&nbsp;
                    </label>
                </td>
                <td class="border-right">
                    <label>
                        <input type="checkbox" class="" name="" id=""  >&nbsp;&nbsp;Cheque&nbsp;&nbsp;
                    </label>
                </td>
                <td>
                    <b> --</b>
                </td>
                <td>
                    <b>CAPITAL DE TRABAJO</b>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table  ">
        <tbody>
            <tr>
                <td>10.- Número de Disposiciones:</td>
                <td><b>1</b></td>
                <td>11.- No. Operaciones a realizar:</td>
                <td><b>4</b></td>
                <td>12.- Límite de operaciones a realizar:</td>
                <td><b>6</b></td>
                <td>13.- Monto límite de operaciones:</td>
                <td><b>$ ---</b></td>
            </tr>
        </tbody>
    </table>
    <table class="table ">
        <tbody>
            <tr>
                <td>14.- Monto promedio mensual de operaciones:</td>
                <td><b> $ --</b></td>
                <td>15.- Calificación de acuerdo al sistema:</td> 
                <td style="margin-left: 10px !important">
                    <label><input type="checkbox" class="" name="registro_oficial_si" id="" >&nbsp;&nbsp;Bajo&nbsp;&nbsp;</label>
                    <label><input type="checkbox" class="" name="registro_oficial_si" id=""  >&nbsp;&nbsp;Medio&nbsp;&nbsp;</label>
                    <label><input type="checkbox" class="" name="registro_oficial_si" id="" >&nbsp;&nbsp;Alto&nbsp;&nbsp;</label>
                </td>
            </tr>
        </tbody>
    </table>
    <h6 class="text-center">DATOS SOCIOECONOMICOS</h6>
    <table class="table ">
        <tbody>
            <tr>

            
                <td>Monto del crédito individual:</td>
                <td><b>$ --</b></td>
                <td>Plazo:</td>
                <td><b>--</b></td>
                <td>Periodicidad:</td>
                <td><b>--</b></td>
                <td>Ciclo:</td>
                <td><b>--</b></td>
                <td>Tipo actividad económica:</td>
                <td><b>--</b></td>
            </tr>
        </tbody>
    </table>
    <table class="table ">
        <tbody>
            <tr>
                <td>Estado Civil:</td>
                <td><b>--</b></td>
                <td>Número de dependientes:</td>
                <td><b>--</b></td>
                <td>Tipo de vivienda:</td>
                <td><b>--</b></td>
                <td>Tipo de negocio:</td>
                <td><b>--</b></td>
                <td>Tiempo en el negocio</td>
                <td><b>--</b></td>
            </tr>
        </tbody>
    </table>
    <table class="table ">
        <tbody>
            <tr>
                <td>Otros ingresos:</td>
                <td><b>--</b></td>
                <td>Tipo de ventas:</td>
                <td><b>--</b></td>
                <td>Inventario</td>
                <td><b>--</b></td>
            </tr>
        </tbody>
    </table>
   
   
</body>
</html>