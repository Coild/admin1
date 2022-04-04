<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contohkemasan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kemasan';
    public $timestamps = true;
    
    protected $fillable = [
        'status',
    ];
}
