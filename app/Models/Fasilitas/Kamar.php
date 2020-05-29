<?php

namespace App\Models\Fasilitas;

use App\Models\Model;

class Kamar extends Model
{
    use BelongsToRuangan;

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
    protected $fillable = ['nama', 'ruangan_id'];

    /**
     * The attributes that are searchable.
     *
     */
    protected $searchable = ['nama', 'parent'];

    public function searchParent($builder, $searchQuery)
    {
        return $builder->orwhereHas('ruangan', function ($query) use ($searchQuery) {
            $query
                ->where('nama', 'like', '%' . $searchQuery . '%')
                ->orWhere('kode', 'like', '%' . $searchQuery . '%')
                ->orWhereExists(function ($query) use ($searchQuery) {
                    $query->select('*')
                        ->from('polikliniks')
                        ->whereRaw('ruangans.poliklinik_id = polikliniks.id')
                        ->where(function ($query) use ($searchQuery) {
                            $query->where('nama', 'like', '%' . $searchQuery . '%')
                                ->orWhere('kode', 'like', '%' . $searchQuery . '%');
                        });
                });
        });
    }

    public function afterOrder($builder, $orderBy, $orderDirection)
    {
        switch ($orderBy) {
            case 'poliklinik':
                $builder = $this->orderByRuangan($builder, $orderDirection);
                // no break
            case 'ruangan':
                $builder = $builder->orderBy('nama', 'asc');
                break;
        }

        return $builder;
    }

    public function ranjangs()
    {
        return $this->hasMany(Ranjang::class);
    }
}
