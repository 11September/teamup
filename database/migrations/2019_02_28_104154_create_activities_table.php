<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('measure_id')->unsigned();
            $table->enum('graph_type', ['straight', 'reverse']);
            $table->enum('graph_color', ['red', 'yellow', 'blue', 'violet', 'orange', 'green', 'indigo']);
            $table->enum('status', ['default', 'custom'])->default('default');
            $table->integer('user_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('measure_id')->references('id')->on('measures')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
