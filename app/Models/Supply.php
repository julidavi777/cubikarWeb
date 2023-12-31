<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'code',
        'description',
        'type',
        'unidad',
        'value',
    ];

    protected $dates = ['deleted_at'];
}
