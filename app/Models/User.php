<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Role;
use App\Models\Issue;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPassword;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'user_full_name',
        'user_email',
        'user_password',
        'user_role',
        'last_login',
        'created_date',
        'created_by_username',
        'modified_date',
        'modified_by_username',
        'is_suspended',
    ];

    protected $hidden = [
        'user_password',
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getEmailForPasswordReset()
    {
        return $this->user_email;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'user_role', 'role_id');
    }

    public function hasRole($roleName)
    {
        return strtolower($this->role->role_title) === strtolower($roleName);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'user_id', 'user_id');
    }

    public function getAuthIdentifierName()
    {
        return 'user_email';
    }

    public function getEmailAttribute()
    {
        return $this->user_email;
    }

}
