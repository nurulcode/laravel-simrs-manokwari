<?php

namespace Tests\Feature\Layanan;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class PenunjangControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Layanan\Penunjang::class;
    }
}
