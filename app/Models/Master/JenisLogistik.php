<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Logistik\Logistik;

class JenisLogistik extends Model
{
    public function logistiks()
    {
        return $this->hasMany(Logistik::class, 'jenis_id');
    }

    public function deletable()
    {
        return !$this->logistiks_count;
    }
}
