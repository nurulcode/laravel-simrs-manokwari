<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use App\Models\Layanan\Laundry;
use App\Models\Master\JenisLaundry;
use App\Models\Perawatan\Perawatan;
use App\Models\Perawatan\RawatInap;

class LaundryTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_laundry()
    {
        $resource = factory(Laundry::class)->create();

        $this->assertInstanceOf(JenisLaundry::class, $resource->jenis_laundry);
    }

    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Laundry::class)->create();

        $this->assertInstanceOf(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_tindakan_pemeriksaan()
    {
        $perawatan = factory(RawatInap::class)->create();

        $master    = factory(JenisLaundry::class)->create();

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

        $resource = factory(Laundry::class)->create([
            'perawatan_type'   => RawatInap::class,
            'perawatan_id'     => $perawatan->id,
            'jenis_laundry_id' => $master->id,
        ]);

        $master = JenisLaundry::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(KelasTarif::getKey((string) $perawatan->kelas)),
            $resource->tarif
        );
    }
}
