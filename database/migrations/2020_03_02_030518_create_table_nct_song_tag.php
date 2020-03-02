<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNctSongTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nct_song_tag', function (Blueprint $table) {
            $table->string('song_id', 20)->index();
            $table->unsignedBigInteger('tag_id')->index();

            $table->foreign('song_id')
                  ->references('song_id')
                  ->on('nct_songs')
                  ->onDelete('cascade');
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('nct_tags')
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
        Schema::dropIfExists('nct_song_tag');
    }
}
