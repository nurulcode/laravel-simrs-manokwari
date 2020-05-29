<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\KelasTarif;

class Tarif extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tarif', 'tarifable_type', 'tarifable_id'
    ];

    public function setTarifAttribute($value)
    {
        $current = json_decode(array_get($this->attributes, 'tarif', '{}'), true);

        foreach (array_unique(KelasTarif::getKeys()) as $kelas) {
            if (array_key_exists($kelas, $value)) {
                array_set($current, $kelas, array_get($value, $kelas));
            }
        }

        $this->attributes['tarif'] = json_encode($current);
    }
}
