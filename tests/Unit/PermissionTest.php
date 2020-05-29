<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Collection;

class PermissionTest extends TestCase
{
    /** @test */
    public function a_permission_has_many_role()
    {
        $permission = factory(Permission::class)->create();
        $roles      = factory(Role::class, 10)->create();

        $permission->roles()->sync(
            $roles->map(function ($value) {
                return $value->id;
            })->toArray()
        );

        $this->assertInstanceOf(Collection::class, $permission->roles);

        $this->assertEquals($permission->roles->count(), 10);

        $this->assertInstanceOf(Role::class, $permission->roles->random());
    }
}
