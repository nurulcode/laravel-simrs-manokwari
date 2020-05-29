<?php

namespace Tests\Unit\Layanan;

use App\Enums;
use Tests\TestCase;
use App\Models\Layanan\Tindakan;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Master\TindakanPemeriksaan;
use App\Models\Perawatan\Perawatan;
use App\Enums\KelasTarif;
use App\Models\Perawatan\RawatDarurat;

class TindakanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_tindakan_pemeriksaan()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(TindakanPemeriksaan::class, $resource->tindakan_pemeriksaan);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Tindakan::class)->create();

        $this->assertInstanceOf(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_tindakan_pemeriksaan()
    {
        $perawatan = factory(RawatDarurat::class)->create();

        $master    = factory(TindakanPemeriksaan::class)->create();

        $perawatan = RawatDarurat::find($perawatan->id);

        $master->tarif()->create([
            'tarif' => [
                KelasTarif::getKey((string) $perawatan->kelas) => [
                    Enums\JenisTarif::SARANA    => 15000,
                    Enums\JenisTarif::PELAYANAN => 10000,
                    Enums\JenisTarif::BHP       => 0
                ],
            ]
        ]);

        $resource = factory(Tindakan::class)->create([
            'perawatan_type'          => RawatDarurat::class,
            'perawatan_id'            => $perawatan->id,
            'tindakan_pemeriksaan_id' => $master->id,
        ]);

        $master = TindakanPemeriksaan::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(KelasTarif::getKey((string) $perawatan->kelas)),
            $resource->tarif
        );
    }
}
