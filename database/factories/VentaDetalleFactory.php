<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Articulo;
use App\Models\VentaDetalle;
use App\Models\Venta;

class VentaDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'venta_id' => Venta::factory(),
            'articulo_id' => Articulo::factory(),
            'cantidad' => $cantidad = $this->faker->numberBetween(1, 20),
            'precio_compra' => $precioCompra = $this->faker->randomFloat(2, 0, 999.99),
            'precio_venta' => $precioVenta = round($precioCompra * 1.25, 2), // 25% más que precio_compra
            'descuento' => $descuento = round(min($precioVenta * 0.05, 10), 2), // máximo 5% del precio_venta o 10, lo que sea menor
            'sub_total' => round(($cantidad * $precioVenta) - $descuento, 2), // (cantidad*precio_venta)-descuento
        ];
    }
}
