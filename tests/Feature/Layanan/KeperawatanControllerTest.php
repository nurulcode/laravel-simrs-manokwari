<?php

namespace Tests\Feature\Layanan;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KeperawatanControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Layanan\Keperawatan::class;
    }
}
