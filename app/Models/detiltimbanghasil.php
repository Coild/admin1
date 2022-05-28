<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detiltimbanghasil extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detiltimbangproduk';
    protected $fillable = [
        'no_loth',
        'jumlah_permintaan',
        'hasil_penimbangan',
        'sisa_bahan',
        'untuk_produk',
    ];
}
