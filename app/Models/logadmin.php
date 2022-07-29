<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logadmin extends Model
{
    use HasFactory;

    protected $primaryKey = 'logadmin_id';
    protected $guarded = ['logadmin_id'];

}
