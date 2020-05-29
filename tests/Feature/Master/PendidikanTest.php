<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class PendidikanControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\Pendidikan::class;
    }

    public function viewpath()
    {
        return url('master/pendidikan');
    }
}
