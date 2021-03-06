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
        'remember_token' => str_random(10),
        'type' => $faker->randomElement(['user', 'coach', 'admin']),
        'phone' => $faker->phoneNumber,
        'avatar' => "/avatars/654853-user-men-2-512.png",
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
    'remember_token' => str_random(10),
    'type' => "admin",
    'avatar' => "/avatars/24df642906350a4a377b4483cc5c3bf7.jpg",
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
    'remember_token' => str_random(10),
    'type' => "coach",
    'avatar' => "/avatars/owl-mascot.png",
    'number_students' => $faker->numberBetween(1, 200),
    'activation_code' => $faker->bothify('********************'),
    'expiration_date' => $faker->dateTimeBetween('now', '+1 month'),
    'push' => $faker->randomElement(['enabled', 'disabled']),
    'player_id' => null,
    'push_chat' => $faker->randomElement(['true', 'false']),
    'status' => "active",
]);

DB::table('users')->insert([
    'first_name' => "Тренер",
    'last_name' => "Тренерович",
    'email' => "coach2@admin.com",
    'email_verified_at' => now(),
    'password' => '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', // secret
    'remember_token' => str_random(10),
    'type' => "coach",
    'avatar' => "/avatars/owl-mascot.png",
    'number_students' => $faker->numberBetween(1, 200),
    'activation_code' => $faker->bothify('********************'),
    'expiration_date' => $faker->dateTimeBetween('now', '+1 month'),
    'push' => $faker->randomElement(['enabled', 'disabled']),
    'player_id' => null,
    'push_chat' => $faker->randomElement(['true', 'false']),
    'status' => "active",
]);

DB::table('users')->insert([
    'first_name' => "Атлет",
    'last_name' => "Атлетович",
    'email' => "athlete@athlete.com",
    'email_verified_at' => now(),
    'password' => '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', // secret
    'remember_token' => str_random(10),
    'type' => "athlete",
    'avatar' => "/avatars/owl-mascot.png",
    'number_students' => 0,
    'activation_code' => $faker->bothify('********************'),
    'expiration_date' => $faker->dateTimeBetween('now', '+1 month'),
    'push' => $faker->randomElement(['enabled', 'disabled']),
    'player_id' => null,
    'push_chat' => $faker->randomElement(['true', 'false']),
    'status' => "active",
]);
