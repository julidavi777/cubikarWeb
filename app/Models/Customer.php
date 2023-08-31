<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification_type',
        'identification',
        'digit_v',
        'name',
        'surname',
        'phone_number',
        'address',
        'municipio_id',
        'departamento_id',
        'email',
        'nombre_contacto_comercial',
        'commercial_contact_1',
        'commercial_contact_2',
        'commercial_contact_3',
        'razon_social',
        'razon_comercial',
        'rut_file',
        'camara_commerce_file',
        'income_statement_file',
        'cliente_logo'
    ];

    protected $casts = [
        'rut_file' => 'array',
        'camara_commerce_file' => 'array',
        'income_statement_file' => 'array',
        'cliente_logo' => 'array'
    ];

    /**
     * Get the commercial offers for the customer.
     */
    public function commercialOffers()
    {
        return $this->hasMany(CommercialOffer::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }


    public function customersContacts()
    {
        return $this->hasMany(CustomersContact::class);
    }

}
