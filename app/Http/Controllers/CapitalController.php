<?php

namespace App\Http\Controllers;
use App\Gasto;
use App\Personal;
use App\DetalleGasto;
use App\MovimientoGasto;

use Illuminate\Http\Request;

class CapitalController extends Controller
{
    
    public function index()
    {
        $gastos = Gasto::where('bandera', 'Capital')->paginate(10);
        return view('admin.capitales.index', compact('gastos'));
    }

    public function create()
    {
        $personals = Personal::all();
        return view('admin.capitales.addCapital', compact('personals'));
    }

    public function verDetallesPersonal($id){
        $personals = Personal::where('id', $id)->first();
        $puesto = $personals->puestoid->puesto;
        return response()->json(["personals" => $personals,"puesto" => $puesto]);
    }

    public function store(Request $request)
    {
        // dd($request);
        if($request->idGasto == 0){
            $gasto = new Gasto();
            $gasto->users_id = auth()->user()->id;
            $gasto->personals_id = $request->input('Fk_empleado');
            $gasto->fecha_compra = $request->input('fecha_compra');
            $gasto->bandera = 'Capital';
            $gasto->concepto = $request->input('txt_concepto');
            $gasto->detalle_compra = mb_strtoupper($request->input('detalle_compra'), 'UTF-8');
            $gasto->save();
            $gastoID= $gasto["id"];

            $movimientos = new MovimientoGasto();
            $movimientos->compras_id = $gastoID;
            $movimientos->bandera = 'Capital';
            $movimientos->save();  
           
        }else{
            $gasto = new Gasto();
            $gastoID = $request->idGasto;
            Gasto::where('id', $gastoID)->update([
                'personals_id' => $request->input('Fk_empleado'),
                'fecha_compra' => $request->input('fecha_compra'),
                'detalle_compra' => mb_strtoupper($request->input('detalle_compra'), 'UTF-8'),
            ]);
        }
    
       
        if($gastoID){
            $producto = new DetalleGasto();
            $producto->compras_id = $gastoID;
            // $producto->articulos_id = '0';
            $producto->cantidad = $request->input('cantidades');
            $producto->costo_unitario = (str_replace(",","",$request->input('costo_unitario')));
            $producto->importe = (str_replace(",","",$request->input('costo_unitario'))) * $request->input('cantidades');
            $producto->total = $producto->importe;
            $producto->save();
            $detalle_compraID= $producto["id"];
            
            $gastoProducto = DetalleGasto::where('compras_id', $gastoID)->get();
            $total = 0;
            $totalImp = 0;
            foreach($gastoProducto as $producto){
                $total += $producto->total;
                $totalImp += $producto->importe;

            }
            Gasto::where('id', $gastoID)->update([
                'importe' => $totalImp,
                'total' => $total,
            ]);
        }
        return redirect()->route('admin.capital.show', [$gastoID]);
    }

    public function show(Request $request,$gasto_id)
    {
       
        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();
        $gastoP = DetalleGasto::where('compras_id', $gasto_id)->first();
        $personals = Personal::all();
        $opcionPersonal = "N/A";
        if($gasto->personals()->first('id') != null){
            $opcionPersonal = $gasto->personals()->first('id')->id;
        }   
        return view('admin.capitales.showCapital', compact('gasto', 'gastoProducto','gastoP','personals','opcionPersonal'));
    }

    public function edit(Request $request,$gasto_id)
    {
       
        $gasto = Gasto::where('id', $gasto_id)->first(); // ->with(')
        $gastoProducto = DetalleGasto::where('compras_id', $gasto_id)->get();
        $gastoP = DetalleGasto::where('compras_id', $gasto_id)->first();
        $personals = Personal::all();
        $opcionPersonal = "N/A";
        if($gasto->personals()->first('id') != null){
            $opcionPersonal = $gasto->personals()->first('id')->id;
        }   
        return view('admin.capitales.editCapital', compact('gasto', 'gastoProducto','gastoP','personals','opcionPersonal'));
    }


    public function update(Request $request, $id)
    {
        Gasto::where('id', $id)->update([
            'personals_id' => $request->input('Fk_empleado'),
            'importe' => $request->input('total'),
            'total' => $request->input('total'), ////el calculo ya se hizo en el blade
            'fecha_compra' => $request->input('fecha_compra'),
            'detalle_compra' => mb_strtoupper($request->input('detalle_compra'), 'UTF-8'),
            'concepto' => mb_strtoupper($request->input('txt_concepto'), 'UTF-8'),
        ]);
        DetalleGasto::where('compras_id', $id)->update([
            'cantidad' => $request->input('cantidades'),
            'costo_unitario' => str_replace(",","",$request->input('costo_unitario')),
            'importe' => $request->input('total'),
            'total' => $request->input('total'), ////el calculo ya se hizo en el blade
        ]);
        return redirect()->route('admin.capital.show', [$id])->with('mensaje', 'Se ha editado la Solicitud exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Personal exitosamente');
    }
}
