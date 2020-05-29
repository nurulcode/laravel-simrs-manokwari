<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Master;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Perawatan;
use App\Models\Registrasi;
use Illuminate\Support\Collection;

class KunjunganTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_pasien()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertInstanceof(Pasien::class, $kunjungan->pasien);
    }

    /** @test */
    public function resource_belongs_to_penyakit()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertInstanceof(Master\Penyakit\Penyakit::class, $kunjungan->penyakit);
    }

    /** @test */
    public function resource_may_has_many_registrasi()
    {
        $resource     = factory(Kunjungan::class)->create();

        factory(Registrasi::class, 10)->create(['kunjungan_id' => $resource->id]);

        $this->assertInstanceOf(Collection::class, $resource->registrasis);

        $this->assertInstanceOf(Registrasi::class, $resource->registrasis->random());
    }

    /** @test */
    public function resource_may_has_many_rawat_jalan()
    {
        $resource     = factory(Kunjungan::class)->create();

        $rawat_jalans = factory(Perawatan\RawatJalan::class, 5)->create();

        $master       = factory(Master\JenisRegistrasi::class)->create();

        $rawat_jalans->each(function ($rawat_jalan) use ($resource, $master) {
            $rawat_jalan->registrasi()->create([
                'jenis_registrasi_id' => $master->id,
                'kunjungan_id'        => $resource->id
            ]);
        });

        $this->assertInstanceOf(Collection::class, $resource->rawat_jalans);

        $rawat_jalan = $resource->rawat_jalans->random();

        $this->assertInstanceOf(Perawatan\RawatJalan::class, $rawat_jalan);
    }

    /** @test */
    public function resource_may_has_many_rawat_darurat()
    {
        $resource       = factory(Kunjungan::class)->create();

        $rawat_darurats = factory(Perawatan\RawatDarurat::class, 5)->create();

        $master       = factory(Master\JenisRegistrasi::class)->create();

        $rawat_darurats->each(function ($rawat_darurat) use ($resource, $master) {
            $rawat_darurat->registrasi()->create([
                'jenis_registrasi_id' => $master->id,
                'kunjungan_id'        => $resource->id
            ]);
        });

        $this->assertInstanceOf(Collection::class, $resource->rawat_darurats);

        $rawat_darurat = $resource->rawat_darurats->random()->perawatan;

        $this->assertInstanceOf(Perawatan\RawatDarurat::class, $rawat_darurat);
    }

    /** @test */
    public function resource_may_has_many_rawat_inap()
    {
        $resource     = factory(Kunjungan::class)->create();

        $rawat_inaps  = factory(Perawatan\RawatInap::class, 5)->create();

        $master       = factory(Master\JenisRegistrasi::class)->create();

        $rawat_inaps->each(function ($rawat_inap) use ($resource, $master) {
            $rawat_inap->registrasi()->create([
                'jenis_registrasi_id' => $master->id,
                'kunjungan_id'        => $resource->id
            ]);
        });

        $this->assertInstanceOf(Collection::class, $resource->rawat_inaps);

        $rawat_inap = $resource->rawat_inaps->random();

        $this->assertInstanceOf(Perawatan\RawatInap::class, $rawat_inap);
    }

    /** @test */
    public function model_can_auto_generate_nomor_kunjungan()
    {
        $kunjungan = factory(Kunjungan::class)->create();

        $this->assertEquals(str_pad($kunjungan->id, 8, 0, STR_PAD_LEFT), $kunjungan->nomor_kunjungan);
    }
}
