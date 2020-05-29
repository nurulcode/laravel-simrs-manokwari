<?php

namespace App;

use App\Models\Role;

class RoleRegistration
{
    public static function create($request_data)
    {
        $role = Role::create(array_except($request_data, 'permissions'));

        return self::assignPermissions($role, array_get($request_data, 'permissions'));
    }

    protected static function assignPermissions(Role $role, $permissions)
    {
        $role->permissions()->sync(
            collect($permissions)->map(function ($permission) {
                return $permission['id'];
            })->values()
        );

        return $role->load('permissions');
    }

    public static function update(Role $role, $request_data)
    {
        $role->update(array_except($request_data, 'permissions'));

        return self::assignPermissions($role, array_get($request_data, 'permissions'));
    }
}
