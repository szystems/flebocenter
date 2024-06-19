<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerapiaSesionDerechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terapia_sesion_derechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('terapia_id');
            $table->string('antes1')->nullable();
            $table->string('antes2')->nullable();
            $table->string('antes3')->nullable();
            $table->string('antes4')->nullable();
            $table->string('despues1')->nullable();
            $table->string('despues2')->nullable();
            $table->string('despues3')->nullable();
            $table->string('despues4')->nullable();
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
        Schema::dropIfExists('terapia_sesion_derechas');
    }
}
