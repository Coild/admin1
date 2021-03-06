<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pr_bahankemas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pr_bahankemas';

    protected $fillable = [
        'kode_kemas',
                                        'nama_kemas',
                                        'j_butuh',
                                        'j_tolak',
                                        'no_qc',
                                        'j_pakai',
                                        'j_kembali',
    ];
}
