<?php

namespace App;

use App\Models\Master\Kegiatan;

class KegiatanKategori
{
    public static function create(array $data)
    {
        $kegiatan = Kegiatan::create(array_except($data, ['kategori']));

        $kegiatan  = self::assign($kegiatan, array_get($data, 'kategori', []));

        return $kegiatan;
    }

    public static function update(Kegiatan $kegiatan, array $data)
    {
        $kegiatan->update(array_except($data, 'kategori'));

        $kegiatan  = self::assign($kegiatan, array_get($data, 'kategori', []));

        return $kegiatan;
    }

    public static function assign(Kegiatan $kegiatan, $data)
    {
        $kegiatan->kategori()->sync(
            collect($data)->keyBy('id')->map(function ($kategori) {
                return ['kode' => $kategori['kode']];
            })->toArray()
        );

        return $kegiatan;
    }
}
