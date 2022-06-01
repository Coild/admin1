<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemusnahanbahanbaku extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pemusnahanbahan';
    // public $timestamps = true;

    protected $guarded =['id_pemusnahanbahan'];

}
