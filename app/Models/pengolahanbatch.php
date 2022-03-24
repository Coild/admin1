<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengolahanbatch extends Model
{
    use HasFactory;
    protected $primaryKey = 'nomor_batch';
    public $timestamps = true;
    protected $fillable = [
        'status',
    ];
}
