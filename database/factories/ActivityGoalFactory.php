<?php

Use App\User;
Use App\Activity;
Use App\ActivityGoal;
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

$factory->define(ActivityGoal::class, function (Faker $faker) {
    return [
        'activity_id' => 1,
        'user_id' => 1,
        'goal' => $faker->randomFloat(null, 0.1, 20)
    ];
});

$faker = \Faker\Factory::create();

DB::table('activity_user_goals')->insert([
    'activity_id' => 1,
    'user_id' => 2,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);

DB::table('activity_user_goals')->insert([
    'activity_id' => 1,
    'user_id' => 3,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);

DB::table('activity_user_goals')->insert([
    'activity_id' => 1,
    'user_id' => 4,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);

DB::table('activity_user_goals')->insert([
    'activity_id' => 2,
    'user_id' => 1,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);

DB::table('activity_user_goals')->insert([
    'activity_id' => 2,
    'user_id' => 2,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);

DB::table('activity_user_goals')->insert([
    'activity_id' => 2,
    'user_id' => 3,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);

DB::table('activity_user_goals')->insert([
    'activity_id' => 2,
    'user_id' => 4,
    'goal' => $faker->randomFloat(null, 0.1, 20)
]);
