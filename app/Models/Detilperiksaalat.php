<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detilperiksaalat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detilalat';
    protected $guarded = ['id_detilalat'];
}
