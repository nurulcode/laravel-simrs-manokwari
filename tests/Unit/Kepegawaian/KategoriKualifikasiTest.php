<?php

namespace Tests\Unit\Kepegawaian;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Kepegawaian\Kualifikasi;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KategoriKualifikasiTest extends TestCase
{
    /** @test */
    public function resource_may_has_many_kualifikasi()
    {
        $kategori = factory(KategoriKualifikasi::class)->create();

        factory(Kualifikasi::class, 10)->create(['kategori_id' => $kategori->id]);

        $this->assertInstanceOf(Collection::class, $kategori->kualifikasis);
        $this->assertInstanceOf(Kualifikasi::class, $kategori->kualifikasis->random());
    }
}
