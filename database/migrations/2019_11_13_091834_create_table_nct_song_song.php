<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNctSongSong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nct_song_song', function (Blueprint $table) {
            $table->string('song_id', 20)->index();
            $table->string('relate_id', 20)->index();

            $table->foreign('song_id')
                  ->references('song_id')
                  ->on('nct_songs')
                  ->onDelete('cascade');
            $table->foreign('relate_id')
                  ->references('song_id')
                  ->on('nct_songs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nct_song_song');
    }
}
