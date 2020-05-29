<?php

namespace App\Models\Master;

use App\Models\BelongsToItself;

class CaraPembayaran extends Master
{
    use BelongsToItself;

    public function scopeOnlyFirstLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('uraian');
    }
}
