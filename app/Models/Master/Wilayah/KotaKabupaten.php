<?php

namespace App\Models\Master\Wilayah;

use App\Models\Master\Master;

class KotaKabupaten extends Master
{
    use BelongsToProvinsi;

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['name', 'provinsi'];

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
    protected $fillable = ['name', 'provinsi_id'];

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        return $orderBy != 'name' ? $builder->orderBy('name', 'asc') : $builder;
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }
}
