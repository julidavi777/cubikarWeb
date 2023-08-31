<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApuTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'unit',
        'unit_value',
        'reference_link',
        'status'
    ];
}
