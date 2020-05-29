<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    use RecordsActivity;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['permissions'];

    /**
     * Scope a query to exclude superadmin.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNoSuper(Builder $builder)
    {
        return $builder->where('name', '<>', 'superadmin');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermsissionTo($permission)
    {
        $permissions = Collection::wrap($permission);

        $permissions->transform(function ($permission, $key) {
            if (!$permission instanceof Permission) {
                $permission = Permission::where('name', $permission)->firstOrFail();
            }

            return $permission;
        });

        $this->permissions()->syncWithoutDetaching(
            $permissions->pluck('id')->toArray()
        );
    }
}
