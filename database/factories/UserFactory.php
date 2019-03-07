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
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', // secret
//        'token' => str_random(5),
        'remember_token' => str_random(10),
        'type' => $faker->randomElement(['user', 'coach', 'admin']),
        'phone' => $faker->phoneNumber,
        'number_students' => $faker->numberBetween(1, 200),
        'activation_code' => $faker->bothify('**********'),
        'expiration_date' => $faker->dateTimeBetween('now', '+1 month'),
        'push' => $faker->randomElement(['enabled', 'disabled']),
        'player_id' => null,
        'push_chat' => $faker->randomElement(['true', 'false']),
        'status' => "active",
    ];
});

$faker = \Faker\Factory::create();

DB::table('users')->insert([
    'first_name' => "Станислав",
    'last_name' => "Андреевич",
    'email' => "admin@admin.com",
    'email_verified_at' => now(),
    'password' => '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', // secret
//    'token' => str_random(5),
    'remember_token' => str_random(10),
    'type' => "admin",
    'number_students' => $faker->numberBetween(1, 200),
    'activation_code' => $faker->bothify('********************'),
    'expiration_date' => $faker->dateTimeBetween('now', '+1 month'),
    'push' => $faker->randomElement(['enabled', 'disabled']),
    'player_id' => null,
    'push_chat' => $faker->randomElement(['true', 'false']),
    'status' => "active",
]);

DB::table('users')->insert([
    'first_name' => "Станислав",
    'last_name' => "Андреевич",
    'email' => "coach@admin.com",
    'email_verified_at' => now(),
    'password' => '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', // secret
//    'token' => str_random(5),
    'remember_token' => str_random(10),
    'type' => "coach",
    'number_students' => $faker->numberBetween(1, 200),
    'activation_code' => $faker->bothify('********************'),
    'expiration_date' => $faker->dateTimeBetween('now', '+1 month'),
    'push' => $faker->randomElement(['enabled', 'disabled']),
    'player_id' => null,
    'push_chat' => $faker->randomElement(['true', 'false']),
    'status' => "active",
]);
