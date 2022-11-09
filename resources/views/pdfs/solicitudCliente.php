<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
</head>
<body>
   {{$solicitud}}
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
    <h6 class="text-center">IDENTIFICACIÓN DEL CLIENTE</h6>
    <table class="table  ">
        <tr class="tr-borderless">
            <td  width="70px">Nombre Completo:</td>
            <td  width="150px" class="answer"><b>{{$solicitud->rfc}}</b></td>
            <td  width="60px" >Fecha Nacimiento:</td>
            <td  width="50px"><b>--</b></td>
            <td  width="10px" >CURP:</td>
            <td  width="95px"><b>--</b></td>
            <td  width="10px" >Género:</td>
            <td  width="50px"><b>--</b></td>
        </tr>
    </table>
    <table class="table  ">
        <tr>
            <td  width="65px" >Nacionalidad:</td>
            <td  width="10px"  ><b>MEXICANA</b></td>
            <td  width="50px" >País de Nacimiento:</td>
            <td  width="50px"><b>--</b></td>
            <td  width="50px" >Ent. Fed. De Nacimiento:</td>
            <td  width="80px"><b>--</b></td>
            <td  width="50px" >Número de Teléfono:</td>
            <td  width="50px"><b>--</b></td>
        </tr>
    </table>
  
    <table class="table  ">
        <tr>
            <td  width="15px" >Profesión:</td>
            <td  width="50px"><b>--</b></td>
            <td  width="15px">Ocupación:</td>
            <td  width="50px"><b>--</b></td>
            <td  width="15px">Actividad:</td>
            <td  width="80px"><b>--</b></td>
            <td  width="15px" >R.F.C:</td>
            <td  width="20px"><b>--</b></td>
            <td  width="15px">FIEL:</td>
            <td  width="80px"><b>NO CUENTA CON ELLA</b></td>
        </tr>
    </table>
    <table class="table  ">
        <tr>
            <td  width="50px" >Correo Electrónico:</td>
            <td  width="100px"  ><b>--</b></td>
            <td  width="50px" >Clave de Elector:</td>
            <td  width="50px"><b>--</b></td>
            <td  width="15px" >Folio Identificación:</td>
            <td  width="80px"><b>--</b></td>
        </tr>
    </table>
    <h6 class="text-center">DOMICILIO DE LA IDENTIFICACIÓN OFICIAL</h6>
    <table class="table  ">
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
    <h6 class="text-center">DOMICILIO DEL COMPROBANTE DE DOMICILIO</h6>
    <table class="table  ">
        <tr>
            <td  width="15px" >Calle y Número:</td>
            <td  width="200px"  ><b>--</b></td>
            <!-- <td  width="30px" >No. Ext.:</td>
            <td  width="10px"><b>1112</b></td>
            <td  width="30px" >No. Int.:</td>
            <td  width="10px"><b></b></td>  -->
            <td  width="20px" >Colonia:</td>
            <td  width="100px"  ><b>--</b></td>
            <td  width="50px" >C.P:</td>
            <td  width="25px"  ><b>-- </b></td>
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
            <!-- <tr>
                <td>Cargo que desempeña:</td>
                <td></td>
                <td>Nombre del familiar:</td>
                <td></td>
            </tr>
            <tr>
                <td>Dependencia o Institución:</td>
                <td></td>
                <td>Cargo de DEpendencia:</td>
                <td></td>
            </tr>
            <tr>
                <td>Periodo:</td>
                <td></td>
                <td>Parentesco:</td>
                <td></td>
            </tr>
            <tr>
                <td>País:</td>
                <td></td>
                <td>Periodo:</td>
                <td></td>
            </tr>  -->
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
                <td> <b></b> </td>
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
    <table class="table ">
        <tbody>
            <!-- <tr>
                <td>Ingresos mensuales:</td>
                <td><b>$--</b></td>
                <td>Egresos mensuales:</td>
                <td><b>$--</b></td>
                
            </tr>  -->
        </tbody>
    </table>
   
    <table class="table  signatures " style="width: 90% !important">
        <tbody>
            <tr >
                <td width="305px" align="center"><b>DECLARACIÓN DEL EJECUTIVO</b></td>
                <td width="305px" align="center"><b>DECLARACIONES, MANIFIESTOS Y COMPROMISOS</b></td>
            </tr>
            <tr class="tr-borderless">
                <td align="justify" style="padding: 5px 10px 5px 0px!important;">   
                    
                        La información contenida en la presente solicitud se requisita conforme a los documentos e información aportada y
                        manifestada por el solicitante y declaro haberla cotejado contra los documentos originales, además de validar la
                        existencia de la actividad económica e información financiera; por lo que en caso de que fueren falsos, apócrifos y/o
                        alterados, desde ahora, acepto mi responsabilidad que derivado de ello, puede constituir delitos y generar problemas
                        en la recuperación de este crédito, así como mi recisión de la relación laboral sin responsabilidad para A CRECER
                        EUM, S.A. DE C.V., SOFOM, E.N.R. con independencia de las acciones civiles y penales que son de mi conocimiento y
                        que procedan conforme a derecho.
                    
                </td>
                <td width="305px" align="justify" style="padding: 5px 10px 5px 10px! !important;">
                    
                        Bajo protesta de decir verdad, declaro que la información proporcionada a A Crecer EUM, los datos en la presente
                        solicitud, así como la documentación presentada es verídica. De igual forma manifiesto bajo protesta de decir verdad
                        que todas las operaciones así como los actos jurídicos que solicito o me comprometo y obligo con A CRECER EUM, S.A.
                        de C.V., SOFOM, E.N.R., su destino o finalidad y su procedencia son lícitos.En atención a lo anterior me comprometo a
                        actualizar y proporcionar la información o documentación adicional que me sea solicitada por esta institución con los
                        fines relacionados a la operación y/o operaciones que tengo comprometidas con A CRECER EUM, S.A. de C.V., SOFOM,
                        E.N.R. por lo cual me obligo a brindar las facilidades que sean requeridas a esta empresa o a las personas que
                        representen sus intereses.
                    
                </td>
            </tr>
            <tr class="tr-borderless">
                <td class="" style="font-size:7px !important;" width="305px" align="center">
                    <b class="text-center">-----
                        ______________________________________________________________________________________________
                    </b>
                    <b class="text-center">Nombre y Firma del Ejecutivo de Cuenta</b>
                </td>
                <td width="305px" align="center">
                    
                </td>
            </tr>
            <tr class="tr-borderless">
                <td width="305px"></td>
                <td width="305px" align="justify" style="padding: 5px 10px 5px 10px! !important; margin-top: -30px !important">
                    <center><b>AVISO DE PRIVACIDAD</b></center> <br/>
                        A CRECER EUM, S.A. DE C.V., SOFOM E.N.R., con domicilio en 11 norte poniente, número 1112, colonia Vista Hermosa, Tuxtla Gutiérrez,
                        código postal 29030, Chiapas, utilizará sus datos personales recabados para (i) Verificar su identidad, localizarlo y contactarlo; (ii) Integrar
                        su expediente como solicitante y como acreditado; (iii) Realizar las consultas a las Sociedades de Información Crediticia y conocer su
                        historial crediticio (iv) Actualizar nuestras bases de datos y sistemas de administración de cartera; (v) atender sus solicitudes, dudas,
                        quejas, aclaraciones y sugerencias. Adicionalmente y como finalidades secundarias, sus datos personales podrán ser tratados para: (vi)
                        Fines estadísticos (vii) Fines mercadotécnicos y/o publicitarios y (viii) Prospección comercial. Para mayor información acerca del
                        tratamiento y de los derechos que puede hacer valer, usted puede acceder al aviso de privacidad integral a través de la página de internet
                        http://www.acrecercc.com.
                    
                </td>
            </tr>
            <tr class="tr-borderless">
                <td width="305px"></td>
                <td class="" style="font-size:7px !important;" width="305px" align="center">
                    <b style="margin-buttom: -555 px;">---</b>
                    <b> ______________________________________________________________________________________________</b>
                    <b class="text-center ">Nombre y Firma del Solicitante</b>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>