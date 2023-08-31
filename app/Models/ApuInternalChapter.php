<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApuInternalChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];
}
