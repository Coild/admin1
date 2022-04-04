<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contohprodukjadi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produkjadi';
    public $timestamps = true;

    protected $fillable = [
        'status',
    ];
}
