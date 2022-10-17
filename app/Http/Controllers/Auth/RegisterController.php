<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Personal;
use App\Mail\MessageReceived;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Str;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index()
    {
        // $areas = Area::paginate(10);
        return view('auth.registro');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
  
    public function store(Request $data)
    {
        $personal = Personal::where('clave_elector', $data->input('txt_clave'))->where('state','Activo')->first();///valida que exista como empleado y este activo
        if($personal){
            $usuario = User::where('personals_id', $personal->id)->where('state','1')->first(); /// verifica si ya tiene un usuario
            $correo = User::where('email', $data->input('txt_email'))->where('state','1')->first(); /// verifica que el correo no este registrado
            if($usuario || $correo){
                return redirect()->route('registro.index')->with('error', 'Ya cuenta con un usuario.');    
            }else{
                $confirmation_code =  Str::random(10);
                $user =  User::create([
                    'personals_id' => $personal->id,
                    'email' => $data->input('txt_email'),
                    'email_verified_at' => $data->input('txt_emailC'),
                    'roles_id' => '2',
                    'confirmation_code' => $confirmation_code,
                    'password' => bcrypt($data->input('txt_pass'))
                ]);
    
                Mail::to($user->email)->send(new MessageReceived($user));
                return redirect()->route('registro.index')->with('titulo', '¡Gracias por Registrarse!')->with('mensaje', 'Comprobar en la carpeta de "Spam" del correo proporcionado.');
            } 
        }else{
            return redirect()->route('registro.index')->with('error', 'El registro no es posible.');    
        }
       
    }


    public function verify($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        // if(! $user){
        //     return redirect('/')
        // }

        $user->confirmed = true;
        // $user->confirmation_code = null;
        $user->save();
        return redirect()->route('login')->with('notification', '¡Has confirmado correctamente tu correo!');
    }
}
