<?php

namespace Tests\Unit\Logistik;

use Tests\TestCase;
use App\Models\Logistik\Penerimaan;
use App\Models\Logistik\Suplier;
use App\Models\Logistik\Transaksi;
use Illuminate\Support\Collection;

class PenerimaanTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_suplier()
    {
        $resource = factory(Penerimaan::class)->create();

        $this->assertInstanceOf(Suplier::class, $resource->suplier);
    }

    /** @test */
    public function resource_has_many_transaksi()
    {
        $resource = factory(Penerimaan::class)->create();

        factory(Transaksi::class, 20)->create([
            'faktur_type' => Penerimaan::class,
            'faktur_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->transaksis);

        $this->assertInstanceOf(Transaksi::class, $resource->transaksis->random());
    }
}
