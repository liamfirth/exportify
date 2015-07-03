<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache', function($table)) {
            $table->increments('id');
            $table->text('spotify_uri');
            $table->text('track_name');
            $table->text('artist_name');
            $table->text('album_name');
            $table->integer('disc_number');
            $table->integer('track_number');
            $table->integer('track_duration');
            $table->timestamp('added_on');
            $table->timestamps();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cache');
    }
}
