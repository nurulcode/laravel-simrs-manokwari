<?php

namespace Tests\Feature\Logistik;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;

class PenerimaanControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Logistik\Penerimaan::class;
    }

    public function viewpath()
    {
        return url('logistik/penerimaan');
    }
}
