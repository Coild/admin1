<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartustokbahankemas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kartustokbahankemas';

    protected $guarded =['id_kartustokbahankemas'];

}
