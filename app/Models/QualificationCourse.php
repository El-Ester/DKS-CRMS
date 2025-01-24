<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'higher_education_qualification_id',
        'course_taken',
        'course_result',
    ];

    // Relationship with HigherEducationQualification
    public function higherEducationQualification()
    {
        return $this->belongsTo(HigherEducationQualification::class);
    }

        // Relationship with Candidate
        public function candidate()
        {
            return $this->belongsTo(Candidate::class);
        }
}
