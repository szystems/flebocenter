<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;

    protected $table = 'historias';

    protected $primaryKey='paciente_id';

    protected $fillable = [
        'paciente_id',
        'medico',
        'miembro_afectado',
        'peso',
        'estatura',
        'a_estetica',
        'a_enfermedad',
        'b_muslo',
        'b_tobillo',
        'b_pantorrilla',
        'b_varicorragia',
        'b_inchazon',
        'b_ulceras_piel',
        'b_ardor',
        'b_comezon',
        'b_cansancio',
        'b_pesadez',
        'b_calambres',
        'b_describir',
        'c_caminar',
        'c_periodos_prolongados_pie',
        'c_calor',
        'c_menstruacion',
        'c_ejercicio',
        'c_elevar_piernas',
        'c_otros',
        'c_cuales',
        'd_elevacion_piernas',
        'd_medias_elasticas',
        'd_ejercicio',
        'd_mediamientos',
        'd_cuales',
        'e_varices',
        'e_flebitis',
        'e_ulceras_llagas_piernas',
        'e_trombosis',
        'e_quien',
        'f_tratamientos_venosos_previos',
        'f_cuales',
        'g_alergico',
        'g_cuales',
        'h_cirugias',
        'i_enfermedades',
        'j_fecha_ultima_regla',
        'j_hormonas_anticonceptivos',
        'j_cuales',
        'j_otro',
        'k_tiempo_pie',
        'k_tiempo_sentado',
        'k_expuesto_calor',
        'l_fumar',
        'l_alcohol',
        'l_otros',
        'l_cuales',
        'm_embarazos',
        'm_problemas',
        'n_informacion_pertinente',
        'o_circunferencia_mid',
        'o_circunferencia_mii',
        'o_ulcera',
        'o_edema',
        'o_telangiectasias',
        'o_venas_pequeno',
        'o_venas_mediano',
        'o_venas_gran',
        'o_linfedema',
        'o_lipodermatoesclerosis',
        'o_hipersensibilidad',
        'o_otros',
        'p_diagnostico',
        'q_arterial',
        'q_venoso',
        'q_mii',
        'q_mid',
        'q_bilateral',
        'r_resultado_doppler',
        's_tratamiento'
    ];

    protected $casts = [
        'a_estetica' => 'boolean',
        'a_enfermedad' => 'boolean',
        'b_muslo' => 'boolean',
        'b_tobillo' => 'boolean',
        'b_pantorrilla' => 'boolean',
        'b_varicorragia' => 'boolean',
        'b_inchazon' => 'boolean',
        'b_ulceras_piel' => 'boolean',
        'b_ardor' => 'boolean',
        'b_comezon' => 'boolean',
        'b_cansancio' => 'boolean',
        'b_pesadez' => 'boolean',
        'b_calambres' => 'boolean',
        'c_caminar' => 'boolean',
        'c_periodos_prolongados_pie' => 'boolean',
        'c_calor' =>'boolean',
        'c_menstruacion' => 'boolean',
        'c_ejercicio' => 'boolean',
        'c_elevar_piernas' => 'boolean',
        'c_otros' => 'boolean',
        'd_elevacion_piernas' => 'boolean',
        'd_medias_elasticas' => 'boolean',
        'd_ejercicio' => 'boolean',
        'd_mediamientos' => 'boolean',
        'j_hormonas_anticonceptivos' => 'boolean'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
