<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exceptions\ErrorException;
use App\Models\Poste;
use Illuminate\Support\Str;

class PosteController extends Controller
{
    //
    
    public function addPoste(Poste $p) {
        try {
            $validate = request()->validate([
                'intitule'  =>  'required|string',
                'salaire'   =>  'required|numeric|min : 100000'
            ],[
                'required'  =>  '`:attribute` requi(s) !',
                'min'   =>  'Valeur minimum requis : 100,000'
            ]);

            // VERIFIER L'UNICITE DU POSTE DANS LE SYSTEME
            $p->reference = Str::slug(request()->intitule);
            $p->nom = request()->intitule;
            $p->salaire = request()->salaire;
            $p->description = request()->description;

            if($p->isExist()) {
                throw new ErrorException("Ce poste existe deja dans le systeme !");
            }

            $p->save();

            return response()
                ->json('done');
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }

    public function listPoste(Poste $p) {
        try {
            $data = $p->select()
                ->orderBy('created_at','desc')
                ->paginate();

            $all = [];
            
            foreach($data as $key => $value) {
                $all[$key] = [
                    'nom'  =>  $value->nom,
                    'description'   =>  $value->description,
                    'salaire'   =>  $value->salaire
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
