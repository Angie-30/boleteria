<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre', 50); // VIP, General, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('localidades');
    }
};
