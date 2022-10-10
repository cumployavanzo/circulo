<?php

namespace App\Http\Controllers;
use App\Empresa;
use App\Personal;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    //
    public function index()
    {
        $empresas = Empresa::paginate(10);
        return view('admin.empresas.index', compact('empresas'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        $empleados = Personal::all();
        return view('admin.empresas.addEmpresas', compact('empresas','empleados'));
    }

    public function store(Request $request)
    {
        $empresa = new Empresa();
        if ($files = $request->file('file_pdf')) {
            $destinationPath = 'files/pdfEmpresa/'; // upload path
            $profilefile = date('YmdHi') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profilefile);
            $insert['file_name'] = "$profilefile";
            $empresa->file_name = $insert['file_name'];
         }
        $empresa->fecha_inic_operaciones = $request->input('fecha_inicio');
        $empresa->clave = mb_strtoupper($request->input('txt_clave'), 'UTF-8');
        $empresa->razon_social = mb_strtoupper($request->input('txt_razon_social'), 'UTF-8');
        $empresa->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $empresa->regimen_capital = mb_strtoupper($request->input('txt_regimen'), 'UTF-8');
        $empresa->registro_patronal = mb_strtoupper($request->input('txt_registro_patronal'), 'UTF-8');
        $empresa->nombre_empresa = mb_strtoupper($request->input('txt_nombre'), 'UTF-8');
        $empresa->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $empresa->referencia = mb_strtoupper($request->input('txt_referencia'), 'UTF-8');
        $empresa->cp = $request->input('txt_codigo_postal');
        $empresa->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $empresa->municipio = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $empresa->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $empresa->telefono = $request->input('txt_tel');
        $empresa->email = mb_strtoupper($request->input('txt_email'), 'UTF-8');
        $empresa->personals_id = $request->input('txt_representante');

        $empresa->save();
        return redirect()->route('admin.empresa.index');

    }

    public function edit($id)
    {
        $empresa = Empresa::where('id', $id)->first();
        $empleados = Personal::all(); 
        $opcionEmpleado = "N/A";
        if($empresa->empleados()->first('id') != null){
            $opcionEmpleado = $empresa->empleados()->first('id')->id;
        }
        return view('admin.empresas.editEmpresas', compact('empresa','empleados','opcionEmpleado'));
    }

    public function update(Request $request, $id)
    {
        Empresa::where('id', $id)->update([
            'fecha_inic_operaciones' => $request->fecha_inicio,
            'clave' => mb_strtoupper($request->txt_clave, 'UTF-8'),
            'razon_social' => mb_strtoupper($request->txt_razon_social, 'UTF-8'),
            'rfc' => mb_strtoupper($request->txt_rfc, 'UTF-8'),
            'regimen_capital' => mb_strtoupper($request->txt_regimen, 'UTF-8'),
            'registro_patronal' => mb_strtoupper($request->txt_registro_patronal, 'UTF-8'),
            'nombre_empresa' => mb_strtoupper($request->txt_nombre, 'UTF-8'),
            'direccion' => mb_strtoupper($request->txt_direccion, 'UTF-8'),
            'referencia' => mb_strtoupper($request->txt_referencia, 'UTF-8'),
            'cp' => $request->txt_codigo_postal,
            'colonia' => mb_strtoupper($request->txt_colonia, 'UTF-8'),
            'municipio' => mb_strtoupper($request->txt_ciudad, 'UTF-8'),
            'estado' => mb_strtoupper($request->txt_estado, 'UTF-8'),
            'telefono' => $request->txt_tel,
            'email' => mb_strtoupper($request->txt_email, 'UTF-8'),
            'personals_id' => $request->txt_representante
        ]);
        return redirect()->route('admin.empresa.edit',[$id])->with('mensaje', 'Se ha editado la Empresa exitosamente');
    }
}
