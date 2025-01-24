<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrdHiring extends Model
{
    protected $table = 'hrd_manage_hiring';
    protected $fillable = [
        'title', 'description', 'payment_amount', 'payment_type',
        'working_period', 'min_requirements',
        'document_required', 'open_date', 'close_date', 'status',
    ];
}

class JppstmHiring extends Model
{
    protected $table = 'jppstm_manage_hiring';
    protected $fillable = [
        'title', 'description', 'payment_amount', 'payment_type',
        'working_period', 'min_requirements',
        'document_required', 'open_date', 'close_date', 'status',
    ];
}
