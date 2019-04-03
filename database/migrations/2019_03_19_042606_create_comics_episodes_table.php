<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComicsEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comics_episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('comic_id');
            $table->unsignedBigInteger('episode_id');

            $table->foreign('comic_id')->references('id')->on('comics')->onDelete('cascade');
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comics_episodes');
    }
}
