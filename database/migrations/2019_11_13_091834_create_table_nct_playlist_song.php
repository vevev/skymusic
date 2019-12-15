<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNctPlaylistSong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nct_playlist_song', function (Blueprint $table) {
            $table->string('playlist_id', 20);
            $table->string('song_id', 20);

            $table->foreign('playlist_id')
                  ->references('playlist_id')
                  ->on('nct_playlists')
                  ->onDelete('cascade');
            $table->foreign('song_id')
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
        Schema::dropIfExists('nct_playlist_song');
    }
}
