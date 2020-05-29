<?php

use App\Seeder;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Models\Master\Wilayah\KotaKabupaten;

class MasterDataWilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            Provinsi::class      => ['master/wilayah/provinsi.csv', 34],
            KotaKabupaten::class => ['master/wilayah/kotakab.csv', 514],
            Kecamatan::class     => ['master/wilayah/kecamatan.csv', 7215],
            Kelurahan::class     => ['master/wilayah/kelurahan.csv', 80534],
        ]);
    }
}
