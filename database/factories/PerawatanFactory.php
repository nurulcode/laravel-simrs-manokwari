<?php

use App\Enums;
use App\Models\Master;
use App\Models\Fasilitas;
use App\Models\Perawatan;
use Faker\Generator as Faker;

$factory->define(Perawatan\RawatJalan::class, function (Faker $faker) {
    return [
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'poliklinik_id' => function () {
            return factory(Fasilitas\Poliklinik::class)->create()->id;
        },
    ];
});

$factory->define(Perawatan\RawatDarurat::class, function (Faker $faker) {
    return [
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'poliklinik_id' => function () {
            return factory(Fasilitas\Poliklinik::class)->create()->id;
        },
    ];
});

$factory->define(Perawatan\RawatInap::class, function (Faker $faker) {
    return [
        'kegiatan_id' => function () {
            return factory(Master\Kegiatan::class)->create()->id;
        },
        'ranjang_id'  => function () {
            return factory(Fasilitas\Ranjang::class)->create()->id;
        },
        'cara_penerimaan' => Enums\CaraPenerimaan::getRandomValue(),
        'aktifitas'       => Enums\Aktifitas::getRandomValue()
    ];
});

$factory->state(Perawatan\RawatJalan::class, 'real', [
    'kegiatan_id' => function () {
        return Master\Kegiatan::inRandomOrder()
            ->first()
            ->id;
    },
    'poliklinik_id' => function () {
        return Fasilitas\Poliklinik::where('jenis_id', 1)
            ->inRandomOrder()
            ->first()
            ->id;
    },
]);

$factory->state(Perawatan\RawatDarurat::class, 'real', [
    'kegiatan_id' => function () {
        return Master\Kegiatan::inRandomOrder()
            ->first()
            ->id;
    },
    'poliklinik_id' => function () {
        return Fasilitas\Poliklinik::where('jenis_id', 2)
            ->inRandomOrder()
            ->first()
            ->id;
    },
]);

$factory->state(Perawatan\RawatInap::class, 'real', [
    'kegiatan_id' => function () {
        return Master\Kegiatan::inRandomOrder()
            ->first()
            ->id;
    },
    'ranjang_id'      => function () {
        return Fasilitas\Ranjang::inRandomOrder()->first()->id;
    },
    'cara_penerimaan' => Enums\CaraPenerimaan::getRandomValue(),
    'aktifitas'       => Enums\Aktifitas::getRandomValue()
]);
