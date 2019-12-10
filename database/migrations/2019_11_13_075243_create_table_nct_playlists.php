<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNctPlaylists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nct_playlists', function (Blueprint $table) {
            $table->string('playlist_id', 20)->unique();
            $table->string('key', 255)->index()->nullable();
            $table->integer('real_id')->unique();
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('single', 255);
            $table->string('slug', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nct_playlists');
    }
}
