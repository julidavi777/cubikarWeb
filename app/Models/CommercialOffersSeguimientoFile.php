<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffersSeguimientoFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'status',
        'commercial_offers_seguimiento_id',
    ];

    public function commercial_offers_seguimiento()
    {
        return $this->belongsTo(CommercialOffersSeguimiento::class);
    }

    protected $casts = [
        'file' => 'array',
    ];

}
