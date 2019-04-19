<?php

Use App\User;
Use App\Team;
Use App\TeamUser;
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

$factory->define(TeamUser::class, function (Faker $faker) {
    return [
        'team_id' => Team::all()->random()->id,
        'user_id' => User::all()->random()->id,
    ];
});
