<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stagemaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'stageid',
        'stagename',
        'description'
    ];
}
