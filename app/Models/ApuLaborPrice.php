<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApuLaborPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'unit',
        'unit_price_eje_value',
        'unit_price_bogota_value',
        'unit_price_medellin_value',
        'chapter_id',
        'status'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
