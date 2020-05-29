<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class Kelurahan extends Master
{
    use BelongsToKecamatan;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'kecamatan_id'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'parent'];

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'provinsi':
                $builder = $this->orderByKotaKabupaten($builder, $orderDirection);
                // no break
            case 'kota_kabupaten':
                $builder = $this->orderByKecamatan($builder, 'asc');
                // no break
            case 'kecamatan':
                $builder = $builder->orderBy('name', 'asc');
                break;
        }

        return $builder;
    }

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('kecamatan', function ($query) use ($searchQuery) {
            $query
                ->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('kota_kabupatens')
                        ->whereRaw('kota_kabupatens.id = kecamatans.kota_kabupaten_id')
                        ->where(function ($query) use ($searchQuery) {
                            $query
                                ->where('name', 'like', '%' . $searchQuery . '%')
                                ->orWhereExists(function ($query) use ($searchQuery) {
                                    $query->select('*')
                                        ->from('provinsis')
                                        ->whereRaw('kota_kabupatens.provinsi_id = provinsis.id')
                                        ->where('name', 'like', '%' . $searchQuery . '%');
                                });
                        });
                });
        });
    }
}
