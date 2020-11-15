<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';


    // ACCES A LA FONCTION
    public function poste() {
        return $this->belongsTo('App\Models\Poste','id_postes','reference');
    }

    public function departement() {
        return $this->belongsTo('App\Models\Departement','departement','reference');
    }

    public function employe() {
        return $this->belongsTo('App\Models\Employe','employe_id','matricule');
    }
}
