<?php

use App\Seeder;
use App\Models\Logistik\Logistik;

class LogistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            Logistik::class => ['logistik.csv', 498],
        ]);
    }
}
