<?php

namespace Tests\Feature\Penunjang;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;

class LaboratoriumTest extends TestCase
{
    use ResourceViewTestCase;

    public function viewpath()
    {
        return url('penunjang/laboratorium');
    }
}
