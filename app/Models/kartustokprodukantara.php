<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartustokprodukantara extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kartustokprodukantara';

    protected $guarded =['id_kartustokprodukantara'];

}
