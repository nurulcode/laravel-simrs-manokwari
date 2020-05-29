<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class LogistikControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Logistik\Logistik::class;
    }
}
