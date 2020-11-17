<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Employe;
use App\Models\Departement;
use App\Models\Services;
use App\Exceptions\ErrorException;
use Illuminate\Support\Facades\Crypt;


class EmployeController extends Controller
{
    //

    public function addGetData(Poste $p,Departement $dep) {
        try {
            return response()
                ->json([
                    'postes'    => $p->all(),
                    'departement'   =>  $dep->all()
                ]);
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }

    public function addEmployeRequest(Request $request,Employe $e , Services $s) {
        try {
            $validation = request()->validate([
                'nom'   =>  'required|string',
                'prenom'    =>  'required|string',
                'telephone'    =>  'required|string',
                'piece_identite'    =>  'required|string',
                'filiation'    =>  'required|string',
                'date_naissance'    =>  'required|date',
                'numero_facture'    =>  'required|string',
                'fonction'    =>  'required|string|exists:postes,reference',
                'departement'   =>  'required|string|exists:departements,reference',
                'quartier'    =>  'required|string',
                'commune'    =>  'required|string',
            ],[
                'required'  =>  '`:attribute` requi(s) !',
            ]);
            


            $e->generateMatricule();
            $e->nom = request()->nom;
            $e->prenom = request()->prenom;
            $e->phone = request()->telephone;
            $e->numero_identite = request()->piece_identite;
            $e->filiation = request()->filiation;
            $e->date_naissance = request()->date_naissance;
            $e->numero_facture = request()->numero_facture;
            $e->quartier = request()->quartier;
            $e->commune = request()->commune;

            // VERIFIER L'UNICITE DE LA FONCTION PAR DEPARTEMENT POUR UN EMPLOYE

            if($e->isExisteFonctionByDepartement(request()->departement,request()->fonction)) {
               throw new ErrorException("Le poste est deja pris !") ;
            }
            

            $s->departement = request()->departement;
            $s->employe_id = $e->matricule;
            $s->id_postes = request()->fonction;

            $e->save();
            $s->save();

            return response()
                ->json('done');
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }

    // LISTING DES EMPLOYES

    public function listEmployeRequest(Employe $e) {
        try {
            $data = $e->select()
                ->orderBy('created_at','desc')
                ->paginate();
            $all = [];
            $encrypted_data = [];

            foreach($data as $key => $value) {
                $all[$key] = [
                    // 'encrypted_matricule'   =>  Crypt::encryptString($value->matricule),
                    'matricule' =>  $value->matricule,
                    'nom'   =>  $value->nom,
                    'prenom'    =>  $value->prenom,
                    'fonction'  =>  $value->services()
                        ->where('status',true)
                        ->first()
                        ->poste()
                        ->first()->nom,
                    'departement'   =>  $value->services()
                        ->where('status',true)
                        ->first()
                        ->departement()
                        ->first()->title,
                    'telephone' =>  $value->phone,
                    'id_card'   =>  $value->numero_identite,
                    // 'id_facture'    =>  $value->numero_facture,
                    'quartier'  =>  $value->quartier,
                    'commune'   =>  $value->commune,
                    // 'filiation' =>  $value->filiation,
                    // 'date_naissance'    =>  $value->date_naissance,
                ];

                $encrypted_data[$value->matricule] = Crypt::encryptString($value->matricule);
            }

            return response()
                ->json([
                    'all'   =>  $all,
                    'encrypted' =>  $encrypted_data,
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

    // GET DETAILS INFOS EMPLOYE

    public function getDetails($id,Employe $e) {
        try {
            $data_employe = $e->find(Crypt::decryptString($id));
            $data_fonction = $data_employe->services()
                ->where('status',true)
                ->first()
                ->poste()
                ->first();
            
            $data_departement = $data_employe->services()
                ->where('status',true)
                ->first()
                ->departement()
                ->first();

            return response()
                ->json([
                    'employe'   =>  $data_employe,
                    'fonction'  =>  $data_fonction,
                    'departement'   =>  $data_departement
                ]);
        }
        catch(ErrorException $e) {
            header("Erreur",true,422);
            die(json_encode($e->getMessage()));
        }
    }
}
