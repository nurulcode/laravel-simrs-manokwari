<?php

namespace App\Models\Layanan;

trait HasLayananDiagnosa
{
    public function diagnosa()
    {
        return $this->morphMany(Diagnosa::class, 'perawatan');
    }
}
