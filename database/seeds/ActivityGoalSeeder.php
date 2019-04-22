<?php

use App\ActivityGoal;
use Illuminate\Database\Seeder;

class ActivityGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ActivityGoal::class, 0)->create();
    }
}
