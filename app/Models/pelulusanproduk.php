<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelulusanproduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pelulusan';
    public $timestamps = true;

    protected $fillable = [
        'status',
    ];
    
}
