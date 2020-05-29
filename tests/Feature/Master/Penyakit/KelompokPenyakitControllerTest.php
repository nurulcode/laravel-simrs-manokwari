<?php

namespace Tests\Feature\Master\Penyakit;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class KelompokPenyakitControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Master\Penyakit\KelompokPenyakit::class;
    }

    /** @test **/
    public function user_cannot_create_with_invalid_data()
    {
        $this->signIn();

        $resource = factory($this->resource())->make([
            'klasifikasi_id' => str_random(99),
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['klasifikasi_id'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_cannot_create_duplicate_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode,
            'icd'  => $existing->icd,
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kode', 'icd'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_update_with_same_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'kode' => $existing->kode,
            'icd'  => $existing->icd,
        ]);

        $this->putJson($existing->path, $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);
    }

    /** @test */
    public function user_can_filter_collection_by_klasifikasi()
    {
        $klasifikasi = factory(KlasifikasiPenyakit::class)->create();
        $kelompok    = factory(KelompokPenyakit::class, 5)->create([
            'klasifikasi_id' => $klasifikasi->id
        ]);

        $lainnya     = factory(KelompokPenyakit::class, 5)->create();
        $controller  = 'Master\Penyakit\KelompokPenyakitController@index';

        $this->signIn()
             ->getJson(action($controller) . '?klasifikasi=' . $klasifikasi->id)
             ->assertJsonStructure(['data'  => ['*' => ['uraian']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($kelompok->random()->uraian)
             ->assertDontSee($lainnya->random()->uraian)
             ->assertStatus(200);
    }
}
