<?php

namespace App\Models\Layanan;

trait HasLayananPenunjang
{
    public function penunjangs()
    {
        return $this->morphMany(Penunjang::class, 'perawatan');
    }
}
