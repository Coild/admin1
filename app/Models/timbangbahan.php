<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timbangbahan extends Model
{
    use HasFactory;
    protected $primaryKey = 'timbang_bahan_id';
    public $timestamps = true;
}
