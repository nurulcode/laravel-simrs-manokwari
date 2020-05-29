<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;
use Tests\Feature\TarifableTestCase;

class PemeriksaanJenazahTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Master\PemeriksaanJenazah::class;
    }

    public function viewpath()
    {
        return url('master/pemeriksaan-jenazah');
    }
}
