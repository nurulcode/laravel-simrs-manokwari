<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class SuplierControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Logistik\Suplier::class;
    }

    public function viewpath()
    {
        return url('suplier');
    }
}
