<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('localidad_id')->constrained('localidades')->onDelete('cascade');
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad_total');
            $table->integer('cantidad_disponible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boletas');
    }
};
