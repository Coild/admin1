<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksaalat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_periksaalat';
    protected $guarded = ['id_periksaalat'];

}
