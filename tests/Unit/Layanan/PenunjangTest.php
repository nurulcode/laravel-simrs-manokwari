<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\Penunjang;
use App\Models\Perawatan\Perawatan;
use App\Models\Fasilitas\Poliklinik;

class PenunjangTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Penunjang::class)->create();

        $this->assertInstanceof(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(Penunjang::class)->create();

        $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    }
}
