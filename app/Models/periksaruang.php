<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periksaruang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_periksaruang';
    protected $guarded = ['id_periksaruang'];
}
