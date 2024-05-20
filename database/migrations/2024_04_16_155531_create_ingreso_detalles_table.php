<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingreso_id');
            $table->unsignedBigInteger('articulo_id');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_compra', 8, 2)->default(0.00);
            $table->decimal('sub_total', 8, 2)->default(0.00);
            $table->timestamps();


            $table->foreign('ingreso_id')->references('id')->on('ingresos')->onDelete('cascade')->after('precio_venta');
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade')->after('ingreso_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso_detalles');
    }
}
