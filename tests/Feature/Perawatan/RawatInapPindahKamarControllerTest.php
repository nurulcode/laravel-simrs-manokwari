<?php

namespace Tests\Feature\Perawatan;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use Sty\Tests\APITestCase;
use App\Models\Perawatan\RawatInap;
use App\Models\Fasilitas\Ranjang;

class RawatInapPindahKamarControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function pasien_rawat_inap_dapat_pindah_kamar()
    {
        $resource   = factory(RawatInap::class)->create();

        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $waktu_pindah = Carbon::now()->addHour()->toDateTimeString();

        $ranjang_baru = factory(Ranjang::class)->create();

        $this
            ->signIn()
            ->postJson(action('Perawatan\RawatInapPindahKamarController', $resource->id), [
                'waktu_pindah'  => $waktu_pindah,
                'ranjang_id'    => $ranjang_baru->id,
                'kamar_id'      => $ranjang_baru->kamar_id,
                'ruangan_id'    => $ranjang_baru->kamar->ruangan_id,
                'poliklinik_id' => $ranjang_baru->kamar->ruangan->poliklinik_id,
            ])
            ->assertSee('success')
            ->assertStatus(201);

        $resource = RawatInap::find($resource->id);

        $inap_baru = $kunjungan->rawat_inaps()->whereNull('waktu_keluar')->first();

        $this->assertEquals(2, $kunjungan->rawat_inaps()->count());

        $this->assertEquals($resource->waktu_keluar, $waktu_pindah);

        $this->assertEquals((string) $inap_baru->waktu_masuk, $waktu_pindah);

        $this->assertEquals($ranjang_baru->id, $inap_baru->ranjang_id);
    }
}
