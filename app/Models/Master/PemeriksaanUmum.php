<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\BelongsToItself;

class PemeriksaanUmum extends Model
{
    use BelongsToItself;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable   = ['uraian', 'childs'];
}
