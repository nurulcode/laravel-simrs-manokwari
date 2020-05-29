<?php

namespace Tests\Unit\Perawatan;

use App\Enums;
use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Models\Master\Kegiatan;
use App\Models\Perawatan\RawatInap;
use App\Models\Perawatan\RawatInapPulang;
use App\Models\Layanan\Kamar;

class RawatInapTest extends TestCase
{
    public function createResourceWithKamar()
    {
        $resource   = factory(RawatInap::class)->create();

        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        return RawatInap::find($resource->id);
    }

    /** @test */
    public function auto_create_layanan_kamar_oncreate()
    {
        $resource   = factory(RawatInap::class)->create();

        $this->assertInstanceOf(Kamar::class, $resource->layanan_kamar);

        $this->assertEquals($resource->waktu_masuk, $resource->layanan_kamar->waktu_masuk);

        $this->assertEquals($resource->ranjang_id, $resource->layanan_kamar->ranjang_id);
    }

    /** @test */
    public function resource_belongs_to_registrasi()
    {
        $resource   = factory(RawatInap::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $this->assertInstanceof(Registrasi::class, $resource->registrasi);
    }

    /** @test */
    public function resource_belongs_to_kegiatan()
    {
        $resource = factory(RawatInap::class)->create();

        $this->assertInstanceof(Kegiatan::class, $resource->kegiatan);
    }

    /** @test */
    public function resource_belongs_to_kunjungan()
    {
        $resource   = factory(RawatInap::class)->create();
        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $resource = RawatInap::find($resource->id);

        $this->assertEquals($resource->kunjungan->id, $kunjungan->id);

        $this->assertInstanceof(Kunjungan::class, $resource->kunjungan);
    }

    /** @test */
    public function resource_belongs_to_ranjang()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Ranjang::class, $resource->ranjang);
    }

    /** @test */
    public function a_resource_have_virtual_kamar_id()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->ranjang->kamar;

        $this->assertEquals($kamar->id, $resource->kamar_id);
    }

    /** @test */
    public function resource_belongs_to_kamar()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Kamar::class, $resource->kamar);
    }

    /** @test */
    public function a_resource_have_virtual_ruangan_id()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->ranjang->kamar;

        $this->assertEquals($kamar->ruangan_id, $resource->ruangan_id);
    }

    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Ruangan::class, $resource->ruangan);
    }

    /** @test */
    public function a_resource_have_virtual_kelas()
    {
        $resource = $this->createResourceWithKamar();

        $kamar    = $resource->ranjang->kamar;

        $this->assertEquals($kamar->ruangan->kelas, $resource->kelas);
    }

    /** @test */
    public function a_resource_have_virtual_poliklinik_id()
    {
        $resource = $this->createResourceWithKamar();

        $ruangan  = $resource->ranjang->kamar->ruangan;

        $this->assertEquals($ruangan->poliklinik_id, $resource->poliklinik_id);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = $this->createResourceWithKamar();

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $resource->poliklinik);
    }

    /** @test */
    public function pasien_rawat_inap_dapat_pulang()
    {
        $resource = $this->createResourceWithKamar();

        $resource->pulang()->create([
            'waktu_keluar'   => now(),
            'keadaan_keluar' => Enums\KeadaanKeluar::getRandomValue(),
            'cara_keluar'    => Enums\CaraKeluar::getRandomValue(),
        ]);

        $resource = $resource->fresh();

        $this->assertInstanceOf(RawatInapPulang::class, $resource->pulang);

        $resource = RawatInap::find($resource->id);

        $this->assertEquals(
            $resource->pulang->waktu_keluar,
            $resource->kunjungan->waktu_keluar
        );

        $this->assertEquals(
            $resource->waktu_keluar,
            $resource->pulang->waktu_keluar
        );

        $this->assertEquals(
            $resource->waktu_keluar,
            $resource->layanan_kamar->waktu_keluar
        );
    }
}
