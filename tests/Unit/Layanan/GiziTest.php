<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Master;
use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use App\Models\Layanan\Gizi;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Perawatan\Perawatan;
use App\Models\Perawatan\RawatInap;

class GiziTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_petugas()
    {
        $resource = factory(Gizi::class)->create();

        $this->assertInstanceOf(Pegawai::class, $resource->petugas);
    }

    /** @test */
    public function resource_belongs_to_gizi()
    {
        $resource = factory(Gizi::class)->create();

        $this->assertInstanceOf(Master\Gizi::class, $resource->gizi);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Gizi::class)->create();

        $this->assertInstanceOf(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_gizi()
    {
        $perawatan = factory(RawatInap::class)->create();

        $master    = factory(Master\Gizi::class)->create();

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

        $resource = factory(Gizi::class)->create([
            'perawatan_type' => RawatInap::class,
            'perawatan_id'   => $perawatan->id,
            'gizi_id'        => $master->id,
        ]);

        $master = Master\Gizi::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(KelasTarif::getKey((string) $perawatan->kelas)),
            $resource->tarif
        );
    }
}
