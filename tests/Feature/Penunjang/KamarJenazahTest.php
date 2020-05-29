<?php

namespace Tests\Feature\Penunjang;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;

class KamarJenazahTest extends TestCase
{
    use ResourceViewTestCase;

    public function viewpath()
    {
        return url('penunjang/kamar-jenazah');
    }
}
