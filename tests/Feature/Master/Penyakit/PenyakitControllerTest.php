<?php

namespace Tests\Feature\Master\Penyakit;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use App\Models\Master\Penyakit\Penyakit;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\Penyakit\KelompokPenyakit;

class PenyakitControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\Penyakit\Penyakit::class;
    }

    public function viewpath()
    {
        return url('master/penyakit');
    }

    /** @test **/
    public function user_cannot_create_with_invalid_data()
    {
        $this->signIn();

        $resource = factory($this->resource())->make([
            'klasifikasi_id' => str_random(99),
            'kelompok_id'    => str_random(99),
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kelompok_id', 'klasifikasi_id'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_cannot_create_duplicate_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();

        $resource = factory($this->resource())->make([
            'icd'  => $existing->icd,
        ]);

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['icd'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_update_with_same_data()
    {
        $this->signIn();

        $existing = factory($this->resource())->create();

        $resource = factory($this->resource())->make([
            'icd'  => $existing->icd,
        ]);

        $this->putJson($existing->path, $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);
    }

    /** @test */
    public function user_can_filter_collection_by_kelompok()
    {
        $kelompok = factory(KelompokPenyakit::class)->create();

        $penyakit = factory($this->resource(), 5)->create([
            'kelompok_id' => $kelompok->id
        ]);

        $lainnya     = factory(Penyakit::class, 5)->create();

        $controller  = 'Master\Penyakit\PenyakitController@index';

        $this->signIn()
             ->getJson(action($controller) . '?kelompok=' . $kelompok->id)
             ->assertJsonStructure(['data'  => ['*' => ['uraian']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($penyakit->random()->uraian)
             ->assertDontSee($lainnya->random()->uraian)
             ->assertStatus(200);
    }
}
