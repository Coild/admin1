<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemusnahanprodukantara extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pemusnahanprodukantara';
    // public $timestamps = true;

    protected $guarded =['id_pemusnahanprodukantara'];
}
