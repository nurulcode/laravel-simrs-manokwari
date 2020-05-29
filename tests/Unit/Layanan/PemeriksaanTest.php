<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Layanan\Pemeriksaan;
use App\Models\Perawatan\RawatInap;
use App\Models\Master\PemeriksaanUmum;

class PemeriksaanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Pemeriksaan::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Pemeriksaan::class)->create([
            'perawatan_type' => RawatInap::class
        ]);

        $this->assertInstanceOf(RawatInap::class, $resource->perawatan);
    }

    /** @test */
    public function resource_belongs_to_pemeriksaan_umum()
    {
        $resource = factory(Pemeriksaan::class)->create();

        $this->assertInstanceOf(PemeriksaanUmum::class, $resource->pemeriksaan_umum);
    }
}
