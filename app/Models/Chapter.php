<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['sequential', 'name'];

    public function apuActivities()
    {
        return $this->hasMany(ApuActivity::class);
    }

    public function apuMaterials()
    {
        return $this->hasMany(ApuMaterial::class);
    }

    public function apuLaborPrices()
    {
        return $this->hasMany(ApuLaborPrice::class);
    }
}
