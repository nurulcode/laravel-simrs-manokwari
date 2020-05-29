<?php

namespace App\Models\Kepegawaian;

use App\Models\Model;

class Jabatan extends Model
{
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
