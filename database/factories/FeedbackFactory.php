<?php

Use App\User;
use App\Feedback;
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

$factory->define(Feedback::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'feedback' => $faker->realText(),
        'date' => $faker->date(),
        'status' => $faker->randomElement(['read', 'unread']),
    ];
});
