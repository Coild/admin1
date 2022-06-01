<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesifikasibahankemas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_spesifikasibahankemas';

    protected $guarded =['id_spesifikasibahankemas'];

}
