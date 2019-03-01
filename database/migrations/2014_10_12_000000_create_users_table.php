<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->enum('type', ['user', 'coach', 'admin'])->default('user');

            $table->smallInteger('number_students')->nullable();
            $table->string('activation_code', 50)->nullable();
            $table->date('expiration_date', 50)->nullable();

            $table->enum('status', ['active', 'disable'])->default('active');

            $table->string('player_id', 50)->unique()->nullable();
            $table->enum('push', ['enabled', 'disabled'])->default('enabled');
            $table->enum('push_chat', ['true', 'false'])->default('true');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
