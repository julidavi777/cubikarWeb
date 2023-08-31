<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersContactType extends Model
{
    use HasFactory;

    public function customersContactType()
    {
        return $this->hasMany(CustomersContact::class);
    }
}
