<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ErrorException;
use App\Models\Departement;
use Illuminate\Support\Str;

class DepartementController extends Controller
{
    //

    public function addDepartement(Departement $dep) {
        try {

            $validation = request()->validate([
                'intitule'  =>  'required|string',
            ],[
                'required'  =>  '`:attribute` requi(s) !'
            ]);
            // VERIFIER L'UNICITE DU DEPARTEMENT
            
            $dep->reference = Str::slug(request()->intitule);
            $dep->title = request()->intitule;
            $dep->description = request()->description;

            if($dep->isExist()) {
               throw new ErrorException("Ce Departement existe deja !");
            }

            $dep->save();

            return response()
                ->json('done');
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }

    public function listDepartement(Departement $dep) {
        try {
            $data = $dep->select()
                ->orderBy('created_at','desc')
                ->paginate(500);
            
            $all = [];

            foreach($data as $key => $value) {
                $all[$key] = [
                    'reference' =>  '',
                    'title' =>  $value->title,
                    'description'   =>  $value->description
                ];
            }

            return response()
                ->json([
                    'all'   =>  $all,
                    'next_url'	=> $data->nextPageUrl(),
                    'last_url'	=> $data->previousPageUrl(),
                    'per_page'	=>	$data->perPage(),
                    'current_page'	=>	$data->currentPage(),
                    'first_page'	=>	$data->url(1),
                    'first_item'	=>	$data->firstItem(),
                    'total'	=>	$data->total()
                ]);
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }
}
