<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\CaraPembayaran;

class CaraPembayaranTest extends TestCase
{
    /** @test */
    public function a_resource_belongs_to_itself()
    {
        $resource = factory(CaraPembayaran::class)->create([
            'parent_id' => function () {
                return factory(CaraPembayaran::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(CaraPembayaran::class, $resource->parent);
    }

    /** @test */
    public function a_resource_may_have_many_childs()
    {
        $resource = factory(CaraPembayaran::class)->create();
        $childs   = factory(CaraPembayaran::class, 5)->create([
            'parent_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->childs);

        $this->assertInstanceOf(CaraPembayaran::class, $resource->childs->random());
    }
}
