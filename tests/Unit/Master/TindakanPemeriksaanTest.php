<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\TindakanPemeriksaan;
use App\Models\Master\Prosedur;

class TindakanPemeriksaanTest extends TestCase
{
    /** @test */
    public function a_tindakan_belongs_to_itself()
    {
        $tindakan = factory(TindakanPemeriksaan::class)->create([
            'parent_id' => function () {
                return factory(TindakanPemeriksaan::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(TindakanPemeriksaan::class, $tindakan->parent);
    }

    /** @test */
    public function a_tindakan_belongs_to_prosedur()
    {
        $tindakan = factory(TindakanPemeriksaan::class)->create();

        $this->assertInstanceof(Prosedur::class, $tindakan->prosedur);
    }

    /** @test */
    public function a_tindakan_has_many_poliklinik()
    {
        $polikliniks = factory(Poliklinik::class, 10)->create();

        $tindakan   = factory(TindakanPemeriksaan::class)->create();

        $tindakan->polikliniks()->sync(
            $polikliniks->map(function ($value) {
                return $value->id;
            })->toArray()
        );

        $this->assertInstanceOf(Collection::class, $tindakan->polikliniks);

        $this->assertEquals($tindakan->polikliniks->count(), 10);

        $this->assertInstanceOf(Poliklinik::class, $tindakan->polikliniks->random());
    }
}
