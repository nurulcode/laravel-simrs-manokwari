<?php

namespace Tests\Unit\Master\Wilayah;

use Tests\TestCase;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Models\Master\Wilayah\KotaKabupaten;

class KelurahanTest extends TestCase
{
    /** @test */
    public function a_kelurahan_belongs_to_kecamatan()
    {
        $kelurahan = factory(Kelurahan::class)->create();

        $this->assertInstanceof(Kecamatan::class, $kelurahan->kecamatan);
    }

    /** @test */
    public function a_kelurahan_have_virtual_kota_kabupaten_id()
    {
        $kelurahan = factory(Kelurahan::class)->create();

        $kelurahan = Kelurahan::find($kelurahan->id);

        $this->assertSame($kelurahan->kota_kabupaten_id, $kelurahan->kecamatan->kota_kabupaten_id);
    }

    /** @test */
    public function a_kelurahan_belongs_to_kota_kabupaten()
    {
        $kelurahan = factory(Kelurahan::class)->create();

        $kelurahan = Kelurahan::find($kelurahan->id);

        $this->assertInstanceof(KotaKabupaten::class, $kelurahan->kota_kabupaten);
    }

    /** @test */
    public function a_kelurahan_have_virtual_provinsi_id()
    {
        $kelurahan = factory(Kelurahan::class)->create();

        $kelurahan = Kelurahan::find($kelurahan->id);

        $this->assertSame(
            $kelurahan->kecamatan->kota_kabupaten->provinsi_id,
            $kelurahan->provinsi_id
        );
    }

    /** @test */
    public function a_kelurahan_belongs_to_provinsi()
    {
        $kelurahan = factory(Kelurahan::class)->create();

        $kelurahan = Kelurahan::find($kelurahan->id);

        $this->assertInstanceof(Provinsi::class, $kelurahan->provinsi);
    }
}
