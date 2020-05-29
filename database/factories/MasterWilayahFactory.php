<?php

use Faker\Generator as Faker;
use App\Models\Master\Wilayah\Provinsi;
use App\Models\Master\Wilayah\Kecamatan;
use App\Models\Master\Wilayah\Kelurahan;
use App\Models\Master\Wilayah\KotaKabupaten;

$factory->define(Provinsi::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->state
    ];
});

$factory->define(KotaKabupaten::class, function (Faker $faker) {
    return [
        'provinsi_id' => function () {
            return factory(Provinsi::class)->create()->id;
        },
        'name' => $faker->unique()->city,
    ];
});

$factory->define(Kecamatan::class, function (Faker $faker) {
    return [
        'kota_kabupaten_id' => function () {
            return factory(KotaKabupaten::class)->create()->id;
        },
        'name' => $faker->unique()->city,
    ];
});

$factory->define(Kelurahan::class, function (Faker $faker) {
    return [
        'kecamatan_id' => function () {
            return factory(Kecamatan::class)->create()->id;
        },
        'name' => $faker->unique()->city,
    ];
});
