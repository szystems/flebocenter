<?php

namespace Database\Factories;

use App\Models\Historia;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'paciente_id' => $this->faker->uuid,
            'medico' => $this->faker->name,
            'miembro_afectado' => $this->faker->randomElement(['Izquierdo', 'Derecho', 'Ambos']),
            'peso' => $this->faker->randomFloat(2, 40, 150),
            'estatura' => $this->faker->randomFloat(2, 140, 200),
            'a_estetica' => $this->faker->boolean,
            'a_enfermedad' => $this->faker->boolean,
            'b_muslo' => $this->faker->boolean,
            'b_tobillo' => $this->faker->boolean,
            'b_pantorrilla' => $this->faker->boolean,
            'b_varicorragia' => $this->faker->boolean,
            'b_inchazon' => $this->faker->boolean,
            'b_ulceras_piel' => $this->faker->boolean,
            'b_ardor' => $this->faker->boolean,
            'b_comezon' => $this->faker->boolean,
            'b_cansancio' => $this->faker->boolean,
            'b_pesadez' => $this->faker->boolean,
            'b_calambres' => $this->faker->boolean,
            'c_caminar' => $this->faker->boolean,
            'c_periodos_prolongados_pie' => $this->faker->boolean,
            'c_calor' => $this->faker->boolean,
            'c_menstruacion' => $this->faker->boolean,
            'c_ejercicio' => $this->faker->boolean,
            'c_elevar_piernas' => $this->faker->boolean,
            'c_otros' => $this->faker->boolean,
            'd_elevacion_piernas' => $this->faker->boolean,
            'd_medias_elasticas' => $this->faker->boolean,
            'd_ejercicio' => $this->faker->boolean,
            'd_mediamientos' => $this->faker->boolean,
            'd_cuales' => $this->faker->sentence,
            'e_varices' => $this->faker->boolean,
            'e_flebitis' => $this->faker->boolean,
            'e_ulceras_llagas_piernas' => $this->faker->boolean,
            'e_trombosis' => $this->faker->boolean,
            'f_tratamientos_venosos_previos' => $this->faker->boolean,
            'f_cuales' => $this->faker->sentence,
            'g_alergico' => $this->faker->boolean,
            'g_cuales' => $this->faker->sentence,
            'h_cirugias' => $this->faker->sentence,
            'i_enfermedades' => $this->faker->sentence,
            'j_fecha_ultima_regla' => $this->faker->date,
            'j_hormonas_anticonceptivos' => $this->faker->boolean,
            'j_cuales' => $this->faker->sentence,
            'k_tiempo_pie' => $this->faker->boolean,
            'k_tiempo_sentado' => $this->faker->boolean,
            'k_expuesto_calor' => $this->faker->boolean,
            'l_fumar' => $this->faker->boolean,
            'l_alcohol' => $this->faker->boolean,
            'l_otros' => $this->faker->boolean,
            'm_embarazos' => $this->faker->numberBetween(0, 10),
            'm_problemas' => $this->faker->sentence,
            'n_informacion_pertinente' => $this->faker->sentence,
            'o_circunferencia_mid' => $this->faker->numberBetween(0, 100),
            'o_circunferencia_mii' => $this->faker->numberBetween(0, 100),
            'o_ulcera' => $this->faker->boolean,
            'o_edema' => $this->faker->boolean,
            'o_telangiectasias' => $this->faker->boolean,
            'o_venas_pequeno' => $this->faker->boolean,
            'o_venas_mediano' => $this->faker->boolean,
            'o_venas_gran' => $this->faker->boolean,
            'o_linfedema' => $this->faker->boolean,
            'o_lipodermatoesclerosis' => $this->faker->boolean,
            'o_hipersensibilidad' => $this->faker->boolean,
            'p_diagnostico' => $this->faker->sentence,
            'q_arterial' => $this->faker->boolean,
            'q_venoso' => $this->faker->boolean,
            'q_mii' => $this->faker->boolean,
            'q_mid' => $this->faker->boolean,
            'q_bilateral' => $this->faker->boolean,
            'r_resultado_doppler' => $this->faker->sentence,
            's_tratamiento' => $this->faker->sentence,
        ];
    }
}
