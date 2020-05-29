<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Kamar;
use Sty\Tests\ResourceControllerTestCase;

class RanjangControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Fasilitas\Ranjang::class;
    }

    /** @test */
    public function user_can_filter_collection_by_kamar()
    {
        $kamar = factory(Kamar::class)->create();

        factory($this->resource(), 5)->create(['kamar_id' => $kamar->id]);

        factory($this->resource(), 5)->create();

        $controller = 'Fasilitas\RanjangController@index';

        $this->signIn()
             ->getJson(action($controller) . '?kamar=' . $kamar->id)
             ->assertSee($kamar->nama)
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
