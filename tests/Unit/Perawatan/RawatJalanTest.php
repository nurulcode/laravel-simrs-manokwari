<?php

namespace Tests\Unit\Perawatan;

use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Models\Master\Kegiatan;
use App\Models\Layanan\Diagnosa;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Perawatan\RawatJalan;

class RawatJalanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_registrasi()
    {
        $resource   = factory(RawatJalan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $this->assertInstanceof(Registrasi::class, $resource->registrasi);
    }

    /** @test */
    public function resource_belongs_to_kegiatan()
    {
        $resource = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Kegiatan::class, $resource->kegiatan);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(RawatJalan::class)->create();

        $this->assertInstanceof(Poliklinik::class, $resource->poliklinik);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource  = factory(RawatJalan::class)->create();

        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $resource = RawatJalan::find($resource->id);

        $this->assertEquals($resource->kunjungan->id, $kunjungan->id);

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }

    /** @test */
    public function resource_has_many_diagnosa()
    {
        $resource = factory(RawatJalan::class)->create();

        factory(Diagnosa::class, 5)->create([
            'perawatan_type' => RawatJalan::class,
            'perawatan_id'   => $resource->id,
        ]);

        $this->assertInstanceof(Diagnosa::class, $resource->diagnosa->random());
    }
}
