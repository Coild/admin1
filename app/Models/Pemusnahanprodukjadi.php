<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemusnahanprodukjadi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pemusnahanprodukjadi';

    protected $guarded =['id_pemusnahanprodukjadi'];
}
