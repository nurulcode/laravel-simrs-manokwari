<?php

namespace Tests\Unit\Master\Penyakit;

use Tests\TestCase;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Master\Penyakit\KelompokPenyakit;

class PenyakitTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kelompok()
    {
        $penyakit = factory(Penyakit::class)->create();

        $this->assertInstanceof(KelompokPenyakit::class, $penyakit->kelompok);
    }
}
