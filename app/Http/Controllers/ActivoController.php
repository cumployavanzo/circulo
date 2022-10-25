<?php

namespace App\Http\Controllers;
use App\Gasto;
use App\Proveedor;
use App\Articulo;
use App\DetalleGasto;
use App\Cuenta;
use App\Personal;
use App\MovimientoGasto;
use Illuminate\Http\Request;

class ActivoController extends Controller
{
    //
    public function index(Request $request)
    {

        $name_proveedor =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $gastos = Gasto::select('compras.*','proveedores.nombre_proveedor')
        ->where('bandera', 'Activo')
        ->where('nombre_proveedor','LIKE',"%$name_proveedor%")
        ->join('proveedores', 'proveedores.id', '=', 'compras.proveedores_id')
        ->orderBy('fecha_compra', 'DESC')
        ->paginate(10);
        return view('admin.activos.index', compact('gastos','name_proveedor'));
    }
    
    public function create()
    {
        //$gastos = Gasto::all();
        $proveedores = Proveedor::all();
        $personals = Personal::all();
        $articulos = Articulo::all();
        return view('admin.activos.addActivo', compact('proveedores','articulos','personals'));
    }

    public function store(Request $request)
    {
        // dd($request);
        if($request->idGasto == 0){
            $gasto = new Gasto();
            $gasto->users_id = auth()->user()->id;
            $gasto->num_factura = mb_strtoupper($request->input('num_factura'), 'UTF-8');
            $gasto->proveedores_id = $request->input('Fk_proveedor');
            $gasto->personals_id = $request->input('Fk_empleado');
            $gasto->fecha_compra = $request->input('fecha_compra');
            $gasto->bandera = 'Activo';
            $gasto->detalle_compra = mb_strtoupper($request->input('detalle_compra'), 'UTF-8');
            $gasto->save();
            $gastoID= $gasto["id"];

            $movimientos = new MovimientoGasto();
            $movimientos->compras_id = $gastoID;
            $movimientos->bandera = 'Activo';
            $movimientos->save();  
           
        }else{
            $gasto = new Gasto();
            $gastoID = $request->idGasto;
            Gasto::where('id', $gastoID)->update([
                'num_factura' => mb_strtoupper($request->input('num_factura'), 'UTF-8'),
                'proveedores_id' => $request->input('Fk_proveedor'),
                'personals_id' => $request->input('Fk_empleado'),
                'fecha_compra' => $request->input('fecha_compra'),
                'detalle_compra' => mb_strtoupper($request->input('detalle_compra'), 'UTF-8'),
            ]);
        }
    
       
        if($gastoID){
            $producto = new DetalleGasto();
            $articulo = Articulo::where('id', $request->input('Fk_articulo'))->get();
            $producto->compras_id = $gastoID;
            $producto->articulos_id = $request->input('Fk_articulo');
            $producto->cantidad = $request->input('cantidades');
            $producto->numero_serie = mb_strtoupper($request->input('num_serie'), 'UTF-8');
            $producto->modelo = mb_strtoupper($request->input('modelo'), 'UTF-8');
            $producto->placas = mb_strtoupper($request->input('placas'), 'UTF-8');
            $producto->numero_economico = mb_strtoupper($request->input('num_economico'), 'UTF-8');
            $producto->costo_unitario = (str_replace(",","",$request->input('costo_unitario')));
            $producto->importe = (str_replace(",","",$request->input('costo_unitario'))) * $request->input('cantidades');
            $producto->p_iva = $producto->importe * $articulo->first()->iva;
            $producto->p_riva = $producto->importe * $articulo->first()->retencion_iva;
            $producto->p_risr = $producto->importe * $articulo->first()->retencion_isr;
            $producto->total = $producto->importe + $producto->p_iva -  $producto->p_riva -  $producto->p_risr;
            $producto->save();
            $detalle_compraID= $producto["id"];

            $gastoProducto = DetalleGasto::where('compras_id', $gastoID)->get();
            $total = 0;
            $totalIsr = 0;
            $totalRiva = 0;
            $totalIva = 0;
            $totalImp = 0;
            foreach($gastoProducto as $producto){
                $total += $producto->total;
                $totalIsr += $producto->p_risr;
                $totalRiva += $producto->p_riva;
                $totalIva += $producto->p_iva;
                $totalImp += $producto->importe;

            }
            Gasto::where('id', $gastoID)->update([
                'importe' => $totalImp,
                'iva' => $totalIva,
                'r_iva' => $totalRiva,
                'r_isr' => $totalIsr,
                'total' => $total,
            ]);
        }
        return redirect()->route('admin.activo.edit', [$gastoID]);
    }

    public function edit(Request $request,$gasto_id)
    {
       
        $articulos = Articulo::all();
        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();

        $gastoP = DetalleGasto::where('compras_id', $gasto_id)->first();

        $personals = Personal::all();
        $opcionPersonal = "N/A";
        if($gasto->personals()->first('id') != null){
            $opcionPersonal = $gasto->personals()->first('id')->id;
        }

        $proveedores = Proveedor::all();
        // $cuentaProvedor = Cuenta::where('id', 101)->first(); 
        $opcionProveedor = "N/A";
        if($gasto->proveedor()->first('id') != null){
            $opcionProveedor = $gasto->proveedor()->first('id')->id;
        }
        return view('admin.activos.edit', compact('gasto', 'gastoProducto','proveedores','opcionProveedor','articulos','gastoP','personals','opcionPersonal'));
    }

    public function verArticuloActivo($id){
        $articulo = Articulo::where('id', $id)->first();
        return response()->json(["articulo" => $articulo]);
    }


    public function verRfcActivo($id){
        $provedorRfc = Proveedor::where('id', $id)->first();
        return response()->json(["provedorRfc" => $provedorRfc]);
    }

    public function verAreaActivo($id){
        $personalsArea = Personal::where('id', $id)->first()->puestoid->areas;
        return response()->json(["personalsArea" => $personalsArea]);
    }

    public function destroy($idProducto,$idCompra)
    {
        // $movimiento = MovimientoGasto::where('compras_id',$idCompra)->delete(); ///borrar cuando se elimine la compra
        $detalleArticulo = DetalleGasto::find($idProducto);
        $detalleArticulo->delete();
        return redirect()->route('admin.activo.edit', [$idCompra]);
    }
}
