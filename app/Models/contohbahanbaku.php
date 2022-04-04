<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contohbahanbaku extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_bahanbaku';
    public $timestamps = true;

    protected $fillable = [
        'status',
    ];
}
