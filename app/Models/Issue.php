<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $primaryKey = 'issue_id'; // specify custom PK
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = [
        'issue_number',
        'issue_date',
        'customer_name',
        'company',
        'contact_no',
        'customer_email',
        'problem_statement',
        'problem_verification',
        'repair_cost',
        'work_description',
        'diagnostic_date',
        'completion_date',
        'created_date',
        'created_by_username',
        'modified_date',
        'modified_by_username',
        'is_suspended',
        'status_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'issue_id', 'issue_id');
    }

    protected $casts = [
        'issue_date' => 'date',
        'diagnostic_date' => 'date',
        'completion_date' => 'date',
    ];

}
