<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
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

$personal = App\Personal::where('id', $user->personals_id)->first(); ////consulta para mostrar el nombre del empleado
@endphp
<body>
    <h2>Bienvenido: {{ucwords(strtolower($personal->nombre))}} {{ucwords(strtolower(eliminar_acentos($personal->apellido_paterno)))}}</h2>
    <p>¡Gracias por registrarte en <b>ME ALCANZA</b>!</p>
    <p> Por favor verifique su dirección de correo electrónico haciendo clic en el botón a continuación: </p>

    <button class="btn btn-block btn-info btn-sm"><a href="{{ route('verificacion' , $user->confirmation_code) }}">Clic para confirmar correo electrónico</a></button>
  
    <p>Tenga en cuenta que las cuentas no verificadas se eliminan automáticamente en 30 días después de registrarse.</p>
    <p>Nota: Si no solicitó esto, ignore este correo electrónico.</p>
</body>
</html>