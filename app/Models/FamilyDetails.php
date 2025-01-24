<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'relation',
        'name',
        'ic_no',
        'd_o_b',
        'age',
        'occupation_or_education',
        'address',
        'date_of_demise'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
