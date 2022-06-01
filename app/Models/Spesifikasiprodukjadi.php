<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesifikasiprodukjadi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_spesifikasiprodukjadi';

    protected $guarded =['id_spesifikasiprodukjadi'];

}
