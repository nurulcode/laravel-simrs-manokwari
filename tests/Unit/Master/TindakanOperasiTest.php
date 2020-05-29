<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\TindakanOperasi;

class TindakanOperasiTest extends TestCase
{
    /** @test */
    public function a_resource_belongs_to_itself()
    {
        $resource = factory(TindakanOperasi::class)->create([
            'parent_id' => function () {
                return factory(TindakanOperasi::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(TindakanOperasi::class, $resource->parent);
    }

    /** @test */
    public function a_resource_may_have_many_childs()
    {
        $resource = factory(TindakanOperasi::class)->create();
        $childs   = factory(TindakanOperasi::class, 5)->create([
            'parent_id' => $resource->id
        ]);

        $this->assertInstanceOf(Collection::class, $resource->childs);

        $this->assertInstanceOf(TindakanOperasi::class, $resource->childs->random());
    }
}
