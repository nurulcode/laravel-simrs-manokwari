<?php

namespace Tests\Unit\Master\Wilayah;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\KotaKabupaten;

class ProvinsiTest extends TestCase
{
    /** @test */
    public function a_provinsi_may_has_many_kota_kabupaten()
    {
        $provinsi = factory(Provinsi::class)->create();

        factory(KotaKabupaten::class, 10)->create([
            'provinsi_id' => $provinsi->id
        ]);

        $this->assertInstanceOf(Collection::class, $provinsi->kota_kabupaten);
        $this->assertInstanceOf(KotaKabupaten::class, $provinsi->kota_kabupaten->random());
    }
}
