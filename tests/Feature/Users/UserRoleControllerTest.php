<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Sty\Tests\APITestCase;

class UserRoleControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_assign_role_to_new_user()
    {
        $roles    = factory(Role::class, 5)->create();
        $resource = factory(User::class)->make();
        $password = str_random(99);

        $this->signIn()
             ->postJson($resource->path('store'), array_merge(
                $resource->toArray(), [
                    'password'              => $password,
                    'password_confirmation' => $password,
                    'roles'                 => $roles
                ]
             ))
             ->assertJson(['status' => 'success'])
             ->assertStatus(201);

        $this->assertDatabaseHas($resource->getTable(), [
            'username' => $resource->username,
            'name'     => $resource->name,
            'email'    => $resource->email,
        ]);

        $user = User::where('username', $resource->username)->firstOrFail();

        $this->assertDatabaseHas('role_user', [
            'user_id' => $user->id,
            'role_id' => $roles->random()->id
        ]);
    }

    /** @test */
    public function user_can_assign_role_to_existing_user()
    {
        $administrator = factory(User::class)->create();
        $roles         = factory(Role::class, 5)->create();
        $resource      = factory(User::class)->create();

        $password = str_random(99);

        $this->signIn($administrator)
             ->putJson($resource->path, array_merge(
                $resource->toArray(), [
                    'password'              => $password,
                    'password_confirmation' => $password,
                    'roles'                 => $roles
                ]
             ))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseHas('role_user', [
            'user_id' => $resource->id,
            'role_id' => $roles->random()->id
        ]);
    }

    /** @test */
    public function user_cannot_assign_invalid_role_to_user()
    {
        $resource = factory(User::class)->make();
        $role     = factory(Role::class)->create();

        $password = str_random(99);

        $this->signIn()
             ->postJson($resource->path('store'), array_merge(
                $resource->toArray(), [
                    'password'              => $password,
                    'password_confirmation' => $password,
                    'roles'                 => [
                        ['id'=> str_random(10), 'name' => str_random(10)],
                        ['id'=> str_random(10), 'name' => str_random(10)],
                        ['id'=> $role->id,      'name' => $role->name],
                    ],
                ]
             ))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['roles'])
             ->assertStatus(422);
    }

    /** @test */
    public function user_cannot_assign_superadmin_to_new_user()
    {
        $resource   = factory(User::class)->make();
        $superadmin = factory(Role::class)->create(['name' => 'superadmin']);
        $noadmin    = factory(Role::class)->create(['name' => 'noadmin']);

        $password = str_random(99);

        $this->signIn()
             ->postJson($resource->path('store'), array_merge(
                $resource->toArray(), [
                    'password'              => $password,
                    'password_confirmation' => $password,
                    'roles'                 => [$noadmin, $superadmin, $noadmin],
                ]
             ))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['roles'])
             ->assertStatus(422);
    }

    /** @test **/
    public function can_not_delete_super_admin()
    {
        $user = $this->createAdmin();

        $this
             ->signIn($user)
             ->deleteJson($user->path)
             ->assertStatus(403);
    }

    /** @test **/
    public function can_not_edit_super_admin()
    {
        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $this->signIn($user)
             ->putJson($admin->path, [
                'username' => 'username_baru',
                'name'     => 'nama baru',
                'email'    => 'emailbaru@me.com',
             ])
             ->assertStatus(403);
    }
}
