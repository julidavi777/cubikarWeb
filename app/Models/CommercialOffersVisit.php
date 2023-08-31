<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffersVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_date',
        'visit_place',
        'person_attending',
        'phone_number_person_attending',
        'commercial_offer_id'
    ];

    protected $casts = [
        'visit_date' => 'datetime:Y-m-d H:m:s',
    ];
    
    public function commercial_offer()
    {
        return $this->belongsTo(CommercialOffer::class);
    }
}
