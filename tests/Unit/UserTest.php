<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_has_many_role()
    {
        $user  = factory(User::class)->create();
        $roles = factory(Role::class, 10)->create();

        $user->roles()->sync(
            $roles->map(function ($value) {
                return $value->id;
            })->toArray()
        );

        $this->assertInstanceOf(Collection::class, $user->roles);

        $this->assertEquals($user->roles->count(), 10);

        $this->assertInstanceOf(Role::class, $user->roles->random());
    }
}
