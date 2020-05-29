<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;
use Tests\Feature\TarifableTestCase;

class TindakanOperasiTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase, TarifableTestCase;

    public function resource()
    {
        return \App\Models\Master\TindakanOperasi::class;
    }

    public function viewpath()
    {
        return url('master/tindakan-operasi');
    }
}
