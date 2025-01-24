<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'occupation', 'years_known', 'relation',
        'address_line1', 'address_line2', 'address_line3', 'country',
        'province', 'postal_code', 'telephone', 'fax', 'email', 'candidate_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
