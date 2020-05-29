<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\Prosedur;
use Illuminate\Support\Collection;

class ProsedurTest extends TestCase
{
    /** @test */
    public function a_resource_belongs_to_itself()
    {
        $resource = factory(Prosedur::class)->create([
            'parent_id' => function () {
                return factory(Prosedur::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(Prosedur::class, $resource->parent);
    }

    /** @test */
    public function a_resource_may_have_many_childs()
    {
        $resource = factory(Prosedur::class)->create();
        $childs   = factory(Prosedur::class, 5)->create([
            'parent_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->childs);

        $this->assertInstanceOf(Prosedur::class, $resource->childs->random());
    }
}
