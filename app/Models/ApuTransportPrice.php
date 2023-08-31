<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApuTransportPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'unit',
        'unit_price_eje_value',
        'unit_price_bogota_value',
        'unit_price_medellin_value',
        'status'
    ];
}
