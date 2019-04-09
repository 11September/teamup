<?php

Use App\User;
use App\Team;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => User::all()->random()->id,
        'count' => $faker->randomDigit,
        'code' => Str::random(40),
    ];
});
