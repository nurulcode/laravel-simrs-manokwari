<?php

namespace App\Models\Kepegawaian;

trait BelongsToPegawai
{
    public function petugas()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
