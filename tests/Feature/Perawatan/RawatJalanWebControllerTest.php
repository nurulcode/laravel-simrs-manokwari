<?php

namespace Tests\Feature\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Models\Perawatan\RawatJalan;

class RawatJalanWebControllerTest extends TestCase
{
    /** @test */
    public function create_page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('Perawatan\RawatJalanWebController@create'))
             ->assertRedirect('/login');

        $this->withExceptionHandling()
             ->get(action('Perawatan\RawatJalanWebController@index'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $resource   = factory(RawatJalan::class)->create();

        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $this
            // ->disableExceptionHandling()
            ->signIn($user)
            ->get(action('Perawatan\RawatJalanWebController@create'))
            ->assertStatus(403);

        $this
            // ->disableExceptionHandling()
            ->signIn($user)
            ->get(action('Perawatan\RawatJalanWebController@index'))
            ->assertStatus(403);

        $this
            // ->disableExceptionHandling()
            ->signIn($user)
            ->get(action('Perawatan\RawatJalanWebController@show', $resource->id))
            ->assertStatus(403);

        $this
            ->disableExceptionHandling()
            ->signIn($admin)
            ->get(action('Perawatan\RawatJalanWebController@create'))
            ->assertStatus(200);

        $this
            ->disableExceptionHandling()
            ->signIn($admin)
            ->get(action('Perawatan\RawatJalanWebController@index'))
            ->assertStatus(200);

        $this
            ->disableExceptionHandling()
            ->signIn($admin)
            ->get(action('Perawatan\RawatJalanWebController@show', $resource->id))
            ->assertStatus(200);
    }
}
