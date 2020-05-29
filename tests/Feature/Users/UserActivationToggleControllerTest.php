<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use Sty\Tests\APITestCase;

class UserActivationToggleControllerTest extends TestCase
{
    use APITestCase;

    /** @test **/
    public function admin_can_toggle_user_activation()
    {
        $admin    = $this->createAdmin();
        $resource = factory(User::class)->create(['active' => false]);

        $this->withExceptionHandling()
             ->signIn($admin);

        $this->putJson(action('UserActivationToggleController', ['id' => $resource->id]))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseHas($resource->getTable(), [
            'id'       => $resource->id,
            'username' => $resource->username,
            'active'   => true
        ]);
    }

    /** @test **/
    public function can_not_deactivate_super_admin()
    {
        $admin    = $this->createAdmin();

        $user     = $this->createUser();

        $this->signIn($user)
             ->putJson(action('UserActivationToggleController', ['id' => $admin->id]))
             ->assertStatus(403);
    }
}
