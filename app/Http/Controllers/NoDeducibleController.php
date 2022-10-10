<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gasto;
use App\DetalleGasto;
use App\Articulo;
use App\MovimientoGasto;
use App\Proveedor;
use App\Personal;

class NoDeducibleController extends Controller
{
    //
    public function index()
    {
        $gastos = Gasto::where('bandera', 'No deducible')->paginate(10);
        return view('admin.no_deducible.index', compact('gastos'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $personals = Personal::all();
        $articulos = Articulo::all();
        return view('admin.no_deducible.addNodeducible', compact('proveedores','articulos','personals'));
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
            $gasto->bandera = 'No deducible';
            $gasto->detalle_compra = mb_strtoupper($request->input('detalle_compra'), 'UTF-8');
            $gasto->save();
            $gastoID= $gasto["id"];

            $movimientos = new MovimientoGasto();
            $movimientos->compras_id = $gastoID;
            $movimientos->bandera = 'No deducible';
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
                'importe' => number_format($totalImp,4,'.',','),
                'iva' => number_format($totalIva,4,'.',','),
                'r_iva' => number_format($totalRiva,4,'.',','),
                'r_isr' => number_format($totalIsr,4,'.',','),
                'total' => number_format($total,4,'.',','),
            ]);
        }
        return redirect()->route('admin.noDeducible.edit', [$gastoID]);
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
        return view('admin.no_deducible.edit_deducible', compact('gasto', 'gastoProducto','proveedores','opcionProveedor','articulos','gastoP','personals','opcionPersonal'));
    }

    public function verArticuloNoDeducible($id){
        $articulo = Articulo::where('id', $id)->first();
        return response()->json(["articulo" => $articulo]);
    }


    public function verRfcNoDeducible($id){
        $provedorRfc = Proveedor::where('id', $id)->first();
        return response()->json(["provedorRfc" => $provedorRfc]);
    }

    public function verAreaNoDeducible($id){
        $personalsArea = Personal::where('id', $id)->first()->puestoid->areas;
        return response()->json(["personalsArea" => $personalsArea]);
    }
}
