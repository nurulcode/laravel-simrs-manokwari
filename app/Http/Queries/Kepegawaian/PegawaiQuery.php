<?php

namespace App\Http\Queries\Kepegawaian;

use Sty\HttpQuery;

class PegawaiQuery extends HttpQuery
{
    public function kualifikasi($builder, $value)
    {
        return $builder->where('kualifikasi_id', $value);
    }

    public function jabatan($builder, $value)
    {
        return $builder->where('jabatan_id', $value);
    }
}
