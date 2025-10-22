<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('genero_musical', 50);
            $table->string('ciudad_origen', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artistas');
    }
};
