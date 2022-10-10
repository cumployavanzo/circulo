<?php

namespace App\Http\Controllers;

use App\Personal;

use Illuminate\Http\Request;

class PersonalController extends Controller
{
    //
    public function getPersonalPaginate(Request $request)
    {
        if($request->estatus){
            $personales = Personal::where('state', $request->estatus)->paginate(10);
        }else{
            $personales = Personal::paginate(10);
        }
        
        return $personales;
    }

}
