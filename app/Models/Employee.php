<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'email',
        'phone_number',
        'kpi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}

// use App\Models\Employee;

// Employee::create([
//     'first_name' => 'Qwerty',
//     'last_name' => 'Doe',
//     'position' => 'Software Engineer',
//     'email' => 'qwert@example.com',
//     'phone_number' => '1234567890',
//     'kpi' => 80.5, // Example KPI
// ]);
