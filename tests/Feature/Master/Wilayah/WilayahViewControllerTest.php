<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;

class WilayahViewControllerTest extends TestCase
{
    use ResourceViewTestCase;

    public function viewpath()
    {
        return url('master/wilayah');
    }
}
