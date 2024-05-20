<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Articulo;
use App\Models\IngresoDetalle;
use App\Models\Ingreso;

class IngresoDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ingreso_id' => Ingreso::factory(),
            'articulo_id' => Articulo::factory(),
            'cantidad' => $cantidad = $this->faker->numberBetween(1, 100),
            'precio_compra' => $precioCompra = $this->faker->randomFloat(2, 0, 999.99),
            'sub_total' => $precioCompra * $cantidad,
        ];
    }
}
