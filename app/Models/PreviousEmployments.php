<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousEmployments extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'post_name',
        'employer_name',
        'employer_address',
        'commencement_date',
        'termination_date',
        'employment_nature',
        'reasons_for_leaving',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
