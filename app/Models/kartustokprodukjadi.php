<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartustokprodukjadi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kartustokprodukjadi';

    protected $guarded =['id_kartustokprodukjadi'];

}
