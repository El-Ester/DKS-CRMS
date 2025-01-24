<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable = [
        // Previous Employment
        'post_name', 'employer_name', 'employer_address', 'commencement_date', 'termination_date',
        'employment_nature', 'reasons_for_leaving',

        // Current Employment
        'current_post_name', 'organisation_type', 'current_employer_name', 'current_employer_address',
        'current_commencement_date', 'current_employment_nature', 'monthly_salary', 'allowance',

        // Applied Posts
        'applied_for_post', 'date_of_appointment', 'result',
    ];
}
