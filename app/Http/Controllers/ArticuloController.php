<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Clasificacion;
use App\Cuenta;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        $name_articulo =  mb_strtoupper($request->get('txt_name_articulo'), 'UTF-8');
        $articulos = Articulo::nameArticulo($name_articulo)->orderBy('nombre_producto', 'ASC')->paginate(10);
        return view('admin.articulos.index', compact('articulos','name_articulo'));
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        return view('admin.articulos.addArticulos', compact('cuentas'));

    }

    public function verClasificacion($id){
        $clasificaciones = Clasificacion::where('tipo_producto', $id)->get();
        return response()->json(["clasificaciones" => $clasificaciones]);
    }

    public function store(Request $request)
    {
        $articulos = new Articulo();
        $articulos->nombre_producto = mb_strtoupper($request->input('txt_nombre_producto'), 'UTF-8');
        $articulos->codigo_producto = $request->input('txt_codigo');
        $articulos->unidad_medida = mb_strtoupper($request->input('txt_unidad_medida'), 'UTF-8');
        $articulos->tipo_producto = mb_strtoupper($request->input('txt_tipo'), 'UTF-8');
        $articulos->clasificacion = $request->input('txt_clasificacion');
        $articulos->cuentas_id = $request->input('txt_cuenta_p');
        $articulos->iva = $request->input('txt_IVA');
        $articulos->cuentas_id_iva = $request->input('txt_cuenta_iva');
        $articulos->retencion_isr = $request->input('txt_ret_isr');
        $articulos->cuenta_id_ret_isr = $request->input('txt_cuenta_ret_isr');
        $articulos->retencion_iva = $request->input('txt_ret_iva');
        $articulos->cuenta_id_ret_iva = $request->input('txt_cuenta_ret_iva');
        $articulos->depreciacion = $request->input('txt_depreciacion');
        $articulos->cuenta_id_deprec = $request->input('txt_cuenta_deprec');
        $articulos->save();
        // return redirect('admin/articulos/addarticulos')->with('success', 'Se ha agregado el Artículo exitosamente');
        return redirect()->route('admin.articulo.index');

    }

    public function edit($id)
    {
        $articulo = Articulo::where('id', $id)->first();
        $cuentas = Cuenta::all();
        $opcionCuenta = "N/A";
        $cuentaIva = "N/A";
        $cuentaRetIva = "N/A";
        $cuentaRetIsr = "N/A";
        $cuentaDeprec = "N/A";
        if($articulo->cuentas()->first('id') != null){
            $opcionCuenta = $articulo->cuentas()->first('id')->id;
        }
        if($articulo->cuentasIva()->first('id') != null){
            $cuentaIva = $articulo->cuentasIva()->first('id')->id;
        }
        if($articulo->cuentasRetIva()->first('id') != null){
            $cuentaRetIva = $articulo->cuentasRetIva()->first('id')->id;
        }
        if($articulo->cuentasRetIsr()->first('id') != null){
            $cuentaRetIsr = $articulo->cuentasRetIsr()->first('id')->id;
        }
        if($articulo->cuentasDeprec()->first('id') != null){
            $cuentaDeprec = $articulo->cuentasDeprec()->first('id')->id;
        }
        return view('admin.articulos.editArticulos', compact('articulo','cuentas','opcionCuenta','cuentaIva','cuentaRetIva','cuentaRetIsr','cuentaDeprec'));
    }

    public function update(Request $request, $id)
    {
        Articulo::where('id', $id)->update([
            'nombre_producto' => mb_strtoupper($request->txt_nombre_producto, 'UTF-8'),
            'codigo_producto' => $request->txt_codigo,
            'unidad_medida' => mb_strtoupper($request->txt_unidad_medida, 'UTF-8'),
            'tipo_producto' => mb_strtoupper($request->txt_tipo, 'UTF-8'),
            'clasificacion' => $request->txt_clasificacion,
            'cuentas_id' => $request->txt_cuenta_p,
            'iva' => $request->txt_IVA,
            'cuentas_id_iva' => $request->txt_cuenta_iva,
            'retencion_isr' => $request->txt_ret_isr,
            'cuenta_id_ret_isr' => $request->txt_cuenta_ret_isr,
            'retencion_iva' => $request->txt_ret_iva,
            'cuenta_id_ret_iva' => $request->txt_cuenta_ret_iva,
            'depreciacion' => $request->txt_depreciacion,
            'cuenta_id_deprec' => $request->txt_cuenta_deprec
        ]);
        return redirect()->route('admin.articulo.edit',[$id])->with('mensaje', 'Se ha editado el Articulo exitosamente');
        // return back()->with('mensaje', 'Se ha editado el Artículo exitosamente');
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return redirect()->route('admin.articulo.index');
        // return back()->with('success','Se ha borrado el Artículo exitosamente');
    }
}
