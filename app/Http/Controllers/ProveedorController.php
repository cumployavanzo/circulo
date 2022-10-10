<?php

namespace App\Http\Controllers;
use App\Proveedor;
use App\Cuenta;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $name_proveedor =  mb_strtoupper($request->get('txt_name_proveedor'), 'UTF-8');
        $proveedores = Proveedor::nameProveedor($name_proveedor)->orderBy('nombre_proveedor', 'ASC')->paginate(10);
        return view('admin.Proveedores.index', compact('proveedores','name_proveedor'));
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        return view('admin.Proveedores.addProveedores', compact('cuentas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $proveedores = new Proveedor();
        $proveedores->nombre_proveedor = mb_strtoupper($request->input('txt_nombre_proveedor'), 'UTF-8');
        $proveedores->clave_proveedor = mb_strtoupper($request->input('txt_clave'), 'UTF-8');
        $proveedores->rfc = mb_strtoupper($request->input('txt_rfc'), 'UTF-8');
        $proveedores->curp = mb_strtoupper($request->input('txt_curp'), 'UTF-8');
        $proveedores->tipo_proveedor = mb_strtoupper($request->input('txt_tipo'), 'UTF-8');
        $proveedores->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $proveedores->cp = $request->input('txt_codigo_postal');
        $proveedores->colonia = mb_strtoupper($request->input('txt_colonia'), 'UTF-8');
        $proveedores->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $proveedores->estado = mb_strtoupper($request->input('txt_estado'), 'UTF-8');
        $proveedores->telefono = $request->input('txt_celular');
        $proveedores->correo_electronico = mb_strtoupper($request->input('txt_correo_electronico'), 'UTF-8');
        $proveedores->cuentas_id = $request->input('txt_cuenta');
        $proveedores->numero_cuenta = $request->input('txt_num_cuenta');
        $proveedores->clave_interbancaria = $request->input('txt_clave_interbancaria');
        $proveedores->save();
        return redirect()->route('admin.proveedor.index');
        // return redirect('admin/proveedores/addproveedores')->with('success', 'Se ha agregado la cuenta exitosamente');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $proveedor = Proveedor::where('id', $id)->first();
        $cuentas = Cuenta::all(); 
        $cuentaOpcion = "N/A";
        if($proveedor->cuentas()->first('id') != null){
            $cuentaOpcion = $proveedor->cuentas()->first('id')->id;
        }
        return view('admin.Proveedores.editProveedores', compact('proveedor', 'cuentas','cuentaOpcion'));
    }

    
    public function update(Request $request, $id)
    {
        // dd($request);
        Proveedor::where('id', $id)->update([
            'nombre_proveedor' =>  mb_strtoupper($request->txt_nombre_proveedor, 'UTF-8'),
            'clave_proveedor' =>  mb_strtoupper($request->txt_clave, 'UTF-8'),
            'rfc' =>  mb_strtoupper($request->txt_rfc, 'UTF-8'),
            'curp' =>  mb_strtoupper($request->txt_curp, 'UTF-8'),
            'tipo_proveedor' =>  mb_strtoupper($request->txt_tipo, 'UTF-8'),
            'direccion' =>  mb_strtoupper($request->txt_direccion, 'UTF-8'),
            'cp' =>  mb_strtoupper($request->txt_codigo_postal, 'UTF-8'),
            'colonia' =>  mb_strtoupper($request->txt_colonia, 'UTF-8'),
            'ciudad' =>  mb_strtoupper($request->txt_ciudad, 'UTF-8'),
            'estado' =>  mb_strtoupper($request->txt_estado, 'UTF-8'),
            'telefono' => $request->txt_celular,
            'correo_electronico' => $request->txt_correo_electronico,
            'cuentas_id' => $request->txt_cuenta,
            'numero_cuenta' => $request->txt_num_cuenta,
            'clave_interbancaria' => $request->txt_clave_interbancaria
        ]);
        return redirect()->route('admin.proveedor.edit',[$id])->with('mensaje', 'Se ha editado el Proveedor exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Proveedor exitosamente');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return redirect()->route('admin.proveedor.index');
        // return back()->with('success','Se ha borrado el asociado exitosamente');
    }
}
