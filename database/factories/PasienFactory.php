<?php

use App\Models\Master;
use App\Enums\JenisKelamin;
use App\Enums\GolonganDarah;
use Faker\Generator as Faker;
use App\Enums\StatusPernikahan;

$factory->define(App\Models\Pasien::class, function (Faker $faker) {
    return [
        'jenis_identitas_id' => function () {
            return factory(Master\JenisIdentitas::class)->create()->id;
        },
        'nomor_identitas'    => $faker->unique()->swiftBicNumber,
        'tanggal_registrasi' => $faker->date,
        'nama'               => $faker->name,
        'tempat_lahir'       => $faker->city,
        'tanggal_lahir'      => $faker->date,
        'jenis_kelamin'      => JenisKelamin::getRandomValue(),
        'golongan_darah'     => GolonganDarah::getRandomValue(),
        'agama_id'           => function () {
            return factory(Master\Agama::class)->create()->id;
        },
        'suku_id' => function () {
            return factory(Master\Suku::class)->create()->id;
        },
        'pendidikan_id' => function () {
            return factory(Master\Pendidikan::class)->create()->id;
        },
        'pekerjaan_id' => function () {
            return factory(Master\Pekerjaan::class)->create()->id;
        },
        'kelurahan_id' => function () {
            return factory(Master\Wilayah\Kelurahan::class)->create()->id;
        },
        'alamat'            => $faker->address,
        'telepon'           => $faker->phoneNumber,
        'nama_ayah'         => $faker->name('male'),
        'nama_ibu'          => $faker->name('female'),
        'alamat_keluarga'   => $faker->address,
        'telepon_keluarga'  => $faker->phoneNumber,
        'status_pernikahan' => StatusPernikahan::getRandomValue(),
        'nama_pasangan'     => $faker->name
    ];
});
