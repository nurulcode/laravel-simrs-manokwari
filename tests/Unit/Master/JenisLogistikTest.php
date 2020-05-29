<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\JenisLogistik;
use App\Models\Logistik\Logistik;
use Illuminate\Support\Collection;

class JenisLogistikTest extends TestCase
{
    /** @test */
    public function resource_has_may_logistik()
    {
        $resource = factory(JenisLogistik::class)->create();

        factory(Logistik::class, 20)->create([
            'jenis_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->logistiks);
    }
}
