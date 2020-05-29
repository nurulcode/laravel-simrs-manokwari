<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use Sty\Tests\APITestCase;
use App\Models\Logistik\Logistik;
use App\Models\Logistik\Transaksi;
use App\Models\Fasilitas\Poliklinik;

class StockLogistikControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_make_a_stock_correction()
    {
        $logistik  = factory(Logistik::class)->create();

        $apotek    = factory(Poliklinik::class)->create();

        $transaksi = factory(Transaksi::class, 10)->create([
            'apotek_id'   => $apotek->id,
            'logistik_id' => $logistik->id,
            'jumlah'      => 10
        ]);

        factory(Transaksi::class)->create([
            'logistik_id' => $logistik->id,
            'jumlah'      => 50
        ]);

        $this->disableExceptionHandling()
            ->signIn()
            ->postJson(action('Logistik\\StockLogistikController@update'), [
                'apotek_id'   => $apotek->id,
                'logistik_id' => $logistik->id,
                'stock'       => 80
            ])
            ->assertStatus(200);

        $logistik  = Logistik::stock()->find($logistik->id);

        $this->assertEquals($logistik->stock, 80+50);

        $this->assertEquals($logistik->getStock($apotek->id), 80);
    }
}
