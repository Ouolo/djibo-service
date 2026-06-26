<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        if ($this->is_admin) {
            return true;
        }

        return $this->role && in_array($this->role->slug, ['admin', 'superadmin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role && $this->role->slug === 'superadmin';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Permissions supplémentaires directement attribuées à l'utilisateur.
     */
    public function extraPermissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permission', 'user_id', 'permission_id')
            ->withTimestamps();
    }

    /**
     * Toutes les permissions effectives (rôle + permissions individuelles).
     */
    public function allPermissions()
    {
        $rolePermissions = $this->role ? $this->role->permissions()->pluck('slug')->toArray() : [];
        $extraPermissions = $this->extraPermissions()->pluck('slug')->toArray();
        return array_unique(array_merge($rolePermissions, $extraPermissions));
    }

    public function hasPermission($permissionSlug): bool
    {
        // SuperAdmin a tout
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Permission via le rôle
        if ($this->role && $this->role->hasPermission($permissionSlug)) {
            return true;
        }

        // Permission individuelle supplémentaire
        return $this->extraPermissions()->where('slug', $permissionSlug)->exists();
    }

    public function hasAnyPermission(array $permissionSlugs): bool
    {
        foreach ($permissionSlugs as $slug) {
            if ($this->hasPermission($slug)) {
                return true;
            }
        }
        return false;
    }

    public function hasAllPermissions(array $permissionSlugs): bool
    {
        foreach ($permissionSlugs as $slug) {
            if (!$this->hasPermission($slug)) {
                return false;
            }
        }
        return true;
    }
}
