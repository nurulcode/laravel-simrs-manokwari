<?php

namespace Tests\Unit\Master\Wilayah;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\KotaKabupaten;

class KotaKabupatenTest extends TestCase
{
    /** @test */
    public function a_kotakab_belongs_to_provinsi()
    {
        $kotakab = factory(KotaKabupaten::class)->create();

        $this->assertInstanceof(Provinsi::class, $kotakab->provinsi);
    }

    /** @test */
    public function a_kota_kabupaten_may_has_many_kecamatan()
    {
        $kota_kabupaten = factory(KotaKabupaten::class)->create();

        factory(Kecamatan::class, 10)->create([
            'kota_kabupaten_id' => $kota_kabupaten->id
        ]);

        $this->assertInstanceOf(Collection::class, $kota_kabupaten->kecamatans);
        $this->assertInstanceOf(Kecamatan::class, $kota_kabupaten->kecamatans->random());
    }
}
