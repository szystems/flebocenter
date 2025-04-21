<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBariatriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bariatrias', function (Blueprint $table) {
            $table->id();
            
            // Relación con paciente
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            
            // Fecha de consulta/evaluación
            $table->date('fecha');
            
            // Datos antropométricos
            $table->decimal('peso', 8, 2)->nullable();
            $table->decimal('talla', 8, 2)->nullable();
            $table->decimal('cci', 8, 2)->nullable()->comment('Circunferencia de cintura');
            $table->decimal('cca', 8, 2)->nullable()->comment('Circunferencia de cadera');
            $table->decimal('ccu', 8, 2)->nullable()->comment('Circunferencia de cuello');
            $table->decimal('imc', 8, 2)->nullable()->comment('Índice de masa corporal');
            $table->decimal('icc', 8, 2)->nullable()->comment('Índice cintura cadera');
            $table->decimal('ict', 8, 2)->nullable()->comment('Índice cintura talla');
            
            // Archivo PDF
            $table->string('pdf_path')->nullable();
            
            // Diagnóstico
            $table->text('diagnostico')->nullable();
            
            // Plan terapéutico
            $table->integer('kilocalorias')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('suplementacion')->nullable();
            $table->text('ejercicios')->nullable();
            
            // Comentarios
            $table->text('comentarios')->nullable();
            
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
        Schema::dropIfExists('bariatrias');
    }
}
