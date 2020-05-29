<?php

namespace App\Http\Queries\Logistik;

use Sty\HttpQuery;

class LogistikQuery extends HttpQuery
{
    public function jenis($builder, $value)
    {
        return $builder->where('jenis_id', $value);
    }

    public function stock($builder, $value = null)
    {
        return $builder->stock($value);
    }
}
