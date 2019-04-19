<?php

use App\Record;
use Illuminate\Database\Seeder;

class RecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Record::class, 10000)->create();
    }
}

