<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Master\Kegiatan;
use Illuminate\Support\Collection;
use App\Models\Master\KategoriKegiatan as Kategori;

class KegiatanTest extends TestCase
{
    /** @test */
    public function a_kegiatan_may_have_many_kategori()
    {
        $kegiatan = factory(Kegiatan::class)->create();
        $kategori = factory(Kategori::class, 5)->create();

        $kegiatan->kategori()->attach(
            $kategori->pluck('id')->flip()->map(function ($value, $key) {
                return ['kode' => str_random(5)];
            })
        );

        $this->assertInstanceOf(Collection::class, $kegiatan->kategori);

        $this->assertInstanceOf(Kategori::class, $kegiatan->kategori->random());
    }

    /** @test */
    public function a_kegiatan_belongs_to_itself()
    {
        $kegiatan = factory(Kegiatan::class)->create([
            'parent_id' => function () {
                return factory(Kegiatan::class)->create()->id;
            }
        ]);

        $this->assertInstanceof(Kegiatan::class, $kegiatan->parent);
    }
}
