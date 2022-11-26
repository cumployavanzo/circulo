<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Cuenta;
use Illuminate\Http\Request;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $name =  mb_strtoupper($request->get('txt_name'), 'UTF-8');
        $productos = Producto::name($name)->paginate(10);
        return view('admin.productos.index', compact('productos','name'));
    }

    public function create()
    {
        $productos = Producto::all();
        $cuentas = Cuenta::all();
        return view('admin.productos.addProductos', compact('productos','cuentas'));
    }

    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = mb_strtoupper($request->input('txt_nombre_producto'), 'UTF-8');
        $producto->frecuencia_pago = mb_strtoupper($request->input('txt_frecuencia'), 'UTF-8');
        $producto->tasa = $request->input('txt_tasa');
        $producto->plazo = $request->input('txt_plazo');
        $producto->monto_prestamo = (str_replace(",","",$request->input('txt_monto_prestamo')));
        $producto->nivel = $request->input('txt_nivel');
        $producto->monto_pago = $request->input('txt_monto_pago');
        $producto->meses = $request->input('txt_meses');
        $producto->total = $request->input('txt_total');
        $producto->cuentas_id = $request->input('txt_cuenta');
        $producto->save();
        return redirect()->route('admin.producto.index');
        // return redirect('admin/productos/addproductos')->with('success', 'Se ha agregado el producto exitosamente');
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
        $producto = Producto::where('id', $id)->first();
        $cuentas = Cuenta::all();
        $opcionCuenta = "N/A";
        if($producto->cuentas()->first('id') != null){
            $opcionCuenta = $producto->cuentas()->first('id')->id;
        }
        return view('admin.productos.editProductos', compact('producto','cuentas','opcionCuenta'));
    }

    public function update(Request $request, $id)
    {
        Producto::where('id', $id)->update([
            'nombre' => mb_strtoupper($request->txt_nombre_producto, 'UTF-8'),
            'frecuencia_pago' => mb_strtoupper($request->txt_frecuencia, 'UTF-8'),
            'tasa' => $request->txt_tasa,
            'plazo' => $request->txt_plazo,
            'monto_prestamo' => (str_replace(",","",$request->txt_monto_prestamo)),
            'nivel' => $request->txt_nivel,
            'monto_pago' => $request->txt_monto_pago,
            'meses' => $request->txt_meses,
            'total' => $request->txt_total,
            'cuentas_id' => $request->txt_cuenta
        ]);
        return redirect()->route('admin.producto.edit',[$id])->with('mensaje', 'Se ha editado el Producto exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Producto exitosamente');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect()->route('admin.producto.index');
        // return back()->with('success','Se ha borrado el producto exitosamente');
    }

    public function verNumCuenta($id){
        $cuenta = Cuenta::where('id', $id)->first();
        return response()->json(["cuenta" => $cuenta]);
    }

    public function reporteSucursales(){
        $data = Producto::orderBy('nombre', 'ASC');
        return Excel::download(new ProductosExport($data->get()), 'productos'. '.xlsx');
    }
}
