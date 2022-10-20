<?php

namespace App\Http\Controllers;
use App\Rol;
use App\Menu;
use App\Permiso;
use App\Submenu;

use Illuminate\Http\Request;

class RolController extends Controller
{
    //
    
    public function index()
    {
        $roles = Rol::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $menus = Menu::where('estado','1')->get();
        return view('admin.roles.addRoles', compact('menus'));
    }

    public function store(Request $request)
    {
        $rol = new Rol();
        $rol->nombre = mb_strtoupper($request->input('rol'), 'UTF-8');
        $rol->save();
        $rolID= $rol["id"];
        $number = count($request->submenu);
        if($number >= 1){
            for($i=0; $i<$number; $i++){
                $permiso = new Permiso();
                if($request["submenu"][$i]!= ''){ 
                    $permiso->roles_id = $rolID;
                    $permiso->sub_menus_id = $request["submenu"][$i];
                    $permiso->save();
                }
            }
        } 
        return redirect()->route('admin.rol.index');
    }

    
    public function edit($id)
    {
        $rol = Rol::where('id', $id)->first();
        $menus = Menu::where('estado','1')->get();
        $permisos = Permiso::Where('roles_id',$id)->pluck('sub_menus_id')->toArray();
        $submenus = Submenu::Where('estado_menu',1)->pluck('id')->toArray();
        // dd($permisos);

        return view('admin.roles.editRoles', compact('rol','menus','permisos','submenus'));
    }

    public function update(Request $request, $id)
    {
        Rol::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->rol, 'UTF-8')
        ]);

        $permisos = Permiso::where('roles_id',$id)->get();
        $permisos->each->delete();

        if(empty($request->submenu)){
            return redirect()->route('admin.rol.edit',[$id])->with('error', 'Debes elegir al menos una opción.');
        }
        $number = count($request->submenu);
        if($number >= 1){
            for($i=0; $i<$number; $i++){
                $permiso = new Permiso();
                if($request["submenu"][$i]!= ''){ 
                    $permiso->roles_id = $id;
                    $permiso->sub_menus_id = $request["submenu"][$i];
                    $permiso->save();
                }
            }
        } 
        return redirect()->route('admin.rol.edit',[$id])->with('mensaje', 'Se ha editado el Rol exitosamente');
    }

}
