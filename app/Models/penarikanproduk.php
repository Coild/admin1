<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penarikanproduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk_penarikan';
    public $timestamps = true;

    protected $guarded =['id_produk_penarikan'];
}
