<?php

use App\Measure;
use Illuminate\Database\Seeder;

class MeasuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Measure::class, 0)->create();
    }
}
