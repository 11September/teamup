<?php

Use App\User;
use App\Note;
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

$factory->define(Note::class, function (Faker $faker) {
    return [
        'note' => $faker->realText(),
        'user_id' => User::all()->random()->id,
        'date' => $faker->date(),
    ];
});
