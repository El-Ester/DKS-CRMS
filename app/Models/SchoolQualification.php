<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'school_qualification',
        'certificate_title',
        'school_college_name',
        'certificate_date',
        'college_result',
        'bahasa_melayu_result',
        'english_result',
        'mathematics_result',
        'other_subjects',
        'subjects_result',
        'moe_accreditation',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

}
