<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'ocupacion' => $this->faker->optional()->jobTitle,
            'fecha_nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'telefono' => $this->faker->optional()->phoneNumber,
            'celular' => $this->faker->phoneNumber,
            'direccion' => $this->faker->optional()->address,
            'email' => $this->faker->unique()->safeEmail,
            'dpi' => $this->faker->unique()->numerify('##########'),
            'nit' => $this->faker->optional()->numerify('########-#'),
            'fotografia' => $this->faker->randomElement([
                'team-1.jpg',
                'team-2.jpg',
                'team-3.jpg',
                'team-4.jpg',
                'user.png',
                'user1.png',
                'user2.png',
                'user3.png',
                'user4.png',
                'user5.png',
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
