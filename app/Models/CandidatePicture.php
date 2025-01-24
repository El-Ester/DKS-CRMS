<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatePicture extends Model
{
    use HasFactory;

    protected $table = 'candidate_pictures';

    protected $fillable = [
        'candidate_id',
        'picture',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
