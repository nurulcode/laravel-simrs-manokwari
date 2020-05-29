<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\Utdrs;
use Illuminate\Support\Collection;

class UtdrsTest extends TestCase
{
    /** @test */
    public function a_resource_belongs_to_itself()
    {
        $resource = factory(Utdrs::class)->create([
            'parent_id' => function () {
                return factory(Utdrs::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(Utdrs::class, $resource->parent);
    }

    /** @test */
    public function a_resource_may_have_many_childs()
    {
        $resource = factory(Utdrs::class)->create();
        $childs   = factory(Utdrs::class, 5)->create([
            'parent_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->childs);

        $this->assertInstanceOf(Utdrs::class, $resource->childs->random());
    }
}
