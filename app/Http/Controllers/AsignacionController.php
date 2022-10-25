<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignacion;
use App\MovimientoAsignacion;
use App\Articulo;
use App\Personal;
use App\Proveedor;
use App\SucursalRuta;
use App\TipoVehiculo;
use App\Gasto;
use App\DetalleGasto;


class AsignacionController extends Controller
{
    //
    public function index()
    {
        $asignaciones = Asignacion::paginate(10);
        return view('admin.asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $articulos_activo = Gasto::select('articulos.nombre_producto','detalles_compras.id')
        ->where('bandera', 'Activo')
        ->where('articulos.clasificacion', 'Equipo de Transporte')
        ->join('detalles_compras', 'detalles_compras.compras_id', '=', 'compras.id')
        ->join('articulos', 'articulos.id', '=', 'detalles_compras.articulos_id')
        ->get();
        
        $personals = Personal::all();
        $proveedores = Proveedor::all();
        $sucursales = SucursalRuta::all();
        $tipos_veh = TipoVehiculo::orderBy('nombre','ASC')->get();
        return view('admin.asignaciones.addAsignacion', compact('articulos_activo','personals','proveedores','sucursales','tipos_veh'));
    }

    public function store(Request $request)
    {
        //  dd($request);
        $asignacion = new Asignacion();
        $asignacion->fecha_asignacion = $request->input('fecha_asignacion');
        $asignacion->proveedores_id = $request->input('Fk_proveedor');
        $asignacion->detalles_compras_id = $request->input('Fk_detalle_compra');
        $asignacion->tipos_vehiculos_id = $request->input('txt_tipo_vehiculo');
        $asignacion->num_pasajeros = $request->input('txt_num_pasajeros');
        $asignacion->personals_id_propietario = $request->input('Fk_propietario');
        $asignacion->poliza_seguro = mb_strtoupper($request->input('txt_poliza'), 'UTF-8');
        $asignacion->save();
        $asignacionID= $asignacion["id"];


        $movimiento = new MovimientoAsignacion();
        $movimiento->asignacion_id = $asignacionID;
        $movimiento->personals_id_conductor = $request->input('Fk_conductor');
        $movimiento->sucursales_id = $request->input('Fk_ruta');
        $movimiento->state = $request->input('txt_state');
        $movimiento->save();

       
        return redirect()->route('admin.asignacion.index');

    }

    public function verDetalleCompraActivo($idDetalle){
        $detalles = DetalleGasto::where('id', $idDetalle)->first();
        return response()->json(["detalles" => $detalles]);
    }
}
