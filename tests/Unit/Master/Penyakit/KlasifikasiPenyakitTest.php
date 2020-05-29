<?php

namespace Tests\Unit\Master\Penyakit;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class KlasifikasiPenyakitTest extends TestCase
{
    /** @test */
    public function resource_may_has_many_kelompok()
    {
        $klasifikasi = factory(KlasifikasiPenyakit::class)->create();

        factory(KelompokPenyakit::class, 10)->create([
            'klasifikasi_id' => $klasifikasi->id
        ]);

        $this->assertInstanceOf(Collection::class, $klasifikasi->kelompok);
        $this->assertInstanceOf(KelompokPenyakit::class, $klasifikasi->kelompok->random());
    }
}
