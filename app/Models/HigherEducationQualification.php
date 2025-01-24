<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HigherEducationQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'qualification_type',
        'university_name',
        'university_country',
        'certificate_name',
        'certificate_date',
        'overall_result',
        'moe_accreditation',
    ];

    // Relationship with Candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class); // Assuming you have a Course model
    }

}
