<?php

namespace App\Http\Queries\Kepegawaian;

use Sty\HttpQuery;

class KualifikasiQuery extends HttpQuery
{
    public function kategori($builder, $value)
    {
        return $builder->where('kategori_id', $value);
    }
}
