<?php

namespace Tests\Unit\Layanan;

use Tests\TestCase;
use App\Models\Layanan\Resep;
use App\Models\Perawatan\Perawatan;
use App\Models\Layanan\ResepDetail;
use Illuminate\Support\Collection;
use App\Models\Logistik\Transaksi;

class ResepTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_perawatan()
    {
        $resource = factory(Resep::class)->create();

        $this->assertInstanceof(Perawatan::class, $resource->perawatan);
    }

    /** @test */
    public function resource_has_many_details()
    {
        $resource = factory(Resep::class)->create();

        factory(ResepDetail::class, 10)->create([
            'resep_id' => $resource->id
        ]);

        $this->assertInstanceof(Collection::class, $resource->details);

        $this->assertInstanceof(ResepDetail::class, $resource->details->random());
    }

    /** @test */
    public function resource_has_many_obats()
    {
        $resource = factory(Resep::class)->create();

        factory(Transaksi::class, 10)->create([
            'faktur_id'   => $resource->id,
            'faktur_type' => get_class($resource)
        ]);

        $this->assertInstanceof(Collection::class, $resource->obats);

        $this->assertInstanceof(Transaksi::class, $resource->obats->random());
    }
}
