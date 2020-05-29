<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Tests\Feature\TarifableTestCase;
use Sty\Tests\ResourceControllerTestCase;

class JenisRegistrasiTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Master\JenisRegistrasi::class;
    }

    public function viewpath()
    {
        return url('master/jenis-registrasi');
    }
}
