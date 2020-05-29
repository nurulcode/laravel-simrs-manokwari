<?php

use App\Models\Kunjungan;
use Illuminate\Database\Seeder;
use App\Enums\KategoriRegistrasi;
use App\Models\Perawatan\RawatJalan;
use App\Models\Master\JenisRegistrasi;

class RandomRawatJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kunjungan  = factory(Kunjungan::class)->states('real')->create();

        $rawatjalan = factory(RawatJalan::class)->states('real')->create();

        $jenis_registrasi = JenisRegistrasi::inRandomOrder()
            ->where('kategori', KategoriRegistrasi::RAWAT_JALAN)
            ->first();

        $rawatjalan->registrasi()->create([
            'jenis_registrasi_id' => $jenis_registrasi->id,
            'kunjungan_id'        => $kunjungan->id
        ]);
    }
}
