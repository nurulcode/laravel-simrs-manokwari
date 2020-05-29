<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Master;
use App\Models\Pasien;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\KotaKabupaten;

class PasienTest extends TestCase
{
    /** @test */
    public function model_can_auto_generate_no_rekam_medis()
    {
        $pasien = factory(Pasien::class)->create(['no_rekam_medis' => null]);

        $this->assertEquals(str_pad($pasien->id, 8, 0, STR_PAD_LEFT), $pasien->no_rekam_medis);
    }

    /** @test */
    public function a_pasien_belongs_to_jenis_identitas()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\JenisIdentitas::class, $pasien->jenis_identitas);
    }

    /** @test */
    public function a_pasien_belongs_to_agama()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Agama::class, $pasien->agama);
    }

    /** @test */
    public function a_pasien_belongs_to_suku()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Suku::class, $pasien->suku);
    }

    /** @test */
    public function a_pasien_belongs_to_pendidikan()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Pendidikan::class, $pasien->pendidikan);
    }

    /** @test */
    public function a_pasien_belongs_to_pekerjaan()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Pekerjaan::class, $pasien->pekerjaan);
    }

    /** @test */
    public function a_pasien_belongs_to_kelurahan()
    {
        $pasien = factory(Pasien::class)->create();

        $this->assertInstanceOf(Master\Wilayah\Kelurahan::class, $pasien->kelurahan);
    }

    /** @test */
    public function a_pasien_have_virtual_kecamatan_id()
    {
        $pasien = factory(Pasien::class)->create();

        $pasien = Pasien::find($pasien->id);

        $this->assertSame($pasien->kecamatan_id, $pasien->kelurahan->kecamatan_id);
    }

    /** @test */
    public function a_pasien_belongs_to_kecamatan()
    {
        $pasien = factory(Pasien::class)->create();

        $pasien = Pasien::find($pasien->id);

        $this->assertInstanceof(Kecamatan::class, $pasien->kecamatan);
    }

    /** @test */
    public function a_pasien_have_virtual_kota_kabupaten_id()
    {
        $pasien = factory(Pasien::class)->create();

        $pasien = Pasien::find($pasien->id);

        $this->assertSame(
            $pasien->kota_kabupaten_id,
            $pasien->kelurahan->kecamatan->kota_kabupaten_id
        );
    }

    /** @test */
    public function a_pasien_belongs_to_kota_kabupaten()
    {
        $pasien = factory(Pasien::class)->create();

        $pasien = Pasien::find($pasien->id);

        $this->assertInstanceof(KotaKabupaten::class, $pasien->kota_kabupaten);
    }

    /** @test */
    public function a_pasien_have_virtual_provinsi_id()
    {
        $pasien = factory(Pasien::class)->create();

        $pasien = Pasien::find($pasien->id);

        $this->assertSame(
            $pasien->provinsi_id,
            $pasien->kelurahan->kecamatan->kota_kabupaten->provinsi_id
        );
    }

    /** @test */
    public function a_pasien_belongs_to_provinsi()
    {
        $pasien = factory(Pasien::class)->create();

        $pasien = Pasien::find($pasien->id);

        $this->assertInstanceof(Provinsi::class, $pasien->provinsi);
    }
}
