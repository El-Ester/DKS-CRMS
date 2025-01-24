<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['training_type', 'training_name', 'date', 'organiser', 'candidate_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
