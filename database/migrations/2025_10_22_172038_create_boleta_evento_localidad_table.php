<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletaEventoLocalidadTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('boleta_evento_localidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('localidad_id')->constrained('localidades')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('boletas', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
            $table->dropForeign(['localidad_id']);
            $table->dropColumn(['evento_id', 'localidad_id']);
        });
    }
}