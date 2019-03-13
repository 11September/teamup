<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'measure_id' => 1,
        'graph_type' => $faker->randomElement(['straight', 'reverse']),
        'graph_color' => $faker->randomElement(['red', 'yellow', 'blue', 'violet', 'orange', 'green', 'indigo']),
        'status' => $faker->randomElement(['default', 'custom']),
        'user_id' => 1
    ];
});
