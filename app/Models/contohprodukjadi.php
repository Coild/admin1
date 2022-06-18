<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contohprodukjadi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produkjadi';
    public $timestamps = true;

    protected $fillable = [
        'id_produkjadi',
        'kode_produk',
        'nama_produkjadi',
        'no_batch',
        'tanggal_ambil',
        'kedaluwarsa',
        'jumlah_kemasanbox',
        'jumlah_produk',
        'jenis_warnakemasan',
        'status',
        'protap'
    ];
}
