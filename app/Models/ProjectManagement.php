<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectManagement extends Model
{
    use HasFactory;

    protected $table = 'project_managements';

    protected $fillable = [
        "gantt_schema",
        "commercial_offer_id"
    ];

    public function commercial_offer()
    {
        return $this->hasMany(CommercialOffer::class);
    }

}
