<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'telephone_number',
        'telephone_number_ext',
        'email',
        'departamento_id',
        'municipio_id',
        'customers_contact_type_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function customersContactType()
    {
        return $this->belongsTo(CustomersContactType::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}
