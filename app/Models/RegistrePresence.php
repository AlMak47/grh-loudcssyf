<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrePresence extends Model
{
    use HasFactory;

    protected $table = 'registre_presences';

    protected $keyType = 'string';
    protected $primaryKey = 'id_pointage';
}
