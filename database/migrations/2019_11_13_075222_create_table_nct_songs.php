<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNctSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nct_songs', function (Blueprint $table) {
            $table->string('song_id', 20)->unique();
            $table->integer('real_id')->unique();
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('single', 255);
            $table->bigInteger('listen')->default(0);
            $table->string('slug', 255);
            $table->text('lyric')->nullable();
            $table->string('key', 255);
            $table->string('thumbnail', 255)->nullable();
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
        Schema::dropIfExists('nct_songs');
    }
}
