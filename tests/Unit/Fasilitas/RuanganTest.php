<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas;
use Illuminate\Support\Collection;

class RuanganTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $ruangan = factory(Fasilitas\Ruangan::class)->create();

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $ruangan->poliklinik);
    }

    /** @test */
    public function resource_may_has_many_kamar()
    {
        $ruangan = factory(Fasilitas\Ruangan::class)->create();

        factory(Fasilitas\Kamar::class, 10)->create(['ruangan_id' => $ruangan->id]);

        $this->assertInstanceOf(Collection::class, $ruangan->kamars);
        $this->assertInstanceOf(Fasilitas\Kamar::class, $ruangan->kamars->random());
    }
}
