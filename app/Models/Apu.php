<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apu extends Model
{
    use HasFactory;

    protected $fillable = [
        "schema",
        "apu_activity_id"
    ];

    public function apuActivity()
    {
        return $this->belongsTo(ApuActivity::class);
    }
}
