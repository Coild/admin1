<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detiltimbangbahan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detiltimbangbahan';
    protected $fillable = [
        'nama_bahan',
        'nama_suplier',
        'jumlah_bahan',
        'hasil_penimbangan'
    ];
}
