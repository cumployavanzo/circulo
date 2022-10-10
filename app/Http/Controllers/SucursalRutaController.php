<?php

namespace App\Http\Controllers;
use App\SucursalRuta;

use Illuminate\Http\Request;

class SucursalRutaController extends Controller
{
    //
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $sucursales = SucursalRuta::name($name)->paginate(10);
        return view('admin.sucursal_ruta.index', compact('sucursales','name'));
    }

    public function create()
    {
        
        return view('admin.sucursal_ruta.addSucursal');
    }

    public function store(Request $request)
    {
        //  dd($request);
        $sucursal = new SucursalRuta();
        $sucursal->nombre_ruta = mb_strtoupper($request->input('txt_nombre_ruta'), 'UTF-8');
        $sucursal->numero_ruta = $request->input('txt_num_ruta');
        $sucursal->telefono = $request->input('txt_telefono');
        $sucursal->ciudad = mb_strtoupper($request->input('txt_ciudad'), 'UTF-8');
        $sucursal->direccion = mb_strtoupper($request->input('txt_direccion'), 'UTF-8');
        $sucursal->save();
        return redirect()->route('admin.sucursal_ruta.index');
    }

    public function edit($id)
    {
        $sucursal = SucursalRuta::where('id', $id)->first();
        return view('admin.sucursal_ruta.editSucursal', compact('sucursal'));
    }

    public function update(Request $request, $id)
    {
        SucursalRuta::where('id', $id)->update([
            'nombre_ruta' => mb_strtoupper($request->txt_nombre_ruta, 'UTF-8'),
            'numero_ruta' => $request->txt_num_ruta,
            'telefono' => $request->txt_telefono,
            'ciudad' => mb_strtoupper($request->txt_ciudad,'UTF-8'),
            'direccion' => mb_strtoupper($request->txt_direccion,'UTF-8')
        ]);
        return redirect()->route('admin.sucursal_ruta.edit',[$id])->with('mensaje', 'Se ha editado la Sucursal exitosamente');
    }

    public function actualizarEstadoSuc($id){
        $state = SucursalRuta::where('id', $id)->pluck('state');
        if($state[0] == 'Activo') {
            SucursalRuta::where('id', $id)->update([
                'state' => 'Inactivo'
            ]);
        }else{
            SucursalRuta::where('id', $id)->update([
                'state' => 'Activo'
            ]);
        }
        return response()->json(["data" => "ok"]);
    }
}
