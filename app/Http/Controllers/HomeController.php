<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asociado;
use App\Cliente;
use App\Personal;
use App\Aval;
use App\Producto;
use App\Solicitud;
use App\SucursalRuta;
use App\Analisis_credito;
use App\User;
use App\TablaAmortizacion;
use App\Articulo;
use App\Proveedor;
use App\Gasto;
use App\Banco;
use App\Caja;
use App\DetalleNomina;

class HomeController extends Controller
{
    public function index()
    {
        if(User::where('confirmed','1')->first() ){
            if (auth()->check()) {
                //consultas para el dashboard
                $data = $this->consultasDashboard();
                return view('index', $data);

            } else {
                return redirect()->to('login/');
            }
        }else{
            return redirect()->to('login/')->withErrors([
                'invalido' => 'Usuario no confirmado.',
            ]);
        }
    }

    public function consultasDashboard()
    { 
        ///** COMERCIAL **///
        $rutas = SucursalRuta::count();
        $productos = Producto::count();
        $avales = Aval::count();
        $clientes = Cliente::count();
        $asociados = Asociado::count();
        ///** CAPTACION **///
        $solicitudes = Solicitud::count();
        $solAutorizadas = Solicitud::where('estatus','Autorizado')->count();
        $solPendientes = Solicitud::where('estatus','Pendiente')->count();
        $solNoDesembolsadas = Analisis_credito::where('desembolso','Pendiente')->count();
         ///** CARTERA **///
        $capitalMinistrado = Analisis_credito::selectRaw('SUM(monto_autorizado) as monto_autorizado')->where('desembolso','Desembolsado')->get();
        $interesesGenerados = TablaAmortizacion::selectRaw('SUM(interes) as intereses')->get();
        $interesesRecuperados = TablaAmortizacion::selectRaw('SUM(interes) as intereses_rec')->where('estatus','Cobrado')->get();
        $capitalRecuperado = TablaAmortizacion::selectRaw('SUM(capital) as capital')->where('estatus','Cobrado')->get();
         ///** RECURSOS HUMANOS **///
        $plantilla = Personal::count();
        $altas = Personal::where('state','Activo')->count();
        $bajas = Personal::where('state','Inactivo')->count();
        $montoNomina = DetalleNomina::selectRaw('SUM(neto_pagar) as total_pagar')->get();
         ///** COMPRAS **///
        $articulos = Articulo::count();
        $proveedor = Proveedor::count();
        $gasto = Gasto::selectRaw('SUM(total) as total_gasto')->where('bandera', 'Compra')->get();
        $activo = Gasto::selectRaw('SUM(total) as total_activo')->where('bandera', 'Activo')->get();
        $noDeducible = Gasto::selectRaw('SUM(total) as total_noDeducible')->where('bandera', 'No deducible')->get();
        ///** COMPRAS **///
        $bancos = Banco::count();
        $cajas = Caja::count();
        $pagos = Gasto::selectRaw('SUM(total) as total_pago')->where('concepto','!=', 'APORTACIONES DE CAPITAL')->get();
        $cobros = TablaAmortizacion::selectRaw('SUM(pago) as monto_pago')->where('estatus','Cobrado')->get();
        $capital = Gasto::selectRaw('SUM(total) as capital_invertido')->where('bandera', 'Capital')->get();

        $data = compact('clientes','plantilla','altas','bajas','montoNomina','avales','productos','solicitudes','rutas','solAutorizadas','solNoDesembolsadas','asociados','solPendientes','capitalMinistrado','interesesGenerados','capitalRecuperado','interesesRecuperados','articulos','proveedor','gasto','activo','noDeducible','bancos','cajas','pagos','cobros','capital');
        return $data;
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
