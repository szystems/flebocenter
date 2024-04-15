<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->index();
            $table->string('codigo')->nullable()->unique();
            $table->string('imagen')->nullable()->default('default.png');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_compra', 8, 2)->default(0.00);
            $table->decimal('precio_venta', 8, 2)->default(0.00);
            $table->integer('stock')->default(0);
            $table->bigInteger('categoria_id');
            $table->bigInteger('proveedor_id');
            $table->tinyInteger('estado')->default(true);
            $table->timestamps();

            $table->index('categoria_id');
            $table->index('proveedor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
