<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClinicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'direccion'=> $this->faker->streetAddress,
            'telefono'=> $this->faker->numberBetween($min = 10000000, $max = 99999999),
            'celular'=> $this->faker->numberBetween($min = 10000000, $max = 99999999),
            'descripcion' => $this->faker->text(300),
            'estado' => '1',
        ];
    }
}
