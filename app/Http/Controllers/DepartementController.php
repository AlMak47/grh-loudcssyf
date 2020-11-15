<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exception\ErrorException;

class DepartementController extends Controller
{
    //

    public function addDepartement(Request $request) {
        try {

            
            return response()
                ->json($request);
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }
}
