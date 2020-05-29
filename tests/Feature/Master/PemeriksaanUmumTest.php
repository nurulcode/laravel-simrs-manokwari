<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;

class PemeriksaanUmumTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Master\PemeriksaanUmum::class;
    }

    public function viewpath()
    {
        return url('master/pemeriksaan-umum');
    }
}
