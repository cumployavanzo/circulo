<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::paginate(10);
        return view('admin.areas.index', compact('areas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.areas.addAreas');
    }

    public function store(Request $request)
    {
        $area = new Area();
        $area->nombre = mb_strtoupper($request->input('txt_nombre_area'), 'UTF-8');
        $area->tel = $request->input('txt_telefono');
        $area->extension = $request->input('txt_extension');
        $area->save();
        // return redirect('admin/areas/addareas')->with('success', 'Se ha agregado el área exitosamente');
        return redirect()->route('admin.area.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $area = Area::where('id', $id)->first();
        return view('admin.areas.editAreas', compact('area'));
    }

    public function update(Request $request, $id)
    {
        Area::where('id', $id)->update([
            'nombre' => $request->txt_nombre_area,
            'tel' => $request->txt_telefono,
            'extension' => $request->txt_extension
        ]);
        // return back()->with('mensaje', 'Se ha editado el área exitosamente');
        return redirect()->route('admin.area.edit',[$id])->with('mensaje', 'Se ha editado el área exitosamente');

    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();
        return redirect()->route('admin.area.index');
        // return back()->with('success','Se ha borrado el área exitosamente');
    }
}
