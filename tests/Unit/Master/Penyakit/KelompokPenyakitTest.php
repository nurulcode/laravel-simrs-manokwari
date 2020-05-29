<?php

namespace Tests\Unit\Master\Penyakit;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class KelompokPenyakitTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_klasifikasi()
    {
        $kelompok = factory(KelompokPenyakit::class)->create();

        $this->assertInstanceof(KlasifikasiPenyakit::class, $kelompok->klasifikasi);
    }

    /** @test */
    public function resource_may_has_many_penyakit()
    {
        $kelompok = factory(KelompokPenyakit::class)->create();

        factory(Penyakit::class, 10)->create([
            'kelompok_id' => $kelompok->id
        ]);

        $this->assertInstanceOf(Collection::class, $kelompok->penyakit);
        $this->assertInstanceOf(Penyakit::class, $kelompok->penyakit->random());
    }
}
