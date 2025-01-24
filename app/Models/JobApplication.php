<?php

// app/Models/JobApplication.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'job_id',
        'application_status',
    ];


    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}

