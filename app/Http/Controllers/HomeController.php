<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Personal;
use App\Aval;
use App\Producto;
use App\Solicitud;
use App\SucursalRuta;
use App\Analisis_credito;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $clientes = Cliente::count();
            $avales = Aval::count();
            $productos = Producto::count();
            $solicitudes = Solicitud::count();
            $rutas = SucursalRuta::count();
            $empleados = Personal::where('state','Activo')->count();
            $solAutorizadas = Solicitud::where('estatus','Autorizado')->count();
            $solDesembolsadas = Analisis_credito::where('desembolso','Desembolsado')->count();
            return view('index', compact('clientes','empleados','avales','productos','solicitudes','rutas','solAutorizadas','solDesembolsadas'));
            // return view('index');
        } else {
            return redirect()->to('login/');
        }
        
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        dd(__FUNCTION__, $request->all());
    }

    public function indexCaptacion(Request $request, $id)
    {
        return 'captacion '.$id;
    }

  
}
