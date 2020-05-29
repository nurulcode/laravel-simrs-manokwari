<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;

class CaraPembayaranTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\CaraPembayaran::class;
    }

    public function viewpath()
    {
        return url('master/cara-pembayaran');
    }

    /** @test */
    public function resource_collection_can_be_filtered_for_only_parent()
    {
        $first  = factory($this->resource())->create();
        $second = factory($this->resource())->create();
        $third  = factory($this->resource())->create(['parent_id' => $first->id]);

        $this->signIn()
            ->getJson(action('Master\CaraPembayaranController@index') . '?parent=true')
            ->assertJson(['data' => []])
            ->assertJsonStructure(['data' => ['*' => ['path']]])
            ->assertDontSeeText($third->uraian)
            ->assertJsonCount(2, 'data')
            ->assertStatus(200);

        return $this;
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make([
            'parent_id' => str_random(9)
        ]);

        $this->signIn()
             ->postJson($resource->path, $this->beforePost($resource))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['parent_id'])
             ->assertStatus(422);
    }
}
