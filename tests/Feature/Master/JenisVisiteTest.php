<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Tests\Feature\TarifableTestCase;
use Sty\Tests\ResourceControllerTestCase;

class JenisVisiteTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Master\JenisVisite::class;
    }

    public function viewpath()
    {
        return url('master/jenis-visite');
    }
}
