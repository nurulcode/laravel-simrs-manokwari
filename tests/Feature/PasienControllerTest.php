<?php

namespace Tests\Feature;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class PasienControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Pasien::class;
    }

    public function viewpath()
    {
        return url('pasien');
    }

    public function matchDatabase($resource)
    {
        return array_except($resource->getAttributes(), 'tanggal_registrasi');
    }

    /** @test **/
    public function user_cannot_create_duplicate_no_rekam_medis()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->create();

        $resource->no_rekam_medis = $existing->no_rekam_medis;

        $this->putJson($resource->path, $this->beforePut($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['no_rekam_medis'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'jenis_identitas_id' => str_random(9),
            'jenis_kelamin'      => str_random(9),
            'agama_id'           => str_random(9),
            'suku_id'            => str_random(9),
            'pendidikan_id'      => str_random(9),
            'pekerjaan_id'       => str_random(9),
            'kelurahan_id'       => str_random(9),
            'status_pernikahan'  => str_random(9),
        ]);

        $this->signIn()
             ->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors([
                'jenis_identitas_id',
                'jenis_kelamin',
                'agama_id',
                'suku_id',
                'pendidikan_id',
                'pekerjaan_id',
                'kelurahan_id',
                'status_pernikahan',
             ])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_not_put_invalid_data()
    {
        $existing = factory($this->resource())->create();

        $resource = factory($this->resource())->make([
            'jenis_identitas_id' => str_random(9),
            'jenis_kelamin'      => str_random(9),
            'agama_id'           => str_random(9),
            'suku_id'            => str_random(9),
            'pendidikan_id'      => str_random(9),
            'pekerjaan_id'       => str_random(9),
            'kelurahan_id'       => str_random(9),
            'status_pernikahan'  => str_random(9),
        ]);

        $this->signIn()
             ->putJson($existing->path, $this->beforePut($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors([
                'jenis_identitas_id',
                'jenis_kelamin',
                'agama_id',
                'suku_id',
                'pendidikan_id',
                'pekerjaan_id',
                'kelurahan_id',
                'status_pernikahan',
             ])
             ->assertStatus(422);
    }
}
