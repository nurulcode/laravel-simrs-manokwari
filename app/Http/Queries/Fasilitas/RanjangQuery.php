<?php

namespace App\Http\Queries\Fasilitas;

use Sty\HttpQuery;

class RanjangQuery extends HttpQuery
{
    public function kamar($builder, $value)
    {
        return $builder->where('ranjangs.kamar_id', $value);
    }

    public function kosong($builder, $value = false)
    {
        return $builder->whereDoesntHave('layanan_kamar', function ($query) {
            $query->whereNull('waktu_keluar');
        });
    }
}
