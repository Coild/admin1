<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aturan extends Model
{
    use HasFactory;

    protected $primaryKey = 'aturan_id';
    protected $guarded = ['aturan_id'];

}
