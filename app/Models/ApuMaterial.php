<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApuMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'unit',
        'unit_value',
        'reference_link',
        'chapter_id',
        'status'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
