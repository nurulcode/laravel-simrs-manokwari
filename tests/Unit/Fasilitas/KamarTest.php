<?php

namespace Tests\Unit\Fasilitas;

use Tests\TestCase;
use App\Models\Fasilitas;
use Illuminate\Support\Collection;

class KamarTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_ruangan()
    {
        $kamar = factory(Fasilitas\Kamar::class)->create();

        $this->assertInstanceof(Fasilitas\Ruangan::class, $kamar->ruangan);
    }

    /** @test */
    public function resource_may_has_many_ranjang()
    {
        $kamar = factory(Fasilitas\Kamar::class)->create();

        factory(Fasilitas\Ranjang::class, 10)->create(['kamar_id' => $kamar->id]);

        $this->assertInstanceOf(Collection::class, $kamar->ranjangs);

        $this->assertInstanceOf(Fasilitas\Ranjang::class, $kamar->ranjangs->random());
    }

    /** @test */
    public function a_kamar_have_virtual_poliklinik_id()
    {
        $kamar = factory(Fasilitas\Kamar::class)->create();

        $kamar = Fasilitas\Kamar::find($kamar->id);

        $this->assertSame($kamar->ruangan->poliklinik_id, $kamar->poliklinik_id);
    }

    /** @test */
    public function resource_belongs_to_poliklinik()
    {
        $kamar = factory(Fasilitas\Kamar::class)->create();

        $kamar = Fasilitas\Kamar::find($kamar->id);

        $this->assertInstanceof(Fasilitas\Poliklinik::class, $kamar->poliklinik);
    }
}
