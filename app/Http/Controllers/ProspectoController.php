<?php

namespace App\Http\Controllers;

use App\Prospecto;
use App\Cliente;
use App\EstadoNacimiento;
use App\SucursalRuta;
use App\Scoring;
use App\User;
use App\Expediente;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer;


class ProspectoController extends Controller
{
    //
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        if(auth()->user()->roles_id == 1){ ///si es administrador ve todo
            $prospectos = Prospecto::name($name)->where('estatus','Prospecto')->paginate(10);
        }else{
            $prospectos = Prospecto::name($name)->where('users_id',  auth()->user()->id)->where('estatus','Prospecto')->paginate(10);
        }
        return view('admin.prospectos.index', compact('prospectos','name'));
    }

    public function subirExpedientes(Request $request , $idCliente){
        $expediente = Expediente::where('clientes_id', $idCliente)->first(); 
        return view('admin.prospectos.upExpediente', compact('expediente','idCliente'));

    }

    
    public function create()
    {
        $prospectos = Prospecto::all();
        $estados_nac = EstadoNacimiento::all();
        $rutas = SucursalRuta::all();
        return view('admin.prospectos.addProspectos', compact('prospectos','estados_nac','rutas'));
    }



    public function store(Request $request)
    {
        // dd($request);
        $prospecto = new Prospecto();
        $user = User::where('id', auth()->user()->id)->first();
        $prospecto->users_id = auth()->user()->id;
        $prospecto->personals_id = $user["personals_id"];
        $prospecto->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $prospecto->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $prospecto->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $prospecto->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $prospecto->telefono = $request->input('txt_celular');
        $prospecto->fecha_nacimiento = $request->input('txt_fecha_nac');
        $prospecto->edad = mb_strtoupper($request->input('txt_edad'), 'UTF-8');
        $prospecto->genero = mb_strtoupper($request->input('txt_genero'), 'UTF-8');
        $prospecto->clave_estado_nacimiento = $request->input('txt_estado_nacimiento');
        $prospecto->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $prospecto->cp = $request->input('txt_codigo_postal');
        $prospecto->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $prospecto->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $prospecto->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $prospecto->sucursales_id = $request->input('txt_ruta');
        $prospecto->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $prospecto->tipo_vialidad = $request->input('txt_vialidad');
        $prospecto->entre_calles = mb_strtoupper($request->input('txt_entre_calles'), 'UTF-8');
        $prospecto->save();
        return redirect()->route('admin.prospecto.index');
    }

    public function edit($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        $expediente = Expediente::where('clientes_id', $id)->first();
       
        return view('admin.prospectos.edit', compact('cliente','expediente'));
    }

    public function update(Request $request, $id)
    {
        Prospecto::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre , 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno, 'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno , 'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => mb_strtoupper($request->txt_genero,'UTF-8'),
            'clave_estado_nacimiento' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'telefono' => $request->txt_celular,
            'direccion' => mb_strtoupper($request->txt_direccion,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal,'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia,'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad,'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado,'UTF-8'),
            'referencia' => mb_strtoupper($request->txt_referencia,'UTF-8'),
            'tipo_vialidad' => $request->txt_vialidad,
            'entre_calles' => mb_strtoupper($request->txt_entre_calles,'UTF-8')
        ]);
        return redirect()->route('admin.prospecto.edit',[$id])->with('mensaje', 'Se ha editado el Prospecto exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }

    public function loginCliente(){
        $estados_nac = EstadoNacimiento::all();
        return view('admin.prospectos.loginCliente', compact('estados_nac'));
    }


    public function listadoEncuestas(Request $request){
        // dd($request);

        $cliente = new Cliente();
        $cliente->nombre = mb_strtoupper($request->input('nombre'), 'UTF-8');
        $cliente->apellido_paterno = mb_strtoupper($request->input('primer_apellido'), 'UTF-8');
        $cliente->apellido_materno = mb_strtoupper($request->input('segundo_apellido'), 'UTF-8');
        $cliente->fecha_nacimiento = $request->input('fecha_nacimiento');
        $cliente->edad = $request->input('edad');
        $cliente->genero = $request->input('genero');
        $cliente->celular = $request->input('telefono');
        $cliente->telefono_emergencia = $request->input('telefono_emergencia');
        $cliente->email = $request->input('email');
        $cliente->estado = $request->input('txt_estado_nacimiento');
        // $cliente->estados_nacimientos_clave = mb_strtoupper($request->input('txt_estado_nacimiento'), 'UTF-8');
        $cliente->save();
        $idcliente= $cliente["id"];

        $encuestaScore = new Scoring();
        $encuestaScore->cuanto_dinero_necesitas = $request->input('dinero');
        $encuestaScore->plazo = $request->input('plazo');
        $encuestaScore->sueldo_mensual = $request->input('sueldo');
        $encuestaScore->ocupacion = $request->input('ocupacion');
        $encuestaScore->tipo_empleo = $request->input('tipo_empleo');
        $encuestaScore->industria_trabajas = $request->input('industria_trabajas');
        if($request->input('industria_trabajas') == 'GOBIERNO'){
            $encuestaScore->area_trabajas = $request->input('area_gobierno');
        }else if($request->input('industria_trabajas') == 'SALUD Y BELLEZA'){
            $encuestaScore->area_trabajas = $request->input('area_salud');
        }else if($request->input('industria_trabajas') == 'EDUCACION'){
            $encuestaScore->area_trabajas = $request->input('area_educacion');
        }else if($request->input('industria_trabajas') == 'MANUFACTURA'){
            $encuestaScore->area_trabajas = $request->input('area_manufactura');
        }else if($request->input('industria_trabajas') == 'TRANSPORTE Y AUTOMOTRIZ'){
            $encuestaScore->area_trabajas = $request->input('area_transporte');
        }else if($request->input('industria_trabajas') == 'SERVICIO Y COMERCIO'){
            $encuestaScore->area_trabajas = $request->input('area_servicio');
        }else if($request->input('industria_trabajas') == 'SERVICIOS PROFESIONALES'){
            $encuestaScore->area_trabajas = $request->input('area_profesionales');
        }else if($request->input('industria_trabajas') == 'CAMPO E INDUSTRIAL'){
            $encuestaScore->area_trabajas = $request->input('area_industrial');
        }else if($request->input('industria_trabajas') == 'HOSPITALIDAD Y TURISMO'){
            $encuestaScore->area_trabajas = $request->input('area_hospital');
        }else if($request->input('industria_trabajas') == 'RESTAURANTES'){
            $encuestaScore->area_trabajas = $request->input('area_restaurante');
        }else if($request->input('industria_trabajas') == 'RECREACION Y CULTURA'){
            $encuestaScore->area_trabajas = $request->input('area_recreacion');
        }else if($request->input('industria_trabajas') == 'TECNOLOGIA Y COMUNICACION'){
            $encuestaScore->area_trabajas = $request->input('area_tecnologia');
        }
        $encuestaScore->ingreso_fam_mensual = $request->input('ingreso_familiar');
        $encuestaScore->pago_institucion_financiera = $request->input('pago');

        $encuestaScore->enque_emplearas_credito = $request->input('destino_credito');

        if($request->input('destino_credito') == 'EDUCACION'){
            $encuestaScore->tipo_gasto = $request->input('uso_educacion');
        }else if($request->input('destino_credito') == 'HOGAR'){
            $encuestaScore->tipo_gasto = $request->input('uso_hogar');
        }else if($request->input('destino_credito') == 'GASTOS PERSONALES'){
            $encuestaScore->tipo_gasto = $request->input('uso_gastos');
        }else if($request->input('destino_credito') == 'AUTOMOVIL'){
            $encuestaScore->tipo_gasto = $request->input('uso_automovil');
        }else if($request->input('destino_credito') == 'DEUDAS'){
            $encuestaScore->tipo_gasto = $request->input('uso_deudas');
        }else if($request->input('destino_credito') == 'SALUD'){
            $encuestaScore->tipo_gasto = $request->input('uso_salud');
        }

        $encuestaScore->tarjeta_credito = $request->input('tarjeta_c');
        $encuestaScore->credito_auto = $request->input('credito_auto');
        $encuestaScore->credito_casa = $request->input('credito_casa');
        $encuestaScore->historial_crediticio = $request->input('historial');
        $encuestaScore->clientes_id = $idcliente;
        $encuestaScore->save();

        $dataScore = $this->validacionScore($request, $idcliente);

        //  dd($dataScore['scoreTotal']);
        Scoring::where('clientes_id', $idcliente)->update([
            'score' => $dataScore['scoreTotal']
        ]);

        if($dataScore['scoreTotal'] < 60){
            Cliente::where('id', $idcliente)->update([
                'state_encuesta' => 'Rechazado',
                'tipo_cliente' => 'Prospecto'
            ]);

        }else if($dataScore['scoreTotal'] >= 60){
            Cliente::where('id', $idcliente)->update([
                'state_encuesta' => 'Aceptado',
                'tipo_cliente' => 'Cliente'

            ]);
        }

        $this->enviarCorreo($idcliente);


        $prospecto = Cliente::where('id', $idcliente)->first();


        return redirect()->route('loginCliente')->with('mensaje', 'Tus datos se han enviado exitosamente')->with('email',$prospecto->email)->with('telefono',$prospecto->celular)->with('nombre',$prospecto->nombre)->with('apellido_p',$prospecto->apellido_paterno)->with('apellido_m',$prospecto->apellido_materno);
       

        


    }

    public function validacionScore(Request $request, $idprospecto){

        //  dd($request);
        if($request->genero == 'Femenino'){
           $scoreG = 6;
        }else{
           $scoreG = 4;
        }
        if($request->edad >= 0 && $request->edad <= 17){
            $scoreE = -99999;
        }else if($request->edad >= 18 && $request->edad <= 25){
            $scoreE = 10;
        }else if($request->edad >= 26 && $request->edad <= 33){
            $scoreE = 35;
        }else if($request->edad >= 34 && $request->edad <= 49){
            $scoreE = 20;
        }else if($request->edad >= 50 && $request->edad <= 57){
            $scoreE = 10;
        }else if($request->edad >= 58 && $request->edad <= 65){
            $scoreE = 5;
        }else if($request->edad >=66){
            $scoreE = -99999;
        }else{
            $scoreE = -99999;
        }

       

        $estados0 = array ("BAJA CALIFORNIA" => "BAJA CALIFORNIA", "CHIAPAS" => "CHIAPAS", "CHIHUAHUA" => "CHIHUAHUA", "COAHUILA" => "COAHUILA", "DISTRITO FEDERAL" => "DISTRITO FEDERAL", "GUANAJUATO" => "GUANAJUATO", "JALISCO" => "JALISCO", "MEXICO" => "MEXICO", "NUEVO LEON" => "NUEVO LEON", "PUEBLA" => "PUEBLA", "TABASCO" => "TABASCO", "TAMAULIPAS" => "TAMAULIPAS", "VERACRUZ" => "VERACRUZ");
        $estados050 = array ("CAMPECHE" => "CAMPECHE", "MORELOS" => "MORELOS", "QUERETARO" => "QUERETARO", "SONORA" => "SONORA", "YUCATAN" => "YUCATAN");
        $estados1 = array ("AGUASCALIENTES" => "AGUASCALIENTES", "BAJA CALIFORNIA SUR" => "BAJA CALIFORNIA SUR", "COLIMA" => "COLIMA", "GUERRERO" => "GUERRERO", "HIDALGO" => "HIDALGO", "MICHOACAN" => "MICHOACAN", "QUINTANA ROO" => "QUINTANA ROO", "SAN LUIS POTOSI" => "SAN LUIS POTOSI", "SINALOA" => "SINALOA", "TLAXCALA" => "TLAXCALA");
        $estados250 = array ("ZACATECAS" => "ZACATECAS");
        $estados3 = array ("NAYARIT" => "NAYARIT", "OAXACA" => "OAXACA");
        $estados4 = array ("DURANGO" => "DURANGO");
      
        if(array_key_exists($request->txt_estado_nacimiento, $estados0)){
            $scoreEst = 0;
        }else if(array_key_exists($request->txt_estado_nacimiento, $estados050)){
            $scoreEst = 0.5;
        }else if(array_key_exists($request->txt_estado_nacimiento, $estados1)){
            $scoreEst = 1;
        }else if(array_key_exists($request->txt_estado_nacimiento, $estados250)){
            $scoreEst = 2.5;
        }else if(array_key_exists($request->txt_estado_nacimiento, $estados3)){
            $scoreEst = 3;
        }else if(array_key_exists($request->txt_estado_nacimiento, $estados4)){
            $scoreEst = 4;
        }else{
            $scoreEst = 0;
        }


        if($request->sueldo == 'Menos de $5,000'){
            $scoreS = 0;
        }else if($request->sueldo == 'De $5,000 a $7,000'){
            $scoreS = 1;
        }else if($request->sueldo == 'De $7,001 a $10,000'){
            $scoreS = 4;
        }else if($request->sueldo == 'De $10,001 a $15,000'){
            $scoreS = 5;
        }else if($request->sueldo == 'Mas de $15,000'){
            $scoreS = 10;
        }else{
            $scoreS = 0;
        }


        if($request->ocupacion == 'Estudiante'){
            $scoreO = 0.50;
        }else if($request->ocupacion == 'Ama de Casa' || $request->ocupacion == 'Otro'){
            $scoreO = 1;
        }else if($request->ocupacion == 'Jubilado Pensionado'){
            $scoreO = 1.50;
        }else if($request->ocupacion == 'Dueño de Negocio' || $request->ocupacion == 'Trabajo por cuenta Propia'){
            $scoreO = 2;
        }else if($request->ocupacion == 'Empleado'){
            if($request->tipo_empleo == 'Operativo'){
                $scoreO = 2.20; ////2 por seer de ocupacion empleado y .20 por ser operativo
            }else if($request->tipo_empleo == 'Administrativo'){
                $scoreO = 2.30; ////2 por seer de ocupacion empleado y .30 por ser administrativo
            }else if($request->tipo_empleo == 'Directivo' || $request->tipo_empleo == 'Sindicalizado'){
                $scoreO = 2.75; ////2 por seer de ocupacion empleado y .75 por ser sindicalizado o directivo
            } 
        }else if($request->ocupacion == 'Desempleado' ){
            $scoreO = -99999;
        }else{
            $scoreO = 0;
        }


        if($request->industria_trabajas == 'GOBIERNO'){
            if($request->area_gobierno == 'Seguridad Publica' || $request->area_gobierno == 'Otro'){
                $scoreI = 0.10;
            }else if($request->area_gobierno == 'Fuerzas Armadas' || $request->area_gobierno == 'Municipal'){
                $scoreI = 0.25;
            }else if($request->area_gobierno == 'Estatal'){
                $scoreI = 0.50;
            }else if($request->area_gobierno == 'Federal'){
                $scoreI = 0.80;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'SALUD Y BELLEZA'){
            if($request->area_salud == 'Farmaceutica'){
                $scoreI = 0.10;
            }else if($request->area_salud == 'Nutricion' || $request->area_salud == 'Cuidado Personal' || $request->area_salud == 'Belleza'){
                $scoreI = 0.20;
            }else if($request->area_salud == 'Farmaceutica'){
                $scoreI = 0.30;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'EDUCACION'){
            if($request->area_educacion == 'Otro'){
                $scoreI = 0;
            }else if($request->area_educacion == 'Basica'){
                $scoreI = 0.25;
            }else if($request->area_educacion == 'Media'){
                $scoreI = 0.75;
            }else if($request->area_educacion == 'Superior'){
                $scoreI = 1;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'MANUFACTURA'){
            if($request->area_manufactura == 'Otro'){
                $scoreI = 0.05;
            }else if($request->area_manufactura == 'Metal Mecanica'){
                $scoreI = 0.10;
            }else if($request->area_manufactura == 'Textil'){
                $scoreI = 0.15;
            }else if($request->area_manufactura == 'Electronica'){
                $scoreI = 0.20;
            }else if($request->area_manufactura == 'Automotriz'){
                $scoreI = 0.50;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'TRANSPORTE Y AUTOMOTRIZ'){
            if($request->area_transporte == 'Reparacion y Mantenimiento'){
                $scoreI = 0.10;
            }else if($request->area_transporte == 'Mensajeria'){
                $scoreI = 0.15;
            }else if($request->area_transporte == 'Publico y Privado'){
                $scoreI = 0.25;
            }else if($request->area_transporte == 'Taxi y Aplicaciones'){
                $scoreI = 0.50;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'SERVICIO Y COMERCIO'){
            if($request->area_servicio == 'Supermercado y Abarrotes'){
                $scoreI = 0;
            }else if($request->area_servicio == 'Departamental y Modas' || $request->area_servicio == 'Alimentos' || $request->area_servicio == 'Bienes Raices'  || $request->area_servicio == 'Seguridad Privada' || $request->area_servicio == 'Gasolineria y Gas' || $request->area_servicio == 'Otro'){
                $scoreI = 0.10;
            }else if($request->area_servicio == 'Construccion y Limpieza' || $request->area_servicio == 'Electronica y Agua'){
                $scoreI = 0.20;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'SERVICIOS PROFESIONALES'){
            if($request->area_profesionales == 'Otro'){
                $scoreI = 0;
            }else if($request->area_profesionales == 'Contabilidad'){
                $scoreI = 0.5;
            }else if($request->area_profesionales == 'Consultoria' || $request->area_profesionales == 'Publicidad y Mercadotecnia' || $request->area_profesionales == 'Seguros'){
                $scoreI = 0.10;
            }else if($request->area_profesionales == 'Financieros' || $request->area_profesionales == 'Legales'){
                $scoreI = 0.20;
            }else if($request->area_profesionales == 'Investigacion y Desarrollo'){
                $scoreI = 0.25;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'CAMPO E INDUSTRIAL'){
            if($request->area_industrial == 'Otro'){
                $scoreI = 0.10;
            }else if($request->area_industrial == 'Agricultura' || $request->area_industrial == 'Ganaderia' || $request->area_industrial == 'Pesca'){
                $scoreI = 0.20;
            }else if($request->area_industrial == 'Mineria'){
                $scoreI = 0.25;
            }else if($request->area_industrial == 'Petrolera'){
                $scoreI = 0.45;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'HOSPITALIDAD Y TURISMO'){
            if($request->area_hospital == 'Otro'){
                $scoreI = 0.05;
            }else if($request->area_hospital == 'Turismo'){
                $scoreI = 0.25;
            }else if($request->area_hospital == 'Viajes'){
                $scoreI = 0.70;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'RESTAURANTES'){
            if($request->area_restaurante == 'Otro'){
                $scoreI = 0;
            }else if($request->area_restaurante == 'Fonda'){
                $scoreI = 0.10;
            }else if($request->area_restaurante == 'Cafeteria'){
                $scoreI = 0.15;
            }else if($request->area_restaurante == 'Bar'){
                $scoreI = 0.25;
            }else if($request->area_restaurante == 'Restaurante'){
                $scoreI = 0.50;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'RECREACION Y CULTURA'){
            if($request->area_recreacion == 'Otro'){
                $scoreI = 0.05;
            }else if($request->area_recreacion == 'Arte y Cultura'){
                $scoreI = 0.25;
            }else if($request->area_recreacion == 'Entretenimiento'){
                $scoreI = 0.70;
            }else{
                $scoreI = 0;
            }
        }else if($request->industria_trabajas == 'TECNOLOGIA Y COMUNICACION'){
            if($request->area_tecnologia == 'Reparacion y Soporte' || $request->area_tecnologia == 'Otro'){
                $scoreI = 0.05;
            }else if($request->area_tecnologia == 'Imprenta' || $request->area_tecnologia == 'Medios de Comunicacion' ){
                $scoreI = 0.10;
            }else if($request->area_tecnologia == 'Callcenter' || $request->area_tecnologia == 'Editorial'){
                $scoreI = 0.20;
            }else if($request->area_tecnologia == 'Telefonia e Internet'){
                $scoreI = 0.55;
            }else if($request->area_tecnologia == 'Desarrollo de Software'){
                $scoreI = 0.75;
            }else{
                $scoreI = 0;
            }
        }else{
            $scoreI = 0;
        }


        if($request->ingreso_familiar == 'Menos de $5,000'){
            $scoreIF = -99999;
        }else if($request->ingreso_familiar == 'De $5,001 a $7,000'){
            $scoreIF = 1;
        }else if($request->ingreso_familiar == 'De $7,001 a $10,000'){
            $scoreIF = 4;
        }else if($request->ingreso_familiar == 'De $10,001 a $15,000'){
            $scoreIF = 5;
        }else if($request->ingreso_familiar == 'Mas de $15,000'){
            $scoreIF = 10;
        }else{
            $scoreIF = 0;
        }

        if($request->pago == 'SI'){
            $scoreP = 5;
        }else if($request->pago == 'NO'){
            $scoreP = 0;
        }else{
            $scoreP = 0;
        }

        if($request->destino_credito == 'INVERSION'){
            $scoreD = 0.75;
        }else if($request->destino_credito == 'EDUCACION'){
            if($request->uso_educacion == 'Educacion Basica'){
                $scoreD = 0.50;
            }else if($request->uso_educacion == 'Estudios Universitarios' || $request->uso_educacion == 'Cursos Complementarios'){
                $scoreD = 0.25;
            }else{
                $scoreD = 0;
            }
        }else if($request->destino_credito == 'HOGAR'){
            if($request->uso_hogar == 'Alimentos' || $request->uso_hogar == 'Construccion'){
                $scoreD = 0.13;
            }else if($request->uso_hogar == 'Servicios' || $request->uso_hogar == 'Electrodomesticos'){
                $scoreD = 0.15;
            }else if($request->uso_hogar == 'Renta'){
                $scoreD = 0.18;
            }else if($request->uso_hogar == 'Decoracion'){
                $scoreD = 0.05;
            }else{
                $scoreD = 0;
            }
        }else if($request->destino_credito == 'GASTOS PERSONALES'){
            if($request->uso_gastos == 'Regalos' || $request->uso_gastos == 'Viajes'){
                $scoreD = 0.13;
            }else if($request->uso_gastos == 'Transporte'){
                $scoreD = 0.18;
            }else if($request->uso_gastos == 'Celebraciones'){
                $scoreD = 0.05;
            }else{
                $scoreD = 0;
            }
        }else if($request->destino_credito == 'AUTOMOVIL'){
            if($request->uso_automovil == 'Refaccion o Reparacion'){
                $scoreD = 0.11;
            }else if($request->uso_automovil == 'Tramite'){
                $scoreD = 0.15;
            }else if($request->uso_automovil == 'Servicios'){
                $scoreD = 0.23;
            }else if($request->uso_automovil == 'Seguro'){
                $scoreD = 0.34;
            }else{
                $scoreD = 0;
            }
        }else if($request->destino_credito == 'DEUDAS'){
            if($request->uso_deudas == 'Atrasadas'){
                $scoreD = 0.13;
            }else if($request->uso_deudas == 'Proximas a Vencer'){
                $scoreD = 0.05;
            }else{
                $scoreD = 0;
            }
        }else if($request->destino_credito == 'SALUD'){
            if($request->uso_salud == 'Consulta Medica'){
                $scoreD = 0.5;
            }else if($request->uso_salud == 'Servicios Hospitalarios'){
                $scoreD = 0.10;
            }else if($request->uso_salud == 'Servicio Medico'){
                $scoreD = 0.15;
            }else if($request->uso_salud == 'Medicamentos'){
                $scoreD = 0.25;
            }else{
                $scoreD = 0;
            }
        }else{
            $scoreD = 0;
        }


        if($request->tarjeta_c == 'SI'){
            $scoreT = 3;
        }else if($request->tarjeta_c == 'NO'){
            $scoreT = 2;
        }else{
            $scoreT = 0;
        }

        if($request->credito_auto == 'SI'){
            $scoreA = 6;
        }else if($request->credito_auto == 'NO'){
            $scoreA = 4;
        }else{
            $scoreA = 0;
        }

        if($request->credito_casa == 'SI'){
            $scoreC = 6;
        }else if($request->credito_casa == 'NO'){
            $scoreC = 4;
        }else{
            $scoreC = 0;
        }

        if($request->historial == 'Malo'){
            $scoreH = 0;
        }else if($request->historial == 'No tengo historial'){
            $scoreH = 0.50;
        }else if($request->historial == 'No se'){
            $scoreH = 0.75;
        }else if($request->historial == 'Regular'){
            $scoreH = 1.25;
        }else if($request->historial == 'Bueno'){
            $scoreH = 2.50;
        }else{
            $scoreH = 0;
        }

        $scoreTotal = ($scoreG + $scoreE + $scoreEst + $scoreS + $scoreO + $scoreI + $scoreIF + $scoreP + $scoreD + $scoreT + $scoreA + $scoreC + $scoreH);

       

        $data = compact('scoreTotal');
        return $data;

    }
    

    public function enviarCorreo($idcliente){

        $prospecto = Cliente::where('id', $idcliente)->first();

        // $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail = new PHPMailer\PHPMailer(); // create a n
        $mail->CharSet = 'UTF-8';
        $body = 'MIME-Version: 1.0' . "\r\n";
        $body .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $link = "href='{{route('subirExpedientes',['id'=>$prospecto->id])}}'";
        extract($_POST);
        $mail->isHTML(true);

        $estilo = 'width:39.5pt;border-top:solid windowtext 2.25pt;border-left:solid windowtext 2.25pt;border-bottom:solid windowtext 1.0pt;border-right:none;background:#f57c9a;padding:0cm 5.4pt 0cm 5.4pt;height:3.15pt;color:#fff; text-align:center';
        $celdaTit = 'border:solid windowtext 0.8pt;border-top:solid windowtext 2.25pt;background:#f57c9a;padding:0cm 5.4pt 0cm 5.4pt;height:3.15pt';
        $cuepo = 'border-top:none;border-left:none;border-bottom:solid #7f7f7f 1.0pt;border-right:solid windowtext 1.0pt;background:#f2f2f2;padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt;font-size:14.0px;font-family:Century Gothic,sans-serif;color:black';
        try {	
            if($prospecto->state_encuesta == 'Rechazado'){
                $body = "<html><body>Hola <b>$prospecto->nombre<b>";
                $body .= "<p>¡Felicidades! De acuerdo a tus respuestas y a los criterios de las diferentes instituciones, el otorgamiento de tu crédito es altamente viable.</p>";
                $body .= "<br><strong>El siguiente paso es la integración de tu expediente en nuestra plataforma totalmente segura.<br>Puedes empezar a cargar  tu información aquí: </strong><br><p></p>";
                // $body .= "<button class='btn btn-block btn-info btn-sm'><a href='http://cfowolf.test/subir-expediente'>Clic para continuar</a></button><br><br></body></html>";
                $body .= "<button class='btn btn-block btn-info btn-sm'><a href='http://cfowolf.test/subir-expediente/$prospecto->id'>Clic para continuar</a></button><br><br></body></html>";
            }else{
                $body = "<html><body>Hola <b>$prospecto->nombre<b>";
                $body .= "<p>De acuerdo a tus respuestas y considerando los criterios de los bancos, por el momento no es posible autorizarte un crédito.</p>";
                $body .= "<p>Estaremos revisando tu perfil crediticio continuamente y en cuanto podamos otargarte un crédito te lo notificaremos a este correo.</p>";
            }
            
            $body .= "<br><strong style='font-size:12.0pt;font-family:Gisha;'>CUMPLO Y AVANZO, S.A.P.I. DE C.V., SOFOM E.N.R</strong>";
            $body .= '<br><strong style="font-size:12.0pt;font-family:Gisha;">Calle Flamingos No. 2-A. Col. La Cañada</strong>
                <br><strong style="font-size:12.0pt;font-family:Gisha;">San Cristóbal de las Casas, Chiapas.</strong> <br>
            <strong><span style="font-size:12.0pt;color:#6d9f32"><img  src="https://www.cumployavanzo.com/img10.jpg" width="250" /><br> No imprima este Correo de No ser Necesario "Cuidemos el Planeta"</span></strong><br>';
            //$body = eregi_replace("[\]",'',$body);
            $mail->IsSMTP(); // telling the class to use SMTP
            //$mail->Host       = "mx1.hostinger.mx"; // SMTP server
            //$mail->SMTPDebug  = 1;        // enables SMTP debug information (for testing), 1 = errors and messages, 2 = messages only
            
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.cumployavanzo.com.mx";
            $mail->Port = 465;
            $mail->Username = "anahi.tovilla@cumployavanzo.com.mx";
            $mail->Password = "3#D+nOo,PA&VU-KZ)Y";
            $mail->SetFrom('anahi.tovilla@cumployavanzo.com.mx','CUMPLO Y AVANZO');
            // $mail->addBCC('jorge.gomez@cumployavanzo.com.mx');
            // $mail->addBCC('edwin.antonio@cumployavanzo.com.mx');
            // $mail->addBCC('anahi.tovilla@cumployavanzo.com.mx');
            if($prospecto->state_encuesta == 'Aceptado'){
                $mail->Subject    = "Integremos tu expediente";
            }else{
                $mail->Subject    = "Mensaje de Valoración";
            }
            $mail->AltBody    = "CUMPLO Y AVANZO | PAGINA WEB";
            $mail->MsgHTML($body);
            $mail->AddAddress(trim('tov.anahi@gmail.com'));
            

            $mail->MsgHTML($body);
            if(!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
                
                return "Correo enviado";	
            }
        
            } catch (Exception $e) {
                echo "Error No: ".$e->getCode()." - ". $e->getMessage() . "<br>";
                // echo nl2br($e->getTraceAsString());
            }
        }
    }


   