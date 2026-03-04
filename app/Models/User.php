<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role_id', 'avatar', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    /**
     * Many-to-many role mapping (primary RBAC source).
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    /**
     * Legacy single role mapping for backward compatibility.
     */
    public function primaryRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($roleName)
    {
        $roleNames = is_array($roleName) ? $roleName : [$roleName];

        if ($this->roles()->whereIn('name', $roleNames)->exists()) {
            return true;
        }

        return $this->primaryRole()->whereIn('name', $roleNames)->exists();
    }

    /**
     * Check if user has a specific permission (via role).
     */
    public function hasPermission($permissionName)
    {
        if ($this->hasRole('super_admin')) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role->hasPermission($permissionName)) {
                return true;
            }
        }

        $legacyRole = $this->primaryRole;
        if ($legacyRole && $legacyRole->hasPermission($permissionName)) {
            return true;
        }

        return false;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function getRoleNameAttribute()
    {
        $role = $this->roles->first() ?: $this->primaryRole;
        return $role ? $role->display_name : 'No Role';
    }
}
