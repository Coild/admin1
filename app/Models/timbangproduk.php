<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timbangproduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'timbang_produk_id';
    public $timestamps = true;
}
