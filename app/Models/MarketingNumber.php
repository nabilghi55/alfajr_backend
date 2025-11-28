<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingNumber extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'duration_hours',
        'rotation_order'
    ];
}
