<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class PekerjaanTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\Pekerjaan::class;
    }

    public function viewpath()
    {
        return url('master/pekerjaan');
    }
}
