<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Ingreso;
use App\Models\Proveedor;

class IngresoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $tiposComprobantes = ['Factura', 'Recibo', 'Boleta','Ticket'];
        $tiposPagos = ['Efectivo','Tarjeta','Depostito','Transferencia'];

        return [
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'proveedor_id' => $this->faker->randomElement(Proveedor::pluck('id')->toArray()),
            'tipo_comprobante' => $this->faker->randomElement($tiposComprobantes),
            'serie_comprobante' => $this->faker->numberBetween(0, 100),
            'numero_comprobante' => $this->faker->numberBetween(0, 100),
        ];
    }
}
