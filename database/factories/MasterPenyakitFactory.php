<?php

use Faker\Generator as Faker;
use App\Models\Master\Penyakit\Penyakit;
use App\Models\Master\Penyakit\KelompokPenyakit;
use App\Models\Master\Penyakit\KlasifikasiPenyakit;

$factory->define(KlasifikasiPenyakit::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->swiftBicNumber,
        'uraian' => $faker->sentence
    ];
});

$factory->define(KelompokPenyakit::class, function (Faker $faker) {
    return [
        'klasifikasi_id' => function () {
            return factory(KlasifikasiPenyakit::class)->create()->id;
        },
        'kode'   => strtoupper(substr($faker->unique()->swiftBicNumber, 0, 12)),
        'icd'    => strtoupper(substr($faker->unique()->swiftBicNumber, 0, 12)),
        'uraian' => $faker->sentence('4')
    ];
});

$factory->define(Penyakit::class, function (Faker $faker) {
    return [
        'kelompok_id' => function () {
            return factory(KelompokPenyakit::class)->create()->id;
        },
        'icd'    => strtoupper(substr($faker->unique()->swiftBicNumber, 0, 12)),
        'uraian' => $faker->sentence('4')
    ];
});
