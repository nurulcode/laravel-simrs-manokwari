<?php

namespace App\Models\Master;

use App\Models\BelongsToItself;
use App\Models\Tarifable;

class Kegiatan extends Master
{
    use BelongsToItself, Tarifable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['kategori'];

    public function kategori()
    {
        return $this->belongsToMany(KategoriKegiatan::class)->withPivot('kode');
    }
}
