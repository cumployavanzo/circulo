<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use App\Personal;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        // $users = User::all();
        return view('admin.usuarios.index', compact('users'));
    }

    public function create()
    {
        $personales = Personal::all();
        $roles = Rol::all();
        return view('admin.usuarios.addUsuarios', compact('personales','roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $usuario = new User();
        $usuario->personals_id = $request->input('txt_personal');
        $usuario->roles_id = $request->input('txt_rol');
        $usuario->email = $request->input('txt_email');
        $usuario->password = bcrypt($request->input('txt_pass'));
        $usuario->confirmed = TRUE;
        $usuario->save();
        return redirect()->route('admin.usuario.index');
        // return redirect('admin/usuarios/addusuarios')->with('success', 'Se ha agregado el Usuario exitosamente');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $personales = Personal::all();
        $roles = Rol::all();
        $opcionPerson = "N/A";
        if($user->personal()->first('id') != null){
            $opcionPerson = $user->personal()->first('id')->id;
        }
        $opcionRol = "N/A";
        if($user->rol()->first('id') != null){
            $opcionRol = $user->rol()->first('id')->id;
        }
        return view('admin.usuarios.edit', compact('user','personales','opcionPerson','roles','opcionRol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //  dd($request);
        if($request->input('txt_pass') != null){
            User::where('id', $id)->update([
                'password' => bcrypt($request->input('txt_pass'))
            ]);
        }
        User::where('id', $id)->update([
            'personals_id' => $request->txt_personal,
            'roles_id' => $request->txt_rol,
            'email' => $request->txt_email
        ]);
        // return back()->with('mensaje', 'Se ha editado el Usuario exitosamente');
        return redirect()->route('admin.usuario.edit',[$id])->with('mensaje', 'Se ha editado el Usuario exitosamente');
    }

    public function actualizarEstadoUser($id){
        $state = User::where('id', $id)->pluck('state');
        if ($state[0] == 1) {
            User::where('id', $id)->update([
                'state' => '0',
            ]);
        } else{
            User::where('id', $id)->update([
                'state' => '1'
            ]);
        }
        
        // return response()->json(["data" => "ok"]);
    }

    public function destroy($id)
    {
        //
    }
}
