<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class TipeDiagnosaControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\TipeDiagnosa::class;
    }

    public function viewpath()
    {
        return url('master/tipe-diagnosa');
    }
}
