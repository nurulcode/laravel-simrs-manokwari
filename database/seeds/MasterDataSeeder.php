<?php

use App\Seeder;
use App\Models\Master;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            Master\Agama::class                => ['master/agama.csv', 7],
            Master\CaraPembayaran::class       => ['master/cara_bayars.csv', 9],
            Master\Gizi::class                 => ['master/gizi.csv', 3],
            Master\Insenerator::class          => ['master/insenerator.csv', 2],
            Master\JenisIdentitas::class       => ['master/jenis_identitas.csv', 10],
            Master\JenisLaundry::class         => ['master/jenis_laundry.csv', 1],
            Master\JenisLogistik::class        => ['master/jenis_logistiks.csv', 3],
            Master\JenisPoliklinik::class      => ['master/jenis_poliklinik.csv', 12],
            Master\JenisRegistrasi::class      => ['master/jenis_registrasi.csv', 7],
            Master\JenisRujukan::class         => ['master/jenis_rujukan.csv', 7],
            Master\JenisVisite::class          => ['master/jenis_visite.csv', 2],
            Master\Kasus::class                => ['master/kasus.csv', 9],
            Master\KategoriKegiatan::class     => ['master/kegiatan/kategori.csv', 13],
            Master\Kegiatan::class             => ['master/kegiatan/kegiatan.csv', 373],
            Master\Oksigen::class              => ['master/oksigen.csv', 2],
            Master\Pekerjaan::class            => ['master/pekerjaan.csv', 13],
            Master\PemeriksaanJenazah::class   => ['master/pemeriksaan_jenazah.csv', 2],
            Master\PemeriksaanUmum::class      => ['master/pemeriksaan_umum.csv', 5],
            Master\Pendidikan::class           => ['master/pendidikan.csv', 10],
            Master\PerawatanKhusus::class      => ['master/perawatan_khusus.csv', 18],
            Master\Prosedur::class             => ['master/prosedurs.csv', 3911],
            Master\Suku::class                 => ['master/suku.csv', 15],
            Master\TindakanOperasi::class      => ['master/tindakan_operasi.csv', 164],
            Master\TindakanPemeriksaan::class  => ['master/tindakan_pemeriksaan.csv', 428],
            Master\TipeDiagnosa::class         => ['master/tipe_diagnosa.csv', 7],
            Master\Utdrs::class                => ['master/utdrs.csv', 7],
        ]);
    }
}
