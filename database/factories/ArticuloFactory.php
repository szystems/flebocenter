<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Articulo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'codigo' => $this->faker->optional()->isbn10() ?? $this->faker->isbn13(),
            // 'imagen' => $this->faker->optional()->imageUrl(),
            'descripcion' => $this->faker->optional()->sentence(6),
            'precio_compra' => $precioCompra = $this->faker->randomFloat(2, 1, 100), // Genera el precio de compra
            'precio_venta' => $precioCompra * 1.25, // Calcula el precio de venta (25% más alto)
            'stock' => $this->faker->numberBetween(0, 100),
            'categoria_id' => $this->faker->randomElement(Categoria::pluck('id')->toArray()),
            'proveedor_id' => $this->faker->randomElement(Proveedor::pluck('id')->toArray()),
        ];
    }
}
