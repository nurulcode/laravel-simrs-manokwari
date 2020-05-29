<?php

namespace Sty\Tests;

use Illuminate\Auth\Access\AuthorizationException;

trait ResourceViewTestCase
{
    abstract public function viewpath();

    /** @test */
    public function page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
            ->get($this->viewpath())
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $this->disableExceptionHandling();

        $this
            ->signIn($admin)
            ->get($this->viewpath())
            ->assertStatus(200);

        $this->expectException(AuthorizationException::class);

        $this->signIn($user)->get($this->viewpath());
    }
}
