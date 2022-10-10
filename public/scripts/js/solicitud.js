function calculaFechDesemb(){
    let fecha_solic = $("#txt_fsolicitud").val();
    let part = [];
    part = fecha_solic.split("/");
    let fecha1 = part[0];
    let fecha2 = part[1];
    let fecha3 = part[2];
    let newdate=(fecha3+"-"+ fecha2 +"-"+ fecha1);
    let fechaFormat = new Date(newdate);
    var dias = 2; // Número de días a agregar
    fechaFormat.setDate(fechaFormat.getDate() + dias);
    fechaFinal = moment(fechaFormat).utc().format('DD/MM/YYYY');
    $("#txt_fdesembolso").val(fechaFinal);
}

function calculaFechaPpago(){
    let fecha_solic = $("#txt_fsolicitud").val();
    let frecuencia_pago = $("#txt_frecuencia_pago").val();
    let part = [];
    part = fecha_solic.split("/");
    let fecha1 = part[0];
    let fecha2 = part[1];
    let fecha3 = part[2];
    let newdate=(fecha3+"-"+ fecha2 +"-"+ fecha1);
    let fechaFormat = new Date(newdate);
    if(frecuencia_pago == 'DIARIO'){
        var dias = 3; // Número de días a agregar, SE SUMA 1 DIAS MAS TRES DIAS DEL DESEMBOLSO
    }else if(frecuencia_pago == 'SEMANAL'){
        var dias = 9; // Número de días a agregar, SE SUMA 7 DIAS MAS TRES DIAS DEL DESEMBOLSO
    }else if(frecuencia_pago == 'QUINCENAL'){
        var dias = 17; // Número de días a agregar, SE SUMA 15 DIAS MAS TRES DIAS DEL DESEMBOLSO   
    }else if(frecuencia_pago == 'MENSUAL'){
        var dias = 32; // Número de días a agregar, SE SUMA 15 DIAS MAS TRES DIAS DEL DESEMBOLSO
    }else{
        var dias = 10; // Número de días a agregar, SE SUMA 7 DIAS MAS TRES DIAS DEL DESEMBOLSO
    }
    fechaFormat.setDate(fechaFormat.getDate() + dias);
    fechaFinal = moment(fechaFormat).utc().format('DD/MM/YYYY');
    $("#txt_fprimer_pago").val(fechaFinal);
}

function calculaFechaVenc(){
    let fecha_solic = $("#txt_fsolicitud").val();
    let frecuencia_pago = $("#txt_frecuencia_pago").val();
    let plazo = $("#txt_plazo").val();
    let part = [];
    part = fecha_solic.split("/");
    let fecha1 = part[0];
    let fecha2 = part[1];
    let fecha3 = part[2];
    let newdate=(fecha3+"-"+ fecha2 +"-"+ fecha1);
    let fechaFormat = new Date(newdate);
    if(frecuencia_pago == 'DIARIO'){
        var dias = (1 * plazo) + 2; // Número de días a agregar, 1 por la frecuencia diaria, multiplicado por el plazo mas los dos dias de la fecha de desembolso 
    }else if(frecuencia_pago == 'SEMANAL'){
        var dias = (7 * plazo) + 2; // Número de días a agregar, 7 por la frecuencia semanal, multiplicado por el plazo mas los dos dias de la fecha de desembolso 
    }else if(frecuencia_pago == 'QUINCENAL'){
        var dias = (15 * plazo) + 2;
    }else if(frecuencia_pago == 'MENSUAL'){
        var dias = (30 * plazo) + 2;
    }else{
        var dias = 101; // Número de días a agregar
    }
    fechaFormat.setDate(fechaFormat.getDate() + dias);
    fechaFinal = moment(fechaFormat).utc().format('DD/MM/YYYY');
    $("#txt_fvencimiento").val(fechaFinal);
}


function capacidadPago(){
    let ingreso = convertir($("#txt_ingreso_mensual").val());
    let gasto_mensual = convertir($("#txt_gasto_mensual").val());
    let monto_solic = convertir($("#txt_monto_solicitado").val());
    if (isNaN(ingreso) || isNaN(gasto_mensual) || isNaN(monto_solic)) {
        $("#txt_capacidad_pago").val("")
    }else{   
        let formula = ((ingreso - gasto_mensual) / monto_solic) * 100
        // let resultado = formula.toFixed(2)
        $("#txt_capacidad_pago").val(formula)
    }

}

function cuota(){
    let monto_solicitado = convertir($("#txt_monto_solicitado").val());
    let tasa = $("#txt_tasa").val();
    let plazo = $("#txt_plazo").val();
    let porcentaje = tasa * (1/100);
    if (isNaN(monto_solicitado) || isNaN(tasa) || isNaN(plazo)) {
        $("#txt_cuota").val("")
    }else{   
        let formulaCuota = ((monto_solicitado * porcentaje) + monto_solicitado) / plazo
        let saldoPendiente= ((monto_solicitado * porcentaje) + monto_solicitado)
        let resultado2 = formulaCuota.toFixed(2)
        $("#txt_cuota").val(resultado2)
    }

}

function calcularTablaAmortizacion(){
    let cuota = document.getElementById("txt_cuota").value;
    let plazo = document.getElementById("txt_plazo").value;
    let tasa = document.getElementById("txt_tasa").value;
    let frecuencia_pago = document.getElementById("txt_frecuencia_pago").value;
    let monto_solicitado = document.getElementById("txt_monto_solicitado").value;
    let fecha_desembolso = document.getElementById("txt_fdesembolso").value;
    csrfc = $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        type: 'POST',
        url: '/admin/solicitud/detalleTablaAmortizacion',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"json",
        data: {
            _token: csrfc,
            monto_solicitado : monto_solicitado,
            cuota : cuota,
            plazo : plazo,
            tasa : tasa,
            fecha_desembolso : fecha_desembolso,
            frecuencia_pago : frecuencia_pago,

        },
        
        success:function(data){
            console.log(data);
            vistaTablaAmortizacion(data);
        }
    });

    calculaFechDesemb();
    calculaFechaPpago();
    calculaFechaVenc();
}

function vistaTablaAmortizacion(tabla) {
    let html = '';
    tabla.forEach(fila =>  {
        
        html += '<tr><td>'+fila.mes+'</td><td>'+moment(fila.fecha_pago).utc().format('DD/MM/YYYY')+'</td><td>'+fila.cuota+'</td><td>'+fila.capital+'</td><td>'+fila.interes+'</td><td>'+fila.saldo+'</td><td>'+fila.gasto_por_cobranza+'</td></tr>'
    })
    $("#tabla").html(html);
}

