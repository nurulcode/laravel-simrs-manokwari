<?php

namespace App\Http\Queries\Master;

use Sty\HttpQuery;

class WilayahQuery extends HttpQuery
{
    public function provinsi($builder, $value)
    {
        return $builder->where('provinsi_id', $value);
    }

    public function kota_kabupaten($builder, $value)
    {
        return $builder->where('kota_kabupaten_id', $value);
    }

    public function kecamatan($builder, $value)
    {
        return $builder->where('kelurahans.kecamatan_id', $value);
    }
}
