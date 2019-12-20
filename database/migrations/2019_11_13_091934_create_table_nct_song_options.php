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
            $table->boolean('canDownload')->index();
            $table->boolean('hasRemoved', 20)->index();
            $table->boolean('isDmca')->index();
            $table->boolean('hasCustom')->index();
            $table->string('redirectTo', 20)->index();

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
