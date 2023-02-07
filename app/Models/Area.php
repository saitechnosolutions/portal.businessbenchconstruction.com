<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;


    protected $fillable = ["district_name", "district_code", "taluk_name", "taluk_code"];
}
