<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_title',
        'role_description',
        'created_date',
        'created_by_username',
        'modified_date',
        'modified_by_username',
        'is_suspended',
    ];
    

    public function users()
    {
        return $this->hasMany(User::class, 'user_role', 'role_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
}
