<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detiltimbangproduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detiltimbanghasil';
    protected $fillable = [
        'asal_produk',
            'nama_produk_antara',
            'jumlah_produk',
            'hasil_penimbangan',
            'untuk_produk',
    ];
}
