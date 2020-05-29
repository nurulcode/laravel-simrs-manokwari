<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\Kegiatan;
use Illuminate\Support\Collection;
use App\Models\Master\KategoriKegiatan;

class KategoriKegiatanTest extends TestCase
{
    /** @test */
    public function a_kategori_may_have_many_kegiatan()
    {
        $kategori = factory(KategoriKegiatan::class)->create();
        $kegiatan = factory(Kegiatan::class, 5)->create();

        $kategori->kegiatan()->attach(
            $kegiatan->pluck('id')->flip()->map(function ($value, $key) {
                return ['kode' => str_random(5)];
            })
        );

        $this->assertInstanceOf(Collection::class, $kategori->kegiatan);

        $this->assertInstanceOf(Kegiatan::class, $kategori->kegiatan->random());
    }
}
