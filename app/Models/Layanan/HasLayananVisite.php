<?php

namespace App\Models\Layanan;

trait HasLayananVisite
{
    public function initializeHasLayananTindakan()
    {
        array_set($this->tarifable_layanan,  'visites', 'Visite');
    }

    public function visites()
    {
        return $this->morphMany(Visite::class, 'perawatan');
    }
}
