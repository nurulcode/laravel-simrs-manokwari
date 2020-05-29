<?php

use Sty\CsvSeeder;
use Illuminate\Database\Seeder;

class ProsedurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path       = database_path('/seeds/data/master/prosedurs.csv');

        $seeder     = new CsvSeeder('prosedurs', $path);

        $seeder
            ->setDelimiter(';')
            ->setColumns(['kode', 'uraian'])
            ->setBatch(200)
            ->setProgressOutput($this->command->getOutput(), 3911)
            ->seed();
    }
}
