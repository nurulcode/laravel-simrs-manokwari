<?php

use App\Models\Logistik;
use App\Enums\GolonganObat;
use Faker\Generator as Faker;
use App\Models\Master\JenisLogistik;
use App\Enums\SistemPembayaran;
use App\Models\Fasilitas\Poliklinik;
use App\Enums\JenisTransaksi;

$factory->define(Logistik\Logistik::class, function (Faker $faker) {
    return [
        'uraian'   => $faker->sentence,
        'satuan'   => $faker->word,
        'jenis_id' => function () {
            return factory(JenisLogistik::class)->create()->id;
        },
        'golongan'   => GolonganObat::getRandomValue(),
        'harga_jual' => $faker->randomNumber
    ];
});

$factory->define(Logistik\Suplier::class, function (Faker $faker) {
    return [
        'nama'       => $faker->company,
        'alamat'     => $faker->address,
        'no_telepon' => $faker->phoneNumber
    ];
});

$factory->define(Logistik\Penerimaan::class, function (Faker $faker) {
    return [
        'suplier_id' => function () {
            return factory(Logistik\Suplier::class)->create()->id;
        },
        'no_faktur'         => $faker->unique()->swiftBicNumber,
        'sistem_pembayaran' => SistemPembayaran::getRandomValue(),
        'tanggal_faktur'    => $faker->dateTimeThisMonth,
        'jatuh_tempo'       => $faker->dateTimeThisMonth,
        'tanggal_terima'    => $faker->dateTimeThisMonth,
    ];
});

$factory->define(Logistik\Transaksi::class, function (Faker $faker) {
    $type = [
        Logistik\Penerimaan::class
    ];

    return [
        'jenis'       => $faker->randomElement(JenisTransaksi::getValues()),
        'faktur_type' => $faker->randomElement($type),
        'faktur_id'   => function ($transaksi) {
            return factory($transaksi['faktur_type'])->create()->id;
        },
        'apotek_id' => function () {
            return factory(Poliklinik::class)->create()->id;
        },
        'logistik_id' => function () {
            return factory(Logistik\Logistik::class)->create()->id;
        },
        'jumlah' => $faker->randomNumber,
        'harga'  => $faker->randomNumber
    ];
});
