<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detilruangan extends Model
{
    use HasFactory;
    protected $fillable = ['diperiksa_oleh', 'keterangan', 'lantai', 'meja', 'jendela', 'langit', 'pelaksana'];

}
