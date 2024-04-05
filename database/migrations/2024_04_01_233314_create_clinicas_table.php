<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la clínica
            $table->string('direccion')->nullable(); // Dirección
            $table->string('telefono')->nullable(); // Número de teléfono (opcional)
            $table->string('celular')->nullable(); // Número de teléfono (opcional)
            $table->string('email')->nullable(); // Correo electrónico (opcional)
            $table->longText('descripcion')->nullable(); // Descripción de la clínica (opcional)
            $table->tinyInteger('estado')->default(true);
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
        Schema::dropIfExists('clinicas');
    }
}
