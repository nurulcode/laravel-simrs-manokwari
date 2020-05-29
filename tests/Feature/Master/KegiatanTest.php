<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use App\Models\Master\Kegiatan;
use App\Models\Master\KategoriKegiatan;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;
use Tests\Feature\TarifableTestCase;

class KegiatanTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Master\Kegiatan::class;
    }

    public function viewpath()
    {
        return url('master/kegiatan');
    }

    /** @test */
    public function user_can_assign_new_kegiatan_to_many_kategori()
    {
        $collection = factory(KategoriKegiatan::class, 5)->create();

        $resource   = factory(Kegiatan::class)->make([
            'kategori' => $collection->map(function ($kategori, $key) {
                return ['id' => $kategori->id, 'kode' => str_random(5)];
            })->toArray()
        ]);

        $this->withExceptionHandling()
             ->signIn()
             ->postJson($resource->path('store'), $resource->toArray())
             ->assertJson(['status' => 'success'])
             ->assertStatus(201);

        $this->assertDatabaseHas('kegiatans', $resource->only('uraian'));

        $kode = array_only(array_random($resource->kategori), 'kode');

        $this->assertDatabaseHas('kategori_kegiatan_kegiatan', $kode);

        return $this;
    }

    /** @test **/
    public function user_can_create_a_resource_with_parent()
    {
        $parent   = factory($this->resource())->create();
        $resource = factory($this->resource())->make(['parent_id' => $parent->id]);

        $this->signIn()
             ->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertHeader('Location')
             ->assertStatus(201);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource),
            $this->getDatabaseConnection($resource)
        );

        $this->assertDatabaseHas(
            $this->resourceTable($parent),
            $this->matchDatabase($parent),
            $this->getDatabaseConnection($parent)
        );
    }

    /** @test */
    public function user_can_filter_collection_by_kategori()
    {
        $kategori  = factory(KategoriKegiatan::class)->create();
        $kegiatan  = factory(Kegiatan::class, 5)->create();
        $lainnya   = factory(Kegiatan::class, 5)->create();

        $kategori->kegiatan()->attach(
            $kegiatan->pluck('id')->flip()->map(function ($value, $key) {
                return ['kode' => str_random(5)];
            })
        );

        $this->signIn()
             ->getJson(action('Master\KegiatanController@index') . '?kategori=' . $kategori->id)
             ->assertJsonStructure(['data'  => ['*' => ['uraian']]])
             ->assertJsonCount(5, 'data')
             ->assertSee($kegiatan->random()->uraian)
             ->assertDontSee($lainnya->random()->uraian)
             ->assertStatus(200);
    }
}
