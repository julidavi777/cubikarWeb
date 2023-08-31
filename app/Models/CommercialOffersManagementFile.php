<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffersManagementFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'status',
        'commercial_offers_management_id',
    ];

    public function commercial_offers_management()
    {
        return $this->belongsTo(CommercialOffersManagement::class);
    }

    protected $casts = [
        'file' => 'array',
    ];

}
