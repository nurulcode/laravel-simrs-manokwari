<?php

namespace App\Http\Queries\Master;

use Sty\HttpQuery;

class KelompokPenyakitQuery extends HttpQuery
{
    public function klasifikasi($builder, $value)
    {
        return $builder->where('klasifikasi_id', $value);
    }
}
