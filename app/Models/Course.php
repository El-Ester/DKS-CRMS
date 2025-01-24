<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'higher_education_qualification_id',
        'course_name',
        'course_result',
    ];
    
    public function higherEducationQualification()
    {
        return $this->belongsTo(HigherEducationQualification::class);
    }
}

