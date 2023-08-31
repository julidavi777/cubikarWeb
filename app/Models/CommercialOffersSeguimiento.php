<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffersSeguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'commercial_offer_id',
        'probability'
    ];

    
    protected $casts = [
        
        'created_at' => 'datetime:Y-m-d H:m:s'
        
    ];

    public function commercial_offer()
    {
        return $this->belongsTo(CommercialOffer::class);
    }
    
    public function commercial_offers_seguimiento_files()
    {
        return $this->hasMany(CommercialOffersSeguimientoFile::class);
    }
}
