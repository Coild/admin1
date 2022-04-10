<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihancpkb extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pelatihancpkb';

    protected $fillable = [
        'status',
    ];
}
