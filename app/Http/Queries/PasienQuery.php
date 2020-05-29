<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class PasienQuery extends HttpQuery
{
    public function mr($builder, $value = '')
    {
        if (!$value) {
            return $builder;
        }

        return $builder->where('no_rekam_medis', 'LIKE', '%' . $value . '%');
    }

    public function nama($builder, $value = '')
    {
        if (!$value) {
            return $builder;
        }

        return $builder->where('nama', 'LIKE', '%' . $value . '%');
    }

    public function noidentitas($builder, $value = '')
    {
        if (!$value) {
            return $builder;
        }

        return $builder->where('nomor_identitas', 'LIKE', '%' . $value . '%');
    }

    public function tanggal_lahir($builder, $value = '')
    {
        return $value ? $builder->where('tanggal_lahir', $value) : $builder;
    }

    public function alamat($builder, $value = '')
    {
        return $value ? $builder->where('alamat', 'LIKE', '%' . $value . '%') : $builder;
    }
}
