<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Logistik;
use App\Models\Fasilitas\Poliklinik;
use Sty\Tests\ResourceControllerTestCase;
use App\Enums\JenisTransaksi;
use App\Models\Layanan\Resep;

class TransaksiControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Logistik\Transaksi::class;
    }

    /** @test */
    public function tidak_dapat_membuat_stok_minus()
    {
        $logistik  = factory(Logistik::class)->create();

        $apotek    = factory(Poliklinik::class)->create();

        $resep     = factory(Resep::class)->create();

        $transaksi = factory($this->resource(), 10)->create([
            'apotek_id'   => $apotek->id,
            'logistik_id' => $logistik->id,
            'jumlah'      => 5
        ]);

        $this
            ->signIn()
            ->postJson(action('Logistik\\TransaksiController@store'), [
                'faktur_id'   => $resep->id,
                'faktur_type' => Resep::class,
                'jenis'       => JenisTransaksi::PENGELUARAN,
                'apotek_id'   => $apotek->id,
                'logistik_id' => $logistik->id,
                'jumlah'      => -80
            ])
            ->assertJson(['errors' => []])
            ->assertJsonValidationErrors(['jumlah'])
            ->assertStatus(422);

        $this
            ->signIn()
            ->postJson(action('Logistik\\TransaksiController@store'), [
                'faktur_id'   => $resep->id,
                'faktur_type' => Resep::class,
                'jenis'       => JenisTransaksi::PENGELUARAN,
                'apotek_id'   => $apotek->id,
                'logistik_id' => $logistik->id,
                'jumlah'      => -40
            ])
            ->assertStatus(201);
    }
}
