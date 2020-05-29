<?php

namespace App;

use App\Models\Master\TindakanPemeriksaan;

class TindakanPoliklinik
{
    public static function create($data)
    {
        $tindakan = TindakanPemeriksaan::create(array_except($data, 'polikliniks'));

        $tindakan->polikliniks()->sync(array_pluck(array_get($data, 'polikliniks', []), 'id'));

        return $tindakan;
    }

    public static function update(TindakanPemeriksaan $tindakan, $data)
    {
        $tindakan->update(array_except($data, 'polikliniks'));

        $tindakan->polikliniks()->sync(array_pluck(array_get($data, 'polikliniks', []), 'id'));

        return $tindakan;
    }
}
