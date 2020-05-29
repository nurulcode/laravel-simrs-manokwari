<?php

namespace Tests\Unit\Master\Wilayah;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Models\Master\Wilayah\KotaKabupaten;
use App\Models\Master\Wilayah\Provinsi;

class KecamatanTest extends TestCase
{
    /** @test */
    public function a_kecamatan_belongs_to_kota_kabupaten()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        $this->assertInstanceof(KotaKabupaten::class, $kecamatan->kota_kabupaten);
    }

    /** @test */
    public function a_kecamatan_may_has_many_kelurahan()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        factory(Kelurahan::class, 10)->create([
            'kecamatan_id' => $kecamatan->id
            ]);

            $this->assertInstanceOf(Collection::class, $kecamatan->kelurahans);
            $this->assertInstanceOf(Kelurahan::class, $kecamatan->kelurahans->random());
        }

    /** @test */
    public function a_kecamatan_have_virtual_provinsi_id()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        $kecamatan = Kecamatan::find($kecamatan->id);

        $this->assertSame($kecamatan->kota_kabupaten->provinsi_id, $kecamatan->provinsi_id);
    }

    /** @test */
    public function a_kecamatan_belongs_to_provinsi()
    {
        $kecamatan = factory(Kecamatan::class)->create();

        $kecamatan = Kecamatan::find($kecamatan->id);

        $this->assertInstanceof(Provinsi::class, $kecamatan->provinsi);
    }
}
