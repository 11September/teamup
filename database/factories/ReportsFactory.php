<?php

Use App\User;
Use App\Team;
use App\Report;
Use App\Activity;
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

$factory->define(Report::class, function (Faker $faker) {
    return [
        'team_id' => $user_id = Team::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'activity_id' => Activity::all()->random()->id,
        'range' => $faker->monthName,
        'date' => $faker->date(),
        'link' => "app/public/reports/1.pdf",
        'owner_id' => $user_id,
    ];
});
