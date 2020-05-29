<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Master\Kegiatan;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Perawatan\Perawatan;
use App\Models\Layanan\Perinatologi;

class PerinatologiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Perinatologi::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_kegiatan()
    {
        $resource = factory(Perinatologi::class)->create();

        $this->assertInstanceOf(Kegiatan::class, $resource->kegiatan);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Perinatologi::class)->create();

        $this->assertInstanceOf(Perawatan::class, $resource->perawatan);
    }
}
