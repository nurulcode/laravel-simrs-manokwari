<?php

namespace Tests\Feature;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\TindakanPemeriksaan;

class TindakanPoliklinikControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_assign_poliklinik_to_new_tindakan()
    {
        $polikliniks = factory(Poliklinik::class, 5)->create();

        $resource    = factory(TindakanPemeriksaan::class)->make([
            'polikliniks' => $polikliniks->map(function ($poli) {
                return ['id' => $poli->id];
            })
        ]);

        $this->signIn()
            ->postJson($resource->path('store'), $resource->toArray())
            ->assertJson(['status' => 'success'])
            ->assertStatus(201);

        $this->assertDatabaseHas($resource->getTable(), array_except(
            $resource->getAttributes(), 'polikliniks'
        ));

        $this->assertDatabaseHas('poliklinik_tindakan_pemeriksaan', [
            'poliklinik_id' => $polikliniks->random()->id
        ]);
    }

    /** @test */
    public function user_can_assign_poliklinik_to_existing_tindakan()
    {
        $polikliniks = factory(Poliklinik::class, 5)->create();

        $resource    = factory(TindakanPemeriksaan::class)->create();

        $this->signIn()
            ->putJson($resource->path, array_merge(
                $resource->toArray(), [
                    'polikliniks' => $polikliniks->map(function ($poli) {
                        return ['id' => $poli->id];
                    })
                ]))
            ->assertJson(['status' => 'success'])
            ->assertStatus(200);

        $this->assertDatabaseHas('poliklinik_tindakan_pemeriksaan', [
            'tindakan_pemeriksaan_id' => $resource->id,
            'poliklinik_id'           => $polikliniks->random()->id
        ]);
    }
}
