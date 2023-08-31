<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sede',
        'sequential_number',
        'contract_type',
        'contract_type_other',
        'service_type',
        'service_type_other',
        'sector_productivo',
        'sector_productivo_other',
        'object_description',
        'numero',
        'cuantia',
        'location',
        'release_date',
        'delivery_date',
        //'visit_date',
        'observations',
        'anexos',
        'customer_id',
        'responsable_id', 
        'responsable_operativo_id'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'customer_id',
        'responsable_id',
    ];

    protected $casts = [
        'anexos' => 'array',
        'camara_commerce_file' => 'array',
        'income_statement_file' => 'array',
        'cliente_logo' => 'array',
        
        'release_date' => 'datetime:Y-m-d H:m:s',
        'delivery_date' => 'datetime:Y-m-d H:m:s',
        //'visit_date' => 'datetime:Y-m-d H:m:s',
        'created_at' => 'datetime:Y-m-d H:m:s'

    ];

    /**
     * Get the post that owns the comment.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function responsableRel()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function comercial_offer_visit()
    {
        return $this->hasOne(CommercialOffersVisit::class);
    }

    public function commercial_offers_management()
    {
        return $this->hasOne(CommercialOffersManagement::class);
    }


    public function commercial_offers_contizations()
    {
        return $this->hasMany(CommercialOffersCotization::class)->orderByDesc('id');
    }

    
    public function commercial_offers_seguimientos()
    {
        return $this->hasMany(CommercialOffersSeguimiento::class)->orderByDesc('id');
    }

    public function project_management()
    {
        return $this->hasOne(ProjectManagement::class);
    }

    /**

    * The attributes that should be mutated to dates.

    * @var array

    */

    //protected $dates = ['deleted_at', 'date'];
}
