<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffersCotization extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_cotizado',
        'observaciones',
        'cotizacion_file',
        'commercial_offer_id',
    ];

    protected $casts = [
        'cotizacion_file' => 'array',
    ];

        
    public function commercial_offer()
    {
        return $this->belongsTo(CommercialOffer::class);
    }

    



}
