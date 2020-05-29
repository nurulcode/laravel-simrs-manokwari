<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class Kecamatan extends Master
{
    use BelongsToKotaKabupaten;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'kota_kabupaten_id'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'parent'];

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('kota_kabupaten', function ($query) use ($searchQuery) {
            $query
                ->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('provinsis')
                        ->whereRaw('kota_kabupatens.provinsi_id = provinsis.id')
                        ->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'provinsi':
                $builder = $this->orderByKotaKabupaten($builder, $orderDirection);
                // no break
            case 'kota_kabupaten':
                $builder = $builder->orderBy('name', 'asc');
                break;
        }

        return $builder;
    }

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }
}
