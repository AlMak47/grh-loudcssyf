<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $table = 'postes';
    protected $keyType = 'string';
    protected $primaryKey= 'reference';

    public function isExist() {
        $data = $this->find($this->reference);
        if($data) {
            return $data;
        }
        return false;
    }
}
