<?php

namespace App\Http\Queries\Logistik;

use Sty\HttpQuery;

class TransaksiQuery extends HttpQuery
{
    public function faktur_type($builder, $value)
    {
        return $builder->where('faktur_type', $value);
    }

    public function faktur_id($builder, $value)
    {
        return $builder->where('faktur_id', $value);
    }
}
