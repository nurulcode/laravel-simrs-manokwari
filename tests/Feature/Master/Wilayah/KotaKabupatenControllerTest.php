<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use App\Models\Master\Wilayah\Provinsi;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\Wilayah\KotaKabupaten;

class KotaKabupatenControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Wilayah\KotaKabupaten::class;
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, ['provinsi_id' => str_random(5)])
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['provinsi_id'])
             ->assertStatus(422);
    }

    /** @test */
    public function resource_has_provinsi_in_collection_structure()
    {
        factory($this->resource(), 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KotaKabupatenController@index'))
             ->assertJson(['data'  => []])
             ->assertJsonStructure(['data'  => ['*' => ['provinsi']]]);
    }

    /** @test */
    public function user_can_filter_collection_by_provinsi()
    {
        $provinsi   = factory(Provinsi::class)->create();
        $kotakabs   = factory(KotaKabupaten::class, 5)->create(['provinsi_id' => $provinsi->id]);
        $kotalain   = factory(KotaKabupaten::class, 5)->create();

        $controller = 'Master\Wilayah\KotaKabupatenController@index';

        $this->signIn()
            ->getJson(action($controller) . '?provinsi=' . $provinsi->id)
            ->assertJsonStructure(['data'  => ['*' => ['name', 'provinsi']]])
            ->assertJsonCount(5, 'data')
            ->assertSee($kotakabs->random()->name)
            ->assertDontSee($kotalain->random()->name)
            ->assertStatus(200);
    }
}
