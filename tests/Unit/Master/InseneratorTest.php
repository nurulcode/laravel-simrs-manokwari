<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\Insenerator;
use Illuminate\Support\Collection;

class InseneratorTest extends TestCase
{
    /** @test */
    public function a_resource_belongs_to_itself()
    {
        $resource = factory(Insenerator::class)->create([
            'parent_id' => function () {
                return factory(Insenerator::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(Insenerator::class, $resource->parent);
    }

    /** @test */
    public function a_resource_may_have_many_childs()
    {
        $resource = factory(Insenerator::class)->create();
        $childs   = factory(Insenerator::class, 5)->create([
            'parent_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->childs);

        $this->assertInstanceOf(Insenerator::class, $resource->childs->random());
    }
}
