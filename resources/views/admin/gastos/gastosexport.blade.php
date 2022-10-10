
<table>
    <tr>
        <td>#ID compra</td>
        <td>Fecha compra</td>
        <td>Número Factura</td>
        <td>Proveedor</td>
        <td>Articulo</td>
        <td>Cantidad</td>
        <td>Importe</td>
        <td>Iva</td>
        <td>Total</td>
    </tr>
    @php
        $cont = 0;
    @endphp
    @foreach($data as $gasto)
            @php
            $cont ++;
            //  dd($gasto);
            // $total += str_replace(',',"",$gasto->detalleCompra->total);
            @endphp
            <tr>
                <td>{{ $gasto->IDcompra }}</td>
                <td>{{ date('d/m/Y', strtotime($gasto->fecha_compra))}}</td>
                <td>{{ $gasto->num_factura}}</td>
                <td>{{ $gasto->nombre_proveedor}}</td>
                <td>{{ $gasto->nombre_producto}}</td>
                <td>{{ $gasto->cantidad}}</td>
                <td>{{ str_replace(',',"",$gasto->importe) }}</td>
                <td>{{ str_replace(',',"",$gasto->p_iva) }}</td>
                <td>{{ str_replace(',',"",$gasto->total) }}</td>
                
            </tr>
           
    @endforeach
   
</table>
