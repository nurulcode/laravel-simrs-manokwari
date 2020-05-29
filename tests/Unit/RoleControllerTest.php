<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Collection;

class RoleTest extends TestCase
{
    /** @test */
    public function a_role_has_many_permission()
    {
        $role        = factory(Role::class)->create();
        $permissions = factory(Permission::class, 10)->create();

        $role->permissions()->sync(
            $permissions->map(function ($value) {
                return $value->id;
            })->toArray()
        );

        $this->assertInstanceOf(Collection::class, $role->permissions);

        $this->assertEquals($role->permissions->count(), 10);

        $this->assertInstanceOf(Permission::class, $role->permissions->random());
    }
}
