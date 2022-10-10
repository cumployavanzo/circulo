<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Area;

use Illuminate\Http\Request;

class PuestoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puestos = Puesto::paginate(10);
        // $puestos = Puesto::all();
        return view('admin.puestos.index', compact('puestos'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('admin.puestos.addPuestos', compact('areas'));
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'txt_nombre_puesto' => ['required', 'unique:positions,name'],
        //     'txt_area' => ['required']
        // ]);
        // if($validator->fails()){
        //     $messages = $validator->messages();
        //     return Redirect::back()->withErrors($messages);
        // }
        $puesto = new Puesto();
        $puesto->puesto = mb_strtoupper($request->input('txt_nombre_puesto'), 'UTF-8');
        $puesto->areas_id = $request->input('txt_area');
        $puesto->sueldo_inicial = (str_replace(",","",$request->input('txt_sueldo_inicial')));
        $puesto->sueldo_final = (str_replace(",","",$request->input('txt_sueldo_final')));
        $puesto->comisiones = (str_replace(",","",$request->input('txt_comisiones')));
        $puesto->save();
        return redirect()->route('admin.puesto.index');
        // return redirect('admin/puestos/addpuestos')->with('success', 'Se ha agregado el puesto exitosamente');
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $puesto = Puesto::where('id', $id)->first();
        $areas = Area::all(); 
        $opcionArea = "N/A";
        if($puesto->areas()->first('id') != null){
            $opcionArea = $puesto->areas()->first('id')->id;
        }
        return view('admin.puestos.edit', compact('puesto','areas','opcionArea'));
    }

    public function update(Request $request, $id)
    {
        Puesto::where('id', $id)->update([
            'puesto' => mb_strtoupper($request->txt_nombre_puesto, 'UTF-8'),
            'areas_id' => $request->txt_area,
            'sueldo_inicial' => (str_replace(",","",$request->txt_sueldo_inicial)),
            'sueldo_final' => (str_replace(",","",$request->txt_sueldo_final)),
            'comisiones' => (str_replace(",","",$request->txt_comisiones))
        ]);
        return redirect()->route('admin.puesto.edit',[$id])->with('mensaje', 'Se ha editado el puesto exitosamente');
        // return back()->with('mensaje', 'Se ha editado el puesto exitosamente');
    }

    public function destroy($id)
    {
        $puesto = Puesto::find($id);
        $puesto->delete();
        return redirect()->route('admin.puesto.index');
        // return back()->with('success','Se ha borrado el puesto exitosamente');
    }
}
