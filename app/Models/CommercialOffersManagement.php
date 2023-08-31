<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffersManagement extends Model
{
    use HasFactory;

    protected $table = 'commercial_offers_managements';

    protected $fillable = [
        'requirements_determination',
        'current_status',
        'requirements_verification',
        'commercial_offer_id'
    ];

    public function commercial_offer()
    {
        return $this->belongsTo(CommercialOffer::class, 'commercial_offer_id');
    }

    public function commercial_offers_management_files()
    {
        return $this->hasMany(CommercialOffersManagementFile::class);
    }
}
