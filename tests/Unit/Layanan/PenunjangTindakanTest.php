<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use App\Models\Master\Kegiatan;
use App\Models\Layanan\Penunjang;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Perawatan\RawatInap;
use App\Models\Layanan\PenunjangTindakan;

class PenunjangTindakanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_layanan_penunjang()
    {
        $resource = factory(PenunjangTindakan::class)->create();

        $this->assertInstanceOf(Penunjang::class, $resource->penunjang);
    }

    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(PenunjangTindakan::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_tindakan()
    {
        $resource = factory(PenunjangTindakan::class)->create([
            'tindakan_type' => Kegiatan::class
        ]);

        $this->assertInstanceOf(Kegiatan::class, $resource->tindakan);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_tindakan()
    {
        $perawatan = factory(RawatInap::class)->create();

        $perawatan = RawatInap::find($perawatan->id);

        $master    = factory(Kegiatan::class)->create();

        $master->tarif()->create([
            'tarif' => [
                KelasTarif::getKey((string) $perawatan->kelas) => [
                    JenisTarif::SARANA    => 15000,
                    JenisTarif::PELAYANAN => 10000,
                    JenisTarif::BHP       => 0
                ],
            ]
        ]);

        $penunjang = factory(Penunjang::class)->create([
            'perawatan_type'          => RawatInap::class,
            'perawatan_id'            => $perawatan->id,
        ]);

        $resource = factory(PenunjangTindakan::class)->create([
            'penunjang_id'  => $penunjang,
            'tindakan_type' => get_class($master),
            'tindakan_id'   => $master->id
        ]);

        $master = Kegiatan::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(KelasTarif::getKey((string) $perawatan->kelas)),
            $resource->tarif
        );
    }
}
