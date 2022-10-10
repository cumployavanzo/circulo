<?php

namespace App\Http\Controllers;

use App\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function getCliente($id)
    {
        return Cliente::where('id', $id)->first();
    }

    public function getClientesPaginate()
    {
        return Cliente::paginate(10);
    }
    public function getClientes()
    {
        return Cliente::all();
    }
}
