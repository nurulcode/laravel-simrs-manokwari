<?php

namespace App;

use Sty\CsvSeeder;
use Illuminate\Database\Seeder as BaseSeeder;

class Seeder extends BaseSeeder
{
    public function seeds(array $seeders)
    {
        collect($seeders)->each(function ($seed, $class) {
            $this->seed($class, ...$seed);
        });
    }

    public function seed($class, $path, $output, $parameters = [])
    {
        $this->title($class);

        $model      = new $class;

        $connection = $model->getConnection()->getConfig('name');
        $table      = $model->getTable();

        $path       = database_path('/seeds/data/' . $path);

        $seeder     = new CsvSeeder($table, $path, $connection);

        $seeder
            ->setBatch(200)
            ->setParameters($parameters)
            ->setProgressOutput($this->command->getOutput(), $output)
            ->seed();
    }

    public function title($title='')
    {
        $this->command->getOutput()->newLine(1);
        $this->command->info('-> ' . $title);
    }
}
