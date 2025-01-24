<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'name',
        'identity_card_no',
        'date_of_issue',
        'date_of_birth',
        'age',
        'place_of_birth',
        'gender',
        'marital_status',
        'race',
        'religion',
        'citizenship',
        'certificate_number',
        'driving_licence',
        'licence_class',
        'tel_house',
        'tel_mobile',
        'tel_fax',
        'email',
        'permanent_address_line1',
        'permanent_address_line2',
        'permanent_country',
        'permanent_province',
        'permanent_postal_code',
        'postal_address_line1',
        'postal_address_line2',
        'postal_country',
        'postal_province',
        'postal_postal_code'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
