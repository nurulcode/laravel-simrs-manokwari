<?php

namespace App\Http\Queries\Fasilitas;

use Sty\HttpQuery;

class RuanganQuery extends HttpQuery
{
    public function poliklinik($builder, $value)
    {
        return $builder->where('poliklinik_id', $value);
    }
}
