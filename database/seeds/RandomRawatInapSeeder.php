<?php

use App\Models\Kunjungan;
use Illuminate\Database\Seeder;
use App\Enums\KategoriRegistrasi;
use App\Models\Perawatan\RawatInap;
use App\Models\Master\JenisRegistrasi;

class RandomRawatInapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kunjungan  = factory(Kunjungan::class)->states('real')->create();

        $rawatinap  = factory(RawatInap::class)->states('real')->create();

        $registrasi = JenisRegistrasi::inRandomOrder()
            ->where('kategori', KategoriRegistrasi::RAWAT_INAP)
            ->first();

        $rawatinap->registrasi()->create([
            'jenis_registrasi_id' => $registrasi->id,
            'kunjungan_id'        => $kunjungan->id
        ]);
    }
}
