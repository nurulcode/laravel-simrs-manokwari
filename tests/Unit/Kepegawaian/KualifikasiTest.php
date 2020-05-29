<?php

namespace Tests\Unit\Kepegawaian;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Kualifikasi;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KualifikasiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_kategori()
    {
        $kualifikasi = factory(Kualifikasi::class)->create();

        $this->assertInstanceof(KategoriKualifikasi::class, $kualifikasi->kategori);
    }

    /** @test */
    public function resource_may_has_many_pegawai()
    {
        $kualifikasi = factory(Kualifikasi::class)->create();

        factory(Pegawai::class, 10)->create(['kualifikasi_id' => $kualifikasi->id]);

        $this->assertInstanceOf(Collection::class, $kualifikasi->pegawais);
        $this->assertInstanceOf(Pegawai::class, $kualifikasi->pegawais->random());
    }
}
