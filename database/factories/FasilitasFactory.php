<?php

use Faker\Generator as Faker;
use App\Models\Fasilitas\Kamar;
use App\Models\Fasilitas\Ranjang;
use App\Models\Fasilitas\Ruangan;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\JenisPoliklinik;
use App\Enums\KelasRuangan;
use App\Enums\JenisRuangan;

$factory->define(Poliklinik::class, function (Faker $faker) {
    return [
        'jenis_id' => function () {
            return factory(JenisPoliklinik::class)->create()->id;
        },
        'kode'     => strtoupper(substr($faker->unique()->swiftBicNumber, 0, 12)),
        'nama'     => $faker->sentence(2),
    ];
});

$factory->define(Ruangan::class, function (Faker $faker) {
    return [
        'poliklinik_id' => function () {
            return factory(Poliklinik::class)->create()->id;
        },
        'kode'  => $faker->unique()->swiftBicNumber,
        'nama'  => $faker->word,
        'kelas' => KelasRuangan::getRandomValue(),
        'jenis' => JenisRuangan::getRandomValue()
    ];
});

$factory->define(Kamar::class, function (Faker $faker) {
    return [
        'ruangan_id' => function () {
            return factory(Ruangan::class)->create()->id;
        },
        'nama'  => $faker->word,
    ];
});

$factory->define(Ranjang::class, function (Faker $faker) {
    return [
        'kamar_id' => function () {
            return factory(Kamar::class)->create()->id;
        },
        'kode'  => $faker->unique()->swiftBicNumber,
    ];
});
