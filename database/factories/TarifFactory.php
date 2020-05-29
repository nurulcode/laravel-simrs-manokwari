<?php

use Faker\Generator as Faker;
use App\Models\Master\TindakanPemeriksaan;

$factory->define(App\Models\Tarif::class, function (Faker $faker) {
    $tarifable = [
        TindakanPemeriksaan::class,
    ];

    return [
        'tarifable_id'   => function ($tarif) {
            return factory($tarif['tarifable_type'])->create()->id;
        },
        'tarifable_type' => $faker->randomElement($tarifable),
        'data'           => ''
    ];
});
