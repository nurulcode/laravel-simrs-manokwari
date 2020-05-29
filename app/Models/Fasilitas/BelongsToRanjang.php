<?php

namespace App\Models\Fasilitas;

use Illuminate\Database\Eloquent\Builder;

/**
 * Belongs to ranjang
 */
trait BelongsToRanjang
{
    use BelongsToKamar;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function bootBelongsToRanjang()
    {
        $table = with(new static)->getTable();

        static::addGlobalScope('ranjang', function (Builder $builder) use ($table) {
            $ranjang = Ranjang::selectRaw(
                'id as ranjang_id, ranjangs.kamar_id, ruangan_id, poliklinik_id, kelas'
            );

            $builder->addSelect([
                $table . '.*',
                'kamar_id',
                'ruangan_id',
                'poliklinik_id',
                'kelas',
            ])->leftJoinSub($ranjang, 'ranjang', function ($join) use ($table) {
                $join->on($table . '.ranjang_id', '=', 'ranjang.ranjang_id');
            });
        });
    }

    public function ranjang()
    {
        return $this->belongsTo(Ranjang::class);
    }

    /**
     * Disable "booting" method of the BelongsToKamar trait.
     *
     * @return void
     */
    public static function bootBelongsToKamar()
    {
        // Do nothing
    }
}
