<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Tests\Feature\TarifableTestCase;
use Sty\Tests\ResourceControllerTestCase;

class TindakanPemeriksaanTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Master\TindakanPemeriksaan::class;
    }

    public function viewpath()
    {
        return url('master/tindakan');
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
            'parent_id' => str_random(9),
            'jenis'     => str_random(9)
        ]);

        $this->signIn()
             ->postJson($resource->path, $resource->toArray())
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['parent_id', 'jenis'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_create_a_resource_with_parent()
    {
        $parent   = factory($this->resource())->create();
        $resource = factory($this->resource())->make([
            'parent_id' => $parent->id
        ]);

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
}
