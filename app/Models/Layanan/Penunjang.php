<?php

namespace App\Models\Layanan;

use App\Models\Fasilitas\Poliklinik;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Fasilitas\BelongsToPoliklinik;
use App\Enums\TypePenunjang;

class Penunjang extends Layanan
{
    use BelongsToPoliklinik;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan_penunjangs';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('jenis', function (Builder $builder) {
            $builder->addSubSelect('jenis',
                Poliklinik::withoutGlobalScopes()
                    ->select('jenis_id')
                    ->whereColumn('id', 'poliklinik_id')
            );
        });
    }

    public function getJenisAttribute($value)
    {
        return str_replace('_', '-', (strtolower(TypePenunjang::getKey((string) $value))));
    }

    public function getTitleAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->jenis));
    }

    public function getSlugAttribute()
    {
        return url('/penunjang/' . $this->jenis . '/' . $this->id);
    }

    public function tindakans()
    {
        return $this->hasMany(PenunjangTindakan::class);
    }

    public function getTotalBiaya()
    {
        $biaya = collect([]);

        foreach ($this->tindakans as $tindakan) {
            $biaya->push($tindakan->total_tarif);
        }

        return $biaya->sum();
    }
}
