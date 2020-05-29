<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Logistik;
use App\Models\Logistik\Transaksi;
use App\Models\Fasilitas\Poliklinik;
use Sty\Tests\APITestCase;

class TransferLogistikControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_make_a_stock_transfer()
    {
        $logistik  = factory(Logistik::class)->create();

        $apotek    = factory(Poliklinik::class)->create();

        $tujuan    = factory(Poliklinik::class)->create();

        $transaksi = factory(Transaksi::class, 10)->create([
            'apotek_id'   => $apotek->id,
            'logistik_id' => $logistik->id,
            'jumlah'      => 10
        ]);

        $this->disableExceptionHandling()
            ->signIn()
            ->postJson(action('Logistik\\TransferLogistikController'), [
                'apotek_id'   => $apotek->id,
                'logistik_id' => $logistik->id,
                'tujuan_id'   => $tujuan->id,
                'transfer'    => 80
            ])
            ->assertStatus(200);

        $logistik  = Logistik::stock()->find($logistik->id);

        $this->assertEquals($logistik->stock, 100);

        $this->assertEquals($logistik->getStock($apotek->id), 20);
        $this->assertEquals($logistik->getStock($tujuan->id), 80);
    }
}
