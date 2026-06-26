<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id')
            ->withTimestamps()
            ->select('permissions.*');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission($permissionSlug)
    {
        return $this->permissions()
            ->where('permissions.slug', $permissionSlug)
            ->exists();
    }

    public function hasAnyPermission(array $permissionSlugs)
    {
        return $this->permissions()
            ->whereIn('permissions.slug', $permissionSlugs)
            ->exists();
    }

    public function hasAllPermissions(array $permissionSlugs)
    {
        return $this->permissions()
            ->whereIn('permissions.slug', $permissionSlugs)
            ->count() === count($permissionSlugs);
    }
}

