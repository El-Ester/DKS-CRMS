<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentEmployment extends Model
{
    use HasFactory;

    protected $fillable =[
        'candidate_id',
        'post_name',
        'organisation_type',
        'employer_name',
        'employer_address',
        'commencement_date',
        'employment_nature',
        'monthly_salary',
        'allowance'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
