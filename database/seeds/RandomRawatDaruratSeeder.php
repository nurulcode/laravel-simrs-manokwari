<?php

use App\Models\Kunjungan;
use Illuminate\Database\Seeder;
use App\Enums\KategoriRegistrasi;
use App\Models\Master\JenisRegistrasi;
use App\Models\Perawatan\RawatDarurat;

class RandomRawatDaruratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kunjungan    = factory(Kunjungan::class)->states('real')->create();

        $rawatdarurat = factory(RawatDarurat::class)->states('real')->create();

        $jenis_registrasi = JenisRegistrasi::inRandomOrder()
            ->where('kategori', KategoriRegistrasi::GAWAT_DARURAT)
            ->first();

        $rawatdarurat->registrasi()->create([
            'jenis_registrasi_id' => $jenis_registrasi->id,
            'kunjungan_id'        => $kunjungan->id
        ]);
    }
}
