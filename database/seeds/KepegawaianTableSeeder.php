<?php

use App\Seeder;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Kualifikasi;
use App\Models\Kepegawaian\KategoriKualifikasi;

class KepegawaianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            KategoriKualifikasi::class  => ['kepegawaian/kategori.csv', 13],
            Jabatan::class              => ['kepegawaian/jabatans.csv', 9],
            Kualifikasi::class          => ['kepegawaian/kualifikasis.csv', 167],
            Pegawai::class              => ['kepegawaian/pegawais.csv', 301],
        ]);
    }
}
