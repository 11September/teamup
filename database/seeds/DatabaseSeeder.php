<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MeasuresSeeder::class,
            ActivitySeeder::class,
            FeedbackSeeder::class,
            NoteSeeder::class,
            TeamSeeder::class,
            ReportsSeeder::class,
        ]);
    }
}
