<?php

namespace App\Models\Layanan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Kegiatan;

class Kebidanan extends Layanan
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_kebidanans';

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
