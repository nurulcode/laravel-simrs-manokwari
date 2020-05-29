<?php

namespace Tests\Feature\Layanan;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class ResepDetailControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Layanan\ResepDetail::class;
    }

    public function matchDatabase($resource)
    {
        return array_except($resource->getAttributes(), 'resep_id');
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'perawatan_id'   => $resource->resep->perawatan_id,
            'perawatan_type' => $resource->resep->perawatan_type
        ]);
    }
}
