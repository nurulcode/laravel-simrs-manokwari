<?php

namespace Tests\Unit\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Logistik;
use App\Models\Master\JenisLogistik;
use App\Models\Logistik\Transaksi;
use Illuminate\Support\Collection;

class LogistikTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jenis_logistik()
    {
        $resource = factory(Logistik::class)->create();

        $this->assertInstanceOf(JenisLogistik::class, $resource->jenis);
    }

    /** @test */
    public function resource_has_many_transaksi()
    {
        $resource  = factory(Logistik::class)->create();

        $transaksi = factory(Transaksi::class, 10)->create([
            'logistik_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->transaksis);

        $this->assertInstanceOf(Transaksi::class, $resource->transaksis->random());
    }
}
