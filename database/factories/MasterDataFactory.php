<?php
use App\Models\Master;
use Faker\Generator as Faker;
use App\Enums\KategoriRegistrasi;
use App\Enums\JenisTindakanPemeriksaan;
use App\Enums\PeriodePemeriksaan;
use App\Enums\JenisOperasi;

$generic_factory = function (Faker $faker) {
    return [
        'uraian' => $faker->sentence
    ];
};

$factory->define(Master\Agama::class, $generic_factory);
$factory->define(Master\Gizi::class, $generic_factory);
$factory->define(Master\JenisIdentitas::class, $generic_factory);
$factory->define(Master\JenisLogistik::class, $generic_factory);
$factory->define(Master\JenisPoliklinik::class, $generic_factory);
$factory->define(Master\JenisRujukan::class, $generic_factory);
$factory->define(Master\JenisVisite::class, $generic_factory);
$factory->define(Master\KategoriKegiatan::class, $generic_factory);
$factory->define(Master\Kegiatan::class, $generic_factory);
$factory->define(Master\Oksigen::class, $generic_factory);
$factory->define(Master\Pekerjaan::class, $generic_factory);
$factory->define(Master\PemeriksaanJenazah::class, $generic_factory);
$factory->define(Master\Pendidikan::class, $generic_factory);
$factory->define(Master\Suku::class, $generic_factory);
$factory->define(Master\TipeDiagnosa::class, $generic_factory);

$factory->define(Master\CaraPembayaran::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->swiftBicNumber,
        'uraian' => $faker->sentence
    ];
});

$factory->define(Master\Insenerator::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->swiftBicNumber,
        'uraian' => $faker->sentence,
        'satuan' => substr($faker->word, 0, 6)
    ];
});

$factory->define(Master\JenisLaundry::class, function (Faker $faker) {
    return [
        'uraian'  => $faker->sentence,
        'satuan'  => substr($faker->word, 0, 6)
    ];
});

$factory->define(Master\JenisRegistrasi::class, function (Faker $faker) {
    return [
        'uraian'          => $faker->sentence,
        'kategori'        => KategoriRegistrasi::getRandomValue(),
    ];
});

$factory->define(Master\Kasus::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->swiftBicNumber,
        'uraian' => $faker->sentence
    ];
});

$factory->define(Master\PemeriksaanUmum::class, function (Faker $faker) {
    return [
        'kode'    => $faker->unique()->swiftBicNumber,
        'uraian'  => $faker->sentence,
        'satuan'  => $faker->word,
        'periode' => $faker->randomElement(PeriodePemeriksaan::getValues())
    ];
});

$factory->define(Master\PerawatanKhusus::class, function (Faker $faker) {
    return [
        'kode'    => $faker->unique()->swiftBicNumber,
        'uraian'  => $faker->sentence,
    ];
});

$factory->define(Master\Prosedur::class, function (Faker $faker) {
    return [
        'kode'    => $faker->unique()->swiftBicNumber,
        'uraian'  => $faker->sentence,
    ];
});

$factory->define(Master\TindakanOperasi::class, function (Faker $faker) {
    return [
        'kode'   => $faker->unique()->swiftBicNumber,
        'uraian' => $faker->sentence,
        'jenis'  => JenisOperasi::getRandomValue()
    ];
});

$factory->define(Master\TindakanPemeriksaan::class, function (Faker $faker) {
    return [
        'prosedur_id' => function () {
            return factory(Master\Prosedur::class);
        },
        'kode'        => $faker->unique()->swiftBicNumber,
        'uraian'      => $faker->sentence,
        'jenis'       => $faker->randomElement(JenisTindakanPemeriksaan::getValues()),
    ];
});

$factory->define(Master\Utdrs::class, function (Faker $faker) {
    return [
        'kode'    => $faker->unique()->swiftBicNumber,
        'uraian'  => $faker->sentence,
    ];
});
