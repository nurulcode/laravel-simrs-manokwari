<?php

namespace App\Models\Master;

class KategoriKegiatan extends Master
{
    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class);
    }
}
