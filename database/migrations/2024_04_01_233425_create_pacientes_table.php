<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ocupacion')->nullable();
            $table->date('fecha_nacimiento');
            $table->char('sexo', 1);
            $table->string('telefono')->nullable();
            $table->string('celular');
            $table->text('direccion')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('dpi')->unique();
            $table->string('nit')->nullable();
            $table->string('fotografia')->nullable();
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('pacientes');
    }
}
