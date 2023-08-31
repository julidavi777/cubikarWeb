<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApuActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'cap',
        'description',
        'unit',
        'quantity',
        'unit_value',
        'customer_id',
        'chapter_id',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function apu()
    {
        return $this->hasOne(Apu::class);
    }
}
