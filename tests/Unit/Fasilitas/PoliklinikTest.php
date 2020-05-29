<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas\Ruangan;
use Illuminate\Support\Collection;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\JenisPoliklinik;

class PoliklinikTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_poliklinik()
    {
        $poliklinik = factory(Poliklinik::class)->create();

        $this->assertInstanceof(JenisPoliklinik::class, $poliklinik->jenis);
    }

    /** @test */
    public function resource_may_has_many_ruangan()
    {
        $poliklinik = factory(Poliklinik::class)->create();

        factory(Ruangan::class, 10)->create([
            'poliklinik_id' => $poliklinik->id
        ]);

        $this->assertInstanceOf(Collection::class, $poliklinik->ruangans);
        $this->assertInstanceOf(Ruangan::class, $poliklinik->ruangans->random());
    }
}
