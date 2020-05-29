<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use App\Models\Layanan\Visite;
use App\Models\Master\JenisVisite;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Perawatan\Perawatan;
use App\Models\Perawatan\RawatInap;

class VisiteTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Visite::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_jenis_visite()
    {
        $resource = factory(Visite::class)->create();

        $this->assertInstanceOf(JenisVisite::class, $resource->jenis_visite);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Visite::class)->create();

        $this->assertInstanceOf(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_jenis_visite()
    {
        $perawatan = factory(RawatInap::class)->create();

        $master    = factory(JenisVisite::class)->create();

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

        $resource = factory(Visite::class)->create([
            'perawatan_type'  => RawatInap::class,
            'perawatan_id'    => $perawatan->id,
            'jenis_visite_id' => $master->id,
        ]);

        $master = JenisVisite::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(KelasTarif::getKey((string) $perawatan->kelas)),
            $resource->tarif
        );
    }
}
