<?php

Use App\User;
Use App\Activity;
use Carbon\Carbon;
use Faker\Generator as Faker;

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

$factory->define(App\Record::class, function (Faker $faker) {

    $year = rand(2018, 2019);
//    $year = 2019;
    $month = rand(1, 12);
    $day = rand(1, 28);

    $date = Carbon::create($year,$month ,$day , 0, 0, 0);

    return [
        'activity_id' => Activity::all()->random()->id,
//        'user_id' => User::all()->random()->id,
        'user_id' => 2,
        'value' => $faker->randomDigit,
        'date' => $date->format('Y-m-d'),
        'notice' => $faker->sentence(),
    ];
});
