<?php

use App\Models\Master;
use App\Models\Layanan;
use App\Models\Perawatan;
use App\Enums\KasusDiagnosa;
use Faker\Generator as Faker;
use App\Models\Fasilitas\Ranjang;
use App\Models\Logistik\Logistik;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Fasilitas\Poliklinik;

$perawatans = [
    Perawatan\RawatJalan::class,
    Perawatan\RawatInap::class,
    Perawatan\RawatDarurat::class,
];

$factory->define(Layanan\Diagnosa::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($diagnosa) {
            return factory($diagnosa['perawatan_type'])->create()->id;
        },
        'penyakit_id' => function () {
            return factory(Master\Penyakit\Penyakit::class)->create()->id;
        },
        'tipe_diagnosa_id' => function () {
            return factory(Master\TipeDiagnosa::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'lama_menderita' => $faker->word,
        'kasus'          => KasusDiagnosa::getRandomValue(),
        'waktu'           => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\Gizi::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'gizi_id'     => function ($pemeriksaan) {
            return factory(Master\Gizi::class)->create()->id;
        },
        'petugas_id'     => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});

$factory->define(Layanan\Kamar::class, function (Faker $faker) {
    return [
        'perawatan_type' => Perawatan\RawatInap::class,
        'perawatan_id'   => function () {
            return factory(Perawatan\RawatInap::class)->create()->id;
        },
        'ranjang_id'     => function () {
            return factory(Ranjang::class)->create()->id;
        },
        'waktu_masuk'    => $faker->dateTimeThisMonth,
        'tarif'          => '{}'
    ];
});

$factory->define(Layanan\Kebidanan::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'kegiatan_id'    => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});

$factory->define(Layanan\Keperawatan::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'perawatan_khusus_id' => function ($pemeriksaan) {
            return factory(Master\PerawatanKhusus::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});

$factory->define(Layanan\Laundry::class, function (Faker $faker) {
    return [
        'perawatan_type'   => Perawatan\RawatInap::class,
        'perawatan_id'     => function () {
            return factory(Perawatan\RawatInap::class)->create()->id;
        },
        'jenis_laundry_id' => function () {
            return factory(Master\JenisLaundry::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});

$factory->define(Layanan\Oksigen::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'oksigen_id'     => function ($pemeriksaan) {
            return factory(Master\Oksigen::class)->create()->id;
        },
        'petugas_id'     => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});

$factory->define(Layanan\Pemeriksaan::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'pemeriksaan_umum_id' => function ($pemeriksaan) {
            return factory(Master\PemeriksaanUmum::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'hasil' => $faker->randomNumber,
        'waktu' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\Penunjang::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'poliklinik_id' => function () {
            return factory(Poliklinik::class)->create()->id;
        },
        'waktu' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\PenunjangTindakan::class, function (Faker $faker) {
    $tindakans = [
        Master\Kegiatan::class
    ];

    return [
        'penunjang_id' => function () {
            return factory(Layanan\Penunjang::class)->create()->id;
        },
        'tindakan_type' => $faker->randomElement($tindakans),
        'tindakan_id'   => function ($tindakan) {
            return factory($tindakan['tindakan_type'])->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\Perinatologi::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'kegiatan_id'    => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'  => $faker->dateTimeThisMonth,
        'jumlah' => $faker->randomNumber,
    ];
});

$factory->define(Layanan\Resep::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
    ];
});

$factory->define(Layanan\ResepDetail::class, function (Faker $faker) {
    return [
        'resep_id' => function () {
            return factory(Layanan\Resep::class)->create()->id;
        },
        'obat_id'        => function () {
            return factory(Logistik::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'jumlah' => $faker->randomNumber,
        'aturan_pakai' => $faker->word,
        'waktu'  => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\Tindakan::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'tindakan_pemeriksaan_id' => function ($tindakan) {
            return factory(Master\TindakanPemeriksaan::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'jumlah' => $faker->randomNumber,
        'waktu'  => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Layanan\Visite::class, function (Faker $faker) use ($perawatans) {
    return [
        'perawatan_type' => $faker->randomElement($perawatans),
        'perawatan_id'   => function ($tindakan) {
            return factory($tindakan['perawatan_type'])->create()->id;
        },
        'jenis_visite_id' => function ($pemeriksaan) {
            return factory(Master\JenisVisite::class)->create()->id;
        },
        'petugas_id' => function () {
            return factory(Pegawai::class)->create()->id;
        },
        'waktu'           => $faker->dateTimeThisMonth,
    ];
});
