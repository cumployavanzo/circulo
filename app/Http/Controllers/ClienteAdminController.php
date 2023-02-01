<?php

namespace App\Http\Controllers;

use App\Asociado;
use App\Cliente;
use App\Expediente;
use App\EstadoNacimiento;


use App\CirculoCredito\Simulacion\Api\FSApi as Instance;
use App\CirculoCredito\Simulacion\Configuration;

use \GuzzleHttp\Client;

use App\CirculoCredito\Simulacion\Model\Peticion;
use App\CirculoCredito\Simulacion\Model\Persona;
use App\CirculoCredito\Simulacion\Model\Domicilio;


use Illuminate\Http\Request;

use App\Http\Controllers\ClienteController;

class ClienteAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ClienteController = new ClienteController();
        // $clientes = $ClienteController->name($name)->getClientesPaginate();
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $asociados = Asociado::all(); 

        if($request->estatus){
            $clientes = Cliente::where('estatus', $request->estatus)->name($name)->paginate(10);
        }else{
            $clientes = Cliente::name($name)->paginate(10);
        }
        $estatusInactivo = Cliente::where('estatus', 'Inactivo')->get();
        $estatusActivo = Cliente::where('estatus', 'Activo')->get();

        return view('admin.clientes.index', compact('clientes','asociados','name','estatusInactivo','estatusActivo'));
    }

    public function create()
    {
        
        $estados_nac = EstadoNacimiento::all();
        return view('admin.clientes.addClientes', compact('estados_nac'));
    }

    public function store(Request $request)
    {
        //  dd($request);
        $cliente = new Cliente();
        if($request->txt_nombre_prospecto){
            Prospecto::where('id', $request->txt_nombre_prospecto)->update([
                'estatus' => 'Cliente',
            ]);
        }
        $cliente->user_id = auth()->user()->id;
        $cliente->nombre = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $cliente->apellido_paterno = mb_strtoupper($request->input('txt_apellido_paterno'), 'UTF-8');
        $cliente->apellido_materno = mb_strtoupper($request->input('txt_apellido_materno'), 'UTF-8');
        $cliente->fecha_nacimiento = $request->input('txt_fecha_nac');
        $cliente->edad = $request->input('txt_edad');
        $cliente->genero = $request->input('txt_genero');
        $cliente->ciudad_nacimiento = mb_strtoupper($request->input('txt_ciudad_nacimiento'), 'UTF-8');
        $cliente->nacionalidad = mb_strtoupper($request->input('txt_nacionalidad'), 'UTF-8');
        $cliente->estados_nacimientos_clave = mb_strtoupper($request->input('txt_estado_nacimiento'), 'UTF-8');
        $cliente->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $cliente->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $cliente->celular = $request->input('txt_celular');
        $cliente->tipo_vivienda = mb_strtoupper($request->input('txt_tipo_vivienda'), 'UTF-8');
        $cliente->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $cliente->anios_residencia = mb_strtoupper($request->input('txt_residencia'), 'UTF-8');
        $cliente->cp = $request->input('txt_codigo_postal');
        $cliente->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $cliente->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $cliente->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $cliente->fecha_alta = $request->input('txt_fecha_alta');
        $cliente->escolaridad = mb_strtoupper($request->input('txt_escolaridad'), 'UTF-8');
        $cliente->profesion = mb_strtoupper($request->input('txt_profesion'), 'UTF-8');
        $cliente->religion = mb_strtoupper($request->input('txt_religion'), 'UTF-8');
        $cliente->estado_civil = mb_strtoupper($request->input('txt_estado_civil'), 'UTF-8');
        $cliente->clave_elector = mb_strtoupper($request->input('txt_clave_elector'), 'UTF-8');
        $cliente->anio_vencimiento_ine = $request->input('txt_vencimiento_ine');
        $cliente->folio_ine = mb_strtoupper($request->input('txt_folio_ine'), 'UTF-8');
        $cliente->ocr = mb_strtoupper($request->input('txt_ocr'), 'UTF-8');
        $cliente->numero_tarjeta = $request->input('txt_num_tarjeta');
        $cliente->clave_interbancaria = $request->input('txt_clave_interbancaria');
        $cliente->banco = mb_strtoupper($request->input('txt_banco'), 'UTF-8');
        $cliente->tipo_cliente = mb_strtoupper($request->input('txt_tipo_cliente'), 'UTF-8');
        $cliente->asociado_id = $request->input('txt_nombre_asociado');
        $cliente->tipo_vialidad = $request->input('txt_vialidad');
        $cliente->entre_calles = mb_strtoupper($request->input('txt_entre_calles'), 'UTF-8');
        $cliente->save();
        $idCliente= $cliente["id"];
        return redirect()->route('admin.cliente.edit',[$idCliente])->with('mensaje', 'Registro exitoso');



    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        $expediente = Expediente::where('clientes_id', $id)->first();

        return view('admin.clientes.edit', compact('cliente', 'expediente'));
    }

    public function update(Request $request, $id)
    {
        Cliente::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre , 'UTF-8'),
            'apellido_paterno' => mb_strtoupper($request->txt_apellido_paterno, 'UTF-8'),
            'apellido_materno' => mb_strtoupper($request->txt_apellido_materno , 'UTF-8'),
            'fecha_nacimiento' => $request->txt_fecha_nac,
            'edad' => $request->txt_edad,
            'genero' => $request->txt_genero,
            'ciudad_nacimiento' => mb_strtoupper($request->txt_ciudad_nacimiento,'UTF-8'),
            'nacionalidad' => mb_strtoupper($request->txt_nacionalidad, 'UTF-8'),
            'estados_nacimientos_clave' => mb_strtoupper($request->txt_estado_nacimiento,'UTF-8'),
            'rfc' => mb_strtoupper($request->txt_rfc,'UTF-8'),
            'curp' => mb_strtoupper($request->txt_curp,'UTF-8'),
            'celular' => $request->txt_celular,
            'tipo_vivienda' => mb_strtoupper($request->txt_tipo_vivienda,'UTF-8'),
            'direccion' => mb_strtoupper($request->txt_direccion,'UTF-8'),
            'anios_residencia' => mb_strtoupper($request->txt_residencia,'UTF-8'),
            'cp' => mb_strtoupper($request->txt_codigo_postal,'UTF-8'),
            'colonia' => mb_strtoupper($request->txt_colonia,'UTF-8'),
            'ciudad' => mb_strtoupper($request->txt_ciudad,'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado,'UTF-8'),
            'fecha_alta' => $request->txt_fecha_alta,
            'escolaridad' => mb_strtoupper($request->txt_escolaridad,'UTF-8'),
            'profesion' => mb_strtoupper($request->txt_profesion,'UTF-8'),
            'religion' => mb_strtoupper($request->txt_religion,'UTF-8'),
            'estado_civil' => mb_strtoupper($request->txt_estado_civil,'UTF-8'),
            'clave_elector' => mb_strtoupper($request->txt_clave_elector,'UTF-8'),
            'anio_vencimiento_ine' => mb_strtoupper($request->txt_vencimiento_ine,'UTF-8'),
            'folio_ine' => mb_strtoupper($request->txt_folio_ine,'UTF-8'),
            'ocr' => mb_strtoupper($request->txt_ocr,'UTF-8'),
            'numero_tarjeta' => $request->txt_num_tarjeta,
            'clave_interbancaria' => $request->txt_clave_interbancaria,
            'banco' => mb_strtoupper($request->txt_banco,'UTF-8'),
            'tipo_cliente' => mb_strtoupper($request->txt_tipo_cliente,'UTF-8'),
            'asociado_id' => $request->txt_nombre_asociado,
            'tipo_vialidad' => $request->txt_vialidad,
            'entre_calles' => mb_strtoupper($request->txt_entre_calles,'UTF-8')
        ]);
        return redirect()->route('admin.cliente.edit',[$id])->with('mensaje', 'Se ha editado el Cliente exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('admin.cliente.index');
        // return back()->with('success','Se ha borrado el asociado exitosamente');
    }

    public function existeCliente($claveElector){
        $clientExiste = Cliente::where('clave_elector','LIKE',"%$claveElector%")->count();
        //dd($cliente);
        return response()->json(["clientExiste" => $clientExiste]);
    }

    public function verProspecto($id){
        $prospectos = Prospecto::where('id', $id)->first();
        return response()->json(["prospectos" => $prospectos]);
    }

    public function actualizarEstadoCliente($id){
        $state = Cliente::where('id', $id)->pluck('estatus');
        if($state[0] == 'Activo') {
            Cliente::where('id', $id)->update([
                'estatus' => 'Inactivo'
            ]);
        }else{
            Cliente::where('id', $id)->update([
                'estatus' => 'Activo'
            ]);
        }
        return response()->json(["data" => "ok"]);
    }

  


    public function import(Request $request)
    {
        $this->validate($request, [
            'documento'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('documento')->getRealPath();
        $array = Excel::toArray(new ClientesImport, $request->file('documento'));
        $n = 1;
        $error = '';

        foreach($array as $array1){
            foreach($array1 as $key => $array2){
                $n++;
                $sameCurp = Cliente::where('curp', '=' ,$array2['curp'])->get()->count();
                if($sameCurp > 0){
                    $error .= 'Error en la fila '. $n .' curp repetido'. "\n";
                }
               
                if($sameCurp > 0){
                    continue;
                }
               
                $cliente = new Cliente();
                $cliente->user_id = $array2['user_id'] ?? '';
                $cliente->asociado_id = $array2['asociado_id'] ?? '';
                $cliente->nombre = mb_strtoupper($array2['nombre'], 'UTF-8');
                $cliente->apellido_paterno = mb_strtoupper($array2['apellido_paterno'], 'UTF-8');
                $cliente->apellido_materno = mb_strtoupper($array2['apellido_materno'], 'UTF-8');
                $cliente->fecha_nacimiento = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($array2['fecha_nacimiento'])->format('d/m/Y');
                $cliente->fecha_alta = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($array2['fecha_alta'])->format('d/m/Y');
                $cliente->ciudad_nacimiento = mb_strtoupper($array2['ciudad_nacimiento'], 'UTF-8');
                $cliente->estado_nacimiento = mb_strtoupper($array2['estado_nacimiento'], 'UTF-8');
                $cliente->estados_nacimientos_clave = $array2['estados_nacimientos_clave'] ?? '7';
                $cliente->genero = mb_strtoupper($array2['genero'], 'UTF-8') ?? 'x';
                $cliente->rfc = mb_strtoupper($array2['rfc'], 'UTF-8');
                $cliente->curp = mb_strtoupper($array2['curp'], 'UTF-8');
                $cliente->edad = $array2['edad'];
                $cliente->tipo_vivienda = mb_strtoupper($array2['tipo_vivienda'], 'UTF-8');
                $cliente->direccion = mb_strtoupper($array2['direccion'], 'UTF-8');
                $cliente->anios_residencia = mb_strtoupper($array2['anios_residencia'], 'UTF-8');
                $cliente->cp = $array2['cp'];
                $cliente->colonia = mb_strtoupper($array2['colonia'], 'UTF-8');
                $cliente->ciudad = mb_strtoupper($array2['ciudad'], 'UTF-8');
                $cliente->estado = mb_strtoupper($array2['estado'], 'UTF-8');
                $cliente->celular = $array2['celular'];
                $cliente->escolaridad = mb_strtoupper($array2['escolaridad'], 'UTF-8');
                $cliente->profesion = mb_strtoupper($array2['profesion'], 'UTF-8');
                $cliente->religion = mb_strtoupper($array2['religion'], 'UTF-8');
                $cliente->estado_civil = mb_strtoupper($array2['estado_civil'], 'UTF-8');
                $cliente->clave_elector = mb_strtoupper($array2['clave_elector'], 'UTF-8');
                $cliente->anio_vencimiento_ine = mb_strtoupper($array2['anio_vencimiento_ine'], 'UTF-8');
                $cliente->folio_ine = mb_strtoupper($array2['folio_ine'], 'UTF-8');
                $cliente->ocr = mb_strtoupper($array2['ocr'], 'UTF-8');
                $cliente->numero_tarjeta = $array2['numero_tarjeta'];
                $cliente->clave_interbancaria = $array2['clave_interbancaria'];
                $cliente->banco = mb_strtoupper($array2['banco'], 'UTF-8');
                $cliente->tipo_cliente = $array2['tipo_cliente'] ?? 'Nuevo';
                $cliente->nacionalidad = mb_strtoupper($array2['nacionalidad'], 'UTF-8');
                $cliente->tipo_vialidad = $array2['tipo_vialidad'] ?? 'Calle';
                $cliente->entre_calles = mb_strtoupper($array2['entre_calles'], 'UTF-8');                
                $cliente->save();
            }
        }
        if($error != ''){
            return back()->with('mensaje', $error);
        }
        return back()->with('mensaje', 'Se realizo la carga exitosamente');
    }



    

    public function cdcTest(Request $request, $cliente_id)
    {
        $this->cdcSetUp();
        $request = $this->cdcPersona($cliente_id);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $request);

            dd(__FUNCTION__, $this->apiInstance, $request, $result);

            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetReporte: ', $e->getMessage(), PHP_EOL;
        }

        dd(__FUNCTION__, $this->apiInstance, $request);
    }

    public function cdcSetUp()
    {
        // Set Up
        $cdc_url = env('CDC_SANDBOX_URL').'/v1/fintechscore';
        $cdc_x_api_key = env('CDC_SANDBOX_API_KEY');



        $config = new \App\CirculoCredito\FintechScore\Simulacion\Configuration();
        $config->setHost($cdc_url);
        $client = new Client();
        $this->apiInstance = new \App\CirculoCredito\FintechScore\Simulacion\Api\FintechScoreSimulacionApi($client, $config);
        $this->x_api_key = $cdc_x_api_key;

    }

    public function cdcPersona($cliente_id = false)
    {
        $peticion = new \App\CirculoCredito\FintechScore\Simulacion\Model\Peticion();
        $persona = new \App\CirculoCredito\FintechScore\Simulacion\Model\Persona();
        $domicilio = new \App\CirculoCredito\FintechScore\Simulacion\Model\Domicilio();

        $cliente_id = 10;

        // $cliente = Cliente::where('id', $cliente_id)->get();

        $peticion->setFolioOtorgante("20210304");
        
        $persona->setApellidoPaterno("SESENTAYDOS");
        $persona->setApellidoMaterno("PRUEBA");
        $persona->setPrimerNombre("JUAN");
        $persona->setSegundoNombre("JUAN");
        $persona->setFechaNacimiento("1965-08-09");
        $persona->setRFC("SEPJ650809JG1");
        
        $domicilio->setDireccion("PASADISO ENCONTRADO 58");
        $domicilio->setColoniaPoblacion("MONTEVIDEO");
        $domicilio->setDelegacionMunicipio("GUSTAVO A MADERO");
        $domicilio->setCiudad("CIUDAD DE MÉXICO");
        $domicilio->setEstado("CDMX");
        $domicilio->setCP("07730");
        $domicilio->setPais("MX");

        $persona->setDomicilio($domicilio);

        return $peticion->setPersona($persona);


        // Status Code 200 Score 720
        /*
        $cliente_json = '{
            "folio": "123456",
            "persona":{
                "nombres": "JUAN",
                "apellidoPaterno": "SESENTAYDOS",
                "apellidoMaterno": "PRUEBA",
                "fechaNacimiento": "1965-08-09",
                "RFC": "SEPJ650809JG1",
                "domicilio": {
                    "direccion": "PASADISO ENCONTRADO 58",
                    "coloniaPoblacion": "MONTEVIDEO",
                    "delegacionMunicipio": "GUSTAVO A MADERO",
                    "ciudad": "CIUDAD DE MÉXICO",
                    "estado": "CDMX",
                    "CP": "07730"
                }
            }
        }';
        */
    }
}
