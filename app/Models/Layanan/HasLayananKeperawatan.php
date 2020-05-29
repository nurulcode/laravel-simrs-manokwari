<?php

namespace App\Models\Layanan;

trait HasLayananKeperawatan
{
    public function initializeHasLayananKeperawatan()
    {
        array_set($this->tarifable_layanan,  'keperawatans', 'Perawatan Khusus');
    }

    public function keperawatans()
    {
        return $this->morphMany(Keperawatan::class, 'perawatan');
    }
}
