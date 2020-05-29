<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Poliklinik;
use Sty\Tests\ResourceControllerTestCase;
use Tests\Feature\TarifableTestCase;

class RuanganControllerTest extends TestCase
{
    use ResourceControllerTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Fasilitas\Ruangan::class;
    }

    /** @test **/
    public function user_cannot_create_duplicate_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kode'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_update_with_same_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode
        ]);

        $this->putJson($existing->path, $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'poliklinik_id' => str_random(9),
            'kelas'         => str_random(9),
            'jenis'         => str_random(9)
        ]);

        $this->signIn()
             ->postJson($resource->path, $resource->toArray())
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['jenis', 'kelas', 'poliklinik_id'])
             ->assertStatus(422);
    }

    /** @test */
    public function user_can_filter_collection_by_poliklinik()
    {
        $poliklinik = factory(Poliklinik::class)->create();

        factory($this->resource(), 5)->create(['poliklinik_id' => $poliklinik->id]);

        factory($this->resource(), 5)->create();

        $controller = 'Fasilitas\RuanganController@index';

        $this->signIn()
            ->getJson(action($controller) . '?poliklinik=' . $poliklinik->id)
            ->assertJsonStructure(['data'  => ['*' => ['nama']]])
            ->assertJsonCount(5, 'data')
            ->assertStatus(200);
    }
}
