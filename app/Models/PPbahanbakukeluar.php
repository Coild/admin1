<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPbahanbakukeluar extends Model
{
    use HasFactory; 
    protected $primaryKey = 'id_ppbahanbakukeluar';

    protected $fillable = [
        'status',
    ];
}
