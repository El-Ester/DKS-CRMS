<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $table = 'candidates';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone_number',
        'picture',
    ];

    // The attributes that should be hidden for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship with Job: A candidate can apply to many jobs (Assuming many-to-many relationship)

    // If a candidate can have one job, the relation will look like this
    // public function job()
    // {
    //     return $this->belongsTo(Job::class);  // Make sure the foreign key is set up correctly
    // }

    // If you want to get the job related to this candidate, this is one way to do it
    public function latestJob()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    // Method to get the candidate's full name
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function showProfile(Request $request)
    {
        // Fetch the candidate by username (adjust the query if needed)
        $candidate = Candidate::where('username', $request->query('name'))->first();

        // Check if the candidate exists and pass the data to the view
        if (!$candidate) {
            // If no candidate is found, return an error message or a default value
            return view('candidate.profile', ['candidate' => null]);
        }

        return view('candidate.profile', compact('candidate'));
    }

    // Candidate.php
    public function appliedJobs()
    {
        return $this->hasMany(JobApplication::class);
    }


    public function viewAppliedJobs()
    {
        $candidate = Auth::guard('candidate')->user();

        $appliedJobs = JobApplication::with('job')
            ->where('candidate_id', $candidate->id)
            ->get();

        return view('candidate.applied_jobs', compact('appliedJobs'));
    }


    public function applications()
    {
        return $this->hasMany(Application::class, 'candidate_id');
    }

    public function job()
    {
        return $this->belongsToMany(Job::class, 'candidate_job')->withTimestamps();
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function personalDetails()
    {
        return $this->hasOne(PersonalDetail::class, 'candidate_id');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }

    public function previousEmployments()
    {
        return $this->hasMany(PreviousEmployments::class);
    }

    public function currentEmployment()
    {
        return $this->hasOne(CurrentEmployment::class); // or hasMany if multiple
    }

    public function familyDetails()
    {
        return $this->hasOne(FamilyDetails::class);
    }

    public function schoolQualifications()
    {
        return $this->hasMany(SchoolQualification::class);
    }

    public function higherEducationQualifications()
    {
        return $this->hasMany(HigherEducationQualification::class);
    }
}
