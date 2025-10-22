<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateArtistaEventoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artista_evento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artista_id')->constrained('artistas')->onDelete('cascade');
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['evento_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('artista_evento');
    }
};
