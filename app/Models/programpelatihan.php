<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programpelatihan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_programpelatihan';

    protected $fillable = [
        'status',
    ];
}
