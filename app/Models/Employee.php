<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'id_card',
        'type_id',
        'address',
        'phone',
        'email',
        'position',
        'cv_file',
        'medical_exam_file',
        'followup_letter_file',
        'history_file',
        'study_stands_file',
        'id_card_file',
        'work_certificate_file',
        'military_passbook_file',
        'exam_expiration',
        'contract_expiration'
    ];

    protected $dates = ['contracts_expires_at','medical_expires_at'];
    protected $dateFormat = 'Y-m-d';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
