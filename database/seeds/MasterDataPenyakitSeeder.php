<?php

use App\Seeder;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

class MasterDataPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            KlasifikasiPenyakit::class  => ['master/penyakit/klasifikasi_penyakit.csv', 22],
            KelompokPenyakit::class     => ['master/penyakit/kelompok_penyakit.csv', 537],
            Penyakit::class             => ['master/penyakit/penyakit.csv', 13309],
        ]);
    }
}
