<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemusnahanBahanKemas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pemusnahanbahankemas';
    protected $table = 'Pemusnahanbahankemas';
    // public $timestamps = true;

    protected $guarded =['id_pemusnahanbahankemas'];
}
