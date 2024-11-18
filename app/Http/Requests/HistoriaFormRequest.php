<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoriaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'medico' => 'nullable|string',
            'miembro_afectado' => 'required|string|in:Izquierdo,Derecho,Ambos',
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
            // 'a_estetica' => 'boolean',
            // 'a_enfermedad' => 'boolean',
            // 'b_muslo' => 'boolean',
            // 'b_tobillo' => 'boolean',
            // 'b_pantorrilla' => 'boolean',
            // 'b_varicorragia' => 'boolean',
            // 'b_inchazon' => 'boolean',
            // 'b_ulceras_piel' => 'boolean',
            // 'b_ardor' => 'boolean',
            // 'b_comezon' => 'boolean',
            // 'b_cansancio' => 'boolean',
            // 'b_pesadez' => 'boolean',
            // 'b_calambres' => 'boolean',
            'b_describir' => 'nullable|string',
            // 'c_caminar' => 'boolean',
            // 'c_periodos_prolongados_pie' => 'boolean',
            // 'c_calor' => 'boolean',
            // 'c_menstruacion' => 'boolean',
            // 'c_ejercicio' => 'boolean',
            // 'c_elevar_piernas' => 'boolean',
            // 'c_otros' => 'boolean',
            'c_cuales' => 'nullable|string',
            // 'd_elevacion_piernas' => 'boolean',
            // 'd_medias_elasticas' => 'boolean',
            // 'd_ejercicio' => 'boolean',
            // 'd_mediamientos' => 'boolean',
            // 'e_varices' => 'boolean',
            // 'e_flebitis' => 'boolean',
            // 'e_ulceras_llagas_piernas' => 'boolean',
            // 'e_trombosis' => 'boolean',
            'e_quien' => 'nullable|string',
            // 'f_tratamientos_venosos_previos' => 'boolean',
            'f_cuales' => 'nullable|string',
            // 'g_alergico' => 'boolean',
            'g_cuales' => 'nullable|string',
            'h_cirugias' => 'nullable|string',
            'i_enfermedades' => 'nullable|string',
            'j_fecha_ultima_regla' => 'nullable|date',
            // 'j_hormonas_anticonceptivos' => 'boolean',
            'j_cuales' => 'nullable|string',
            'j_otro' => 'nullable|string',
            // 'k_tiempo_pie' => 'boolean',
            // 'k_tiempo_sentado' => 'boolean',
            // 'k_expuesto_calor' => 'boolean',
            // 'l_fumar' => 'boolean',
            // 'l_alcohol' => 'boolean',
            // 'l_otros' => 'boolean',
            'l_cuales' => 'nullable|string',
            'm_embarazos' => 'integer|min:0',
            'm_problemas' => 'nullable|string',
            'n_informacion_pertinente' => 'nullable|string',
            'o_circunferencia_mid' => 'nullable|string',
            'o_circunferencia_mii' => 'nullable|string',
            // 'o_ulcera' => 'nullable|string',
            // 'o_edema' => 'nullable|string',
            // 'o_telangiectasias' => 'nullable|string',
            // 'o_venas_pequeno' => 'nullable|string',
            // 'o_venas_mediano' => 'nullable|string',
            // 'o_venas_gran' => 'nullable|string',
            // 'o_linfedema' => 'nullable|string',
            // 'o_lipodermatoesclerosis' => 'nullable|string',
            // 'o_hipersensibilidad' => 'nullable|string',
            'o_otros' => 'nullable|string',
            // 'p_diagnostico' => 'nullable|string',
            // 'q_arterial' => 'boolean',
            // 'q_venoso' => 'boolean',
            // 'q_mii' => 'boolean',
            // 'q_mid' => 'boolean',
            // 'q_bilateral' => 'boolean',
            'r_resultado_doppler' => 'nullable|string',
            's_tratamiento' => 'nullable|string',
        ];
    }
}
