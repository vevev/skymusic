<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNctSongOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nct_song_options', function (Blueprint $table) {
            $table->string('song_id', 20)->unique();
            $table->boolean('canDownload')->index()->nullable();
            $table->boolean('hasRemoved', 20)->index()->nullable();
            $table->boolean('isDmca')->index()->nullable();
            $table->boolean('hasCustom')->index()->nullable();
            $table->string('redirectTo', 20)->index()->nullable();

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
        Schema::dropIfExists('nct_song_options');
    }
}
