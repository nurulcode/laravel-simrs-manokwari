<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KualifikasiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Kepegawaian\Kualifikasi::class;
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'kategori_id' => str_random(5),
            'laki_laki'   => str_random(5),
            'perempuan'   => str_random(5)
        ]);

        $this->signIn()
             ->postJson($resource->path, $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['kategori_id', 'laki_laki', 'perempuan'])
             ->assertStatus(422);
    }

    /** @test */
    public function user_can_filter_collection_by_kategori()
    {
        $kategori = factory(KategoriKualifikasi::class)->create();

        factory($this->resource(), 5)->create(['kategori_id' => $kategori->id]);

        factory($this->resource(), 5)->create();

        $controller = 'Kepegawaian\KualifikasiController@index';

        $this->signIn()
             ->getJson(action($controller) . '?kategori=' . $kategori->id)
             ->assertJson(['data' => []])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
