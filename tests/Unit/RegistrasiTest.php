<?php

namespace Tests\Unit;

use App\Enums;
use Tests\TestCase;
use App\Models\Registrasi;
use App\Models\Master\JenisRegistrasi;

class RegistrasiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_registrasi()
    {
        $resource = factory(Registrasi::class)->create();

        $this->assertInstanceOf(JenisRegistrasi::class, $resource->jenis);
    }

    /** @test */
    public function it_copy_the_tarif_attribute_from_master_jenis_registrasi()
    {
        $master    = factory(JenisRegistrasi::class)->create();

        $master->tarif()->create([
            'tarif' => [
                Enums\KelasTarif::TARIF_UMUM => [
                    Enums\JenisTarif::SARANA    => 15000,
                    Enums\JenisTarif::PELAYANAN => 10000,
                    Enums\JenisTarif::BHP       => 0
                ],
            ]
        ]);

        $resource = factory(Registrasi::class)->create([
            'jenis_registrasi_id' => $master->id,
        ]);

        $master = JenisRegistrasi::find($master->id);

        $this->assertSame(
            $master->getTarifByKelas(Enums\KelasTarif::TARIF_UMUM),
            $resource->tarif
        );
    }
}
