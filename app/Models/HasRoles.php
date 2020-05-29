<?php

namespace App\Models;

use App\Events\RoleAssigned;
use Illuminate\Support\Collection;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoleAttribute()
    {
        if ($this->roles->isNotEmpty()) {
            return $this->roles->first();
        }

        return new Role(['name' => 'norole', 'description' => 'Have no role']);
    }

    public function giveRoleAs($role)
    {
        if (!$role instanceof Role) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role->id);
    }

    public function assignRoles($roles)
    {
        $this->roles()->sync(
            Collection::wrap($roles)->map(function ($role) {
                return $role['id'];
            })->values()
        );

        event(new RoleAssigned($this));
    }

    public function hasRole($role)
    {
        if ($role instanceof Role) {
            $role = $role->name;
        }

        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return $role->intersect($this->roles)->isNotEmpty();
    }

    public function hasPermission($permission)
    {
        if (!$permission instanceof Permission) {
            $permission = Permission::where('name', $permission)->first();
        }

        if ($permission) {
            return $this->hasRole($permission->roles);
        }
    }

    public function isSuperAdmin()
    {
        return $this->id == 1;
    }
}
