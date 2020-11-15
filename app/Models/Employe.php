<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Services;


class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';

    protected $keyType = 'string';
    protected $primaryKey = 'matricule';

    public function generateMatricule() {
        do {
            $this->matricule = mt_rand(1000,9999).Str::upper(Str::random(4));
        }
        while($this->isExistEmploye());
    }

    public function isExistEmploye() {
        $data = $this->find($this->matricule);
        if($data) {
            return $data;
        }
        return false;
    }


    // UNICITE DE L'OCCUPATION DE LA FONCTION DANS UN DEPARTEMENT

    public function isExisteFonctionByDepartement($dep,$poste) {
        $data = Services::where('departement',$dep)
            ->where('id_postes',$poste)
            ->where('status',true)
            ->first();

        if($data) {
            return $data;
        }
        return false;
    }

    public function services() {
        return $this->hasMany('App\Models\Services','employe_id','matricule');
    }

}

