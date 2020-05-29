<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\ResepDetail;
use App\Models\Layanan\Resep;
use App\Models\Logistik\Logistik;
use App\Models\Kepegawaian\Pegawai;

class ResepDetailTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_resep()
    {
        $resource = factory(ResepDetail::class)->create();

        $this->assertInstanceof(Resep::class, $resource->resep);
    }

    /** @test */
    public function resource_belongs_to_obat()
    {
        $resource = factory(ResepDetail::class)->create();

        $this->assertInstanceof(Logistik::class, $resource->obat);
    }

    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(ResepDetail::class)->create();

        $this->assertInstanceof(Pegawai::class, $resource->petugas);
    }
}
