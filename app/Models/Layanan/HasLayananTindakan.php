<?php

namespace App\Models\Layanan;

trait HasLayananTindakan
{
    public function initializeHasLayananTindakan()
    {
        array_set($this->tarifable_layanan,  'tindakans', 'Tindakan/Pemeriksaan');
    }

    public function tindakans()
    {
        return $this->morphMany(Tindakan::class, 'perawatan');
    }
}
