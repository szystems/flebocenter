<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctores = User::where('role_as', 0)->pluck('id');
        return [
            'paciente_id' => $this->faker->numberBetween(1, 20), // Asumiendo que hay 100 pacientes
            'doctor_id' => $this->faker->randomElement($doctores),
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'descripcion' => $this->faker->text(300),
        ];
    }
}
