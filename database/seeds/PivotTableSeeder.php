<?php

use Sty\CsvSeeder;
use Illuminate\Database\Seeder;

class PivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        with(new CsvSeeder('kategori_kegiatan_kegiatan',
            database_path('seeds/data/master/kegiatan/kategori_kegiatan_pivot.csv')
        ))->setProgressOutput($this->command->getOutput(), 404)
            ->select(1, 2, 3)
            ->withTimestamps(false)
            ->seed();

        with(new CsvSeeder('poliklinik_tindakan_pemeriksaan',
            database_path('seeds/data/tindakan_poliklinik.csv')
        ))->setProgressOutput($this->command->getOutput(), 590)
            ->withTimestamps(false)
            ->seed();
    }
}
