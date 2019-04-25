<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('team_id')->nullable()->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->enum('range', ['week', 'month', 'year']);
            $table->date('date');
            $table->string('image_graph', 191)->nullable();
            $table->string('pdf_link', 191)->nullable();
            $table->integer('owner_id')->unsigned();

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
        Schema::dropIfExists('reports');
    }
}
