<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use App\Models\Role;
use App\Models\Permission;
use Sty\Tests\APITestCase;

class RolePermissionControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_assign_permission_to_new_role()
    {
        $permissions = factory(Permission::class, 5)->create();
        $resource    = factory(Role::class)->make();

        $this->signIn()
             ->postJson($resource->path('store'), array_merge(
                $resource->toArray(), ['permissions' => $permissions]
             ))
             ->assertJson(['status' => 'success'])
             ->assertStatus(201);

        $this->assertDatabaseHas($resource->getTable(), $resource->getAttributes());

        $role = Role::where('name', $resource->name)->firstOrFail();

        $this->assertDatabaseHas('permission_role', [
            'role_id'       => $role->id,
            'permission_id' => $permissions->random()->id
        ]);
    }

    /** @test */
    public function user_can_assign_permission_to_existing_role()
    {
        $permissions = factory(Permission::class, 5)->create();
        $resource    = factory(Role::class)->create();

        $this->signIn()
             ->putJson($resource->path, array_merge(
                $resource->toArray(), ['permissions' => $permissions]
             ))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseHas($resource->getTable(), $resource->getAttributes());

        $role = Role::where('name', $resource->name)->firstOrFail();

        $this->assertDatabaseHas('permission_role', [
            'role_id'       => $role->id,
            'permission_id' => $permissions->random()->id
        ]);
    }

    /** @test */
    public function role_has_permissions_in_resource_collection()
    {
        $permissions = factory(Permission::class, 5)->create();
        $resource    = factory(Role::class)->create();

        $resource->permissions()->sync(
            $permissions->map(function ($value) {
                return $value->id;
            })->toArray()
        );

        $this->signIn()
             ->getJson($resource->path('index'))
             ->assertJson(['data' => []])
             ->assertJsonStructure([
                'data'  => ['*' => ['path', 'permissions']]
              ])
             ->assertStatus(200);
    }
}
