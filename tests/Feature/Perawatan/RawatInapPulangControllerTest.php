<?php

namespace Tests\Feature\Perawatan;

use Carbon\Carbon;
use Tests\TestCase;
use App\Enums\CaraKeluar;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Enums\KeadaanKeluar;
use App\Models\Perawatan\RawatInap;
use App\Models\Perawatan\RawatInapPulang;
use Sty\Tests\APITestCase;

class RawatInapPulangControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function pasien_rawat_inap_dapat_pulang()
    {
        $resource   = factory(RawatInap::class)->create();

        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $waktu_keluar = Carbon::now()->toDateTimeString();

        $this->signIn()
            ->postJson(action('Perawatan\RawatInapPulangController', $resource->id), [
                'waktu_keluar'   => $waktu_keluar,
                'keadaan_keluar' => KeadaanKeluar::getRandomValue(),
                'cara_keluar'    => CaraKeluar::getRandomValue(),
            ])
            ->assertStatus(200);

        $resource = RawatInap::find($resource->id);

        $this->assertInstanceOf(RawatInapPulang::class, $resource->pulang);

        $this->assertEquals($waktu_keluar, $resource->kunjungan->waktu_keluar);
        $this->assertEquals($waktu_keluar, $resource->pulang->waktu_keluar);
    }
}
