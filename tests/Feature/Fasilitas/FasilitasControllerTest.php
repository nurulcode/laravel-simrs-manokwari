<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;

class FasilitasControllerTest extends TestCase
{
    use ResourceViewTestCase;

    public function viewpath()
    {
        return url('fasilitas');
    }
}
