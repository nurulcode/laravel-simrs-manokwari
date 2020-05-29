<?php

use App\Enums\JenisKelamin;
use App\Models\Kepegawaian;
use Faker\Generator as Faker;

$factory->define(Kepegawaian\Jabatan::class, function (Faker $faker) {
    return ['uraian' => $faker->sentence];
});

$factory->define(Kepegawaian\KategoriKualifikasi::class, function (Faker $faker) {
    return [
        'kode'         => $faker->unique()->swiftBicNumber,
        'tenaga_medis' => $faker->boolean,
        'uraian'       => $faker->sentence,
    ];
});

$factory->define(Kepegawaian\Kualifikasi::class, function (Faker $faker) {
    return [
        'kategori_id' => function () {
            return factory(Kepegawaian\KategoriKualifikasi::class)->create()->id;
        },
        'kode'        => $faker->unique()->swiftBicNumber,
        'uraian'      => $faker->sentence,
        'laki_laki'   => $faker->randomDigit,
        'perempuan'   => $faker->randomDigit
    ];
});

$factory->define(Kepegawaian\Pegawai::class, function (Faker $faker) {
    return [
        'jabatan_id'     => function () {
            return factory(Kepegawaian\Jabatan::class)->create()->id;
        },
        'kualifikasi_id' => function () {
            return factory(Kepegawaian\Kualifikasi::class)->create()->id;
        },
        'nama'           => $faker->name,
        'tempat_lahir'   => $faker->city,
        'tanggal_lahir'  => $faker->date,
        'jenis_kelamin'  => JenisKelamin::getRandomValue(),
        'alamat'         => $faker->address,
        'telepon'        => $faker->phoneNumber,
    ];
});
