<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoLugarTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('evento_lugar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lugar_id')->nullable()->constrained('lugares')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('evento_lugar');
    }
}