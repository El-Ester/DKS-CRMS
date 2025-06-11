<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'item_id',
        'items_name',
        'created_at',
        'updated_at',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }
}
