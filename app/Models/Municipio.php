<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function customersContacts()
    {
        return $this->hasMany(CustomersContact::class);
    }
}
