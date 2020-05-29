<?php

namespace Tests\Unit\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Transaksi;
use App\Models\Logistik\Penerimaan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Logistik\Logistik;
use App\Models\Layanan\Resep;

class LogistikTransaksiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_faktur()
    {
        $resource = factory(Transaksi::class)->create([
            'faktur_type' => Penerimaan::class
        ]);

        $this->assertInstanceOf(Penerimaan::class, $resource->faktur);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $resource = factory(Transaksi::class)->create();

        $this->assertInstanceOf(Poliklinik::class, $resource->apotek);
    }

    /** @test */
    public function resouce_belongs_to_logistik()
    {
        $resource = factory(Transaksi::class)->create();

        $this->assertInstanceOf(Logistik::class, $resource->logistik);
    }

    /** @test */
    public function transaksi_penerimaan_menambah_stok()
    {
        $logistik = factory(Logistik::class)->create();

        $apotek_a = factory(Poliklinik::class)->create();
        $apotek_b = factory(Poliklinik::class)->create();

        $resource = factory(Transaksi::class)->create([
            'faktur_type' => Penerimaan::class,
            'apotek_id'   => $apotek_a->id,
            'logistik_id' => $logistik->id,
            'jumlah'      => 10
        ]);

        $resource = factory(Transaksi::class)->create([
            'faktur_type' => Penerimaan::class,
            'apotek_id'   => $apotek_b->id,
            'logistik_id' => $logistik->id,
            'jumlah'      => 5
        ]);

        $logistik = Logistik::stock()->find($logistik->id);

        $this->assertEquals(15, $logistik->stock);

        $logistik = Logistik::stock($apotek_a->id)->find($logistik->id);

        $this->assertEquals(10, $logistik->stock);

        $logistik = Logistik::stock($apotek_b->id)->find($logistik->id);

        $this->assertEquals(5, $logistik->stock);
    }

    /** @test */
    public function transaksi_copy_harga_if_resep()
    {
        $logistik = factory(Logistik::class)->create([
            'harga_jual' => 10000
        ]);

        $apotek_a = factory(Poliklinik::class)->create();

        $resource = factory(Transaksi::class)->create([
            'faktur_type' => Resep::class,
            'apotek_id'   => $apotek_a->id,
            'logistik_id' => $logistik->id,
            'jumlah'      => 10
        ]);

        $this->assertEquals(10000, $resource->harga);
    }
}
