<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /** @test */
    public function page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get('/')
             ->assertRedirect('/login');

        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $this->disableExceptionHandling()
             ->signIn($admin)
             ->get('/')
             ->assertStatus(200);
    }
}
