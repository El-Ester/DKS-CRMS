<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'payment_amount',
        'payment_type',
        'working_period',
        'education',
        'skills',
        'experience',
        'document_required',
        'open_date',
        'close_date',
        'edited_at',
        'edited_by',
        'status',
    ];

    // Ensure your model casts the date attributes
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'edited_at' => 'datetime', // If you have an edited_at column
    ];

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id'); // Assuming 'editor_id' is the foreign key column
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }


}
