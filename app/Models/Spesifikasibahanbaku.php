<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesifikasibahanbaku extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_spesifikasibahanbaku';

    protected $guarded =['id_spesifikasibahanbaku'];


}
