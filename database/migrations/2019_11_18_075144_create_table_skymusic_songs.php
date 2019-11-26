<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSkymusicSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skymusic_songs', function (Blueprint $table) {
            $table->string("key", 255)->unique();
            $table->string("title", 255);
            $table->string("slug", 255);
            $table->string("artists", 255);
            $table->integer("duration");
            $table->integer("kbit");
            $table->bigInteger("dateModifire");
            $table->string("streamUrl", 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skymusic_songs');
    }
}
