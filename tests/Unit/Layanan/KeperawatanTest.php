<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Layanan\Keperawatan;
use App\Models\Perawatan\Perawatan;
use App\Models\Perawatan\RawatInap;
use App\Models\Master\PerawatanKhusus;

class KeperawatanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Keperawatan::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Keperawatan::class)->create();

        $this->assertInstanceOf(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function resource_belongs_to_perawatan_khusus()
    {
        $resource = factory(Keperawatan::class)->create();

        $this->assertInstanceOf(PerawatanKhusus::class, $resource->perawatan_khusus);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_tindakan_pemeriksaan()
    {
        $perawatan = factory(RawatInap::class)->create();

        $master    = factory(PerawatanKhusus::class)->create();

        $perawatan = RawatInap::find($perawatan->id);

        $master->tarif()->create([
            'tarif' => [
                KelasTarif::getKey((string) $perawatan->kelas) => [
                    JenisTarif::SARANA    => 15000,
                    JenisTarif::PELAYANAN => 10000,
                    JenisTarif::BHP       => 0
                ],
            ]
        ]);

        $resource = factory(Keperawatan::class)->create([
            'perawatan_type'      => RawatInap::class,
            'perawatan_id'        => $perawatan->id,
            'perawatan_khusus_id' => $master->id,
        ]);

        $master = PerawatanKhusus::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(KelasTarif::getKey((string) $perawatan->kelas)),
            $resource->tarif
        );
    }
}
