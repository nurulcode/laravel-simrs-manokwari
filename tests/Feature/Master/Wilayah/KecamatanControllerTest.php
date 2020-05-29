<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use App\Models\Master\Wilayah\Kecamatan;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\Wilayah\KotaKabupaten;

class KecamatanControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Wilayah\Kecamatan::class;
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'provinsi_id' => $resource->kota_kabupaten->provinsi_id,
        ]);
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, [
                'provinsi_id'       => str_random(5),
                'kota_kabupaten_id' => str_random(5)
            ])
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kota_kabupaten_id', 'provinsi_id'])
             ->assertStatus(422);
    }

    /** @test */
    public function resource_has_kota_kabupaten_in_collection_structure()
    {
        factory($this->resource(), 5)->create();

        $this->signIn()
             ->getJson(action('Master\Wilayah\KecamatanController@index'))
             ->assertJson(['data'  => []])
             ->assertJsonStructure(['data'  => ['*' => ['kota_kabupaten']]]);
    }

    /** @test */
    public function user_can_filter_collection_by_kotakabupaten()
    {
        $kotakab    = factory(KotaKabupaten::class)->create();
        $kecamatan  = factory(Kecamatan::class, 5)->create(['kota_kabupaten_id' => $kotakab->id]);
        $lainnya    = factory(Kecamatan::class, 5)->create();

        $controller = 'Master\Wilayah\KecamatanController@index';

        $this->signIn()
             ->getJson(action($controller) . '?kota_kabupaten=' . $kotakab->id)
             ->assertJsonStructure(['data'  => ['*' => ['name']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($kecamatan->random()->name)
             ->assertDontSee($lainnya->random()->name)
             ->assertStatus(200);
    }
}
