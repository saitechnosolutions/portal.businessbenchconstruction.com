<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uploadedestimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'stageid',
        'stagename',
        'descriptions',
        'quantity',
        'unit',
        'rate',
        'amount',
        // 'rentention_amount',
        // 'amount_released',
        'clientid',
        'engid',
        'clientdescription',
        'clientpercentage',
        'clientestimateamt',
        'paymentsplit',
        'dueamount',
        'stagetotamt',
    ];
}
