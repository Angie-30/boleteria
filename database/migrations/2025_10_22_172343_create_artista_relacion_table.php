<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistaRelacionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artista_relacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artista_id')->constrained('artistas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('artista_relacion');
    }
}