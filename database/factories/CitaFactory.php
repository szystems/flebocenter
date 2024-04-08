<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $horaInicio = $this->faker->time($format = 'H:i:s');
        $estados = ['Pendiente', 'Confirmada', 'Atendida'];

        return [
            'paciente_id' => $this->faker->numberBetween(1, 40), // Asumiendo que hay 100 pacientes
            'doctor_id' => $this->faker->numberBetween(1, 20), // Asumiendo que hay 50 doctores
            'clinica_id' => $this->faker->numberBetween(1, 5), // Asumiendo que hay 20 clínicas
            'fecha_cita' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'hora_inicio' => $horaInicio,
            'hora_fin' => (new \DateTime($horaInicio))->modify('+30 minutes')->format('H:i:s'),
            'motivo' => $this->faker->text($maxNbChars = 1024),
            'estado' => $this->faker->randomElement($estados),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
