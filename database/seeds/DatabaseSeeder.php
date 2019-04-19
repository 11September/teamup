<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            FeedbackSeeder::class,
            NoteSeeder::class,
            MeasuresSeeder::class,
            TeamSeeder::class,
            ActivitySeeder::class,

            TeamUserSeeder::class,

            RecordsSeeder::class,
            ReportsSeeder::class,
        ]);

        DB::table('oauth_clients')->insert([
            'user_id' => Null,
            'name' => "TeamUp",
            'secret' => "PrrbX9zzDo2QUrt5gaFbqsBgeUhxkL4cBhYz1dBD",
            'redirect' => "http://localhost",
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('oauth_clients')->insert([
            'user_id' => Null,
            'name' => "TeamUp",
            'secret' => "QdavliJvc3e6vh61weSK7wMESdap6pLorJeKgxcm",
            'redirect' => "",
            'personal_access_client' => 0,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('oauth_clients')->insert([
            'user_id' => Null,
            'name' => "TeamUp",
            'secret' => "WpDjhICpHPM6lsAUwMAFm4WVLtCrdjnryCR8gTNL",
            'redirect' => "http://localhost",
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => 3,
            'created_at' => \Carbon\Carbon::now()
        ]);


    }
}
