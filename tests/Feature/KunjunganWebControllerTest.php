<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kunjungan;

class KunjunganWebControllerTest extends TestCase
{
    /** @test */
    public function page_not_accessible_for_guest()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->withExceptionHandling()
             ->get(action('KunjunganWebController@show', $kunjungan))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->disableExceptionHandling()
             ->signIn()
             ->get(action('KunjunganWebController@show', $kunjungan))
             ->assertStatus(200);
    }
}
