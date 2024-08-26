<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->integer('paciente_id')->primary()->unique();
            $table->string('medico')->nullable();
            $table->enum('miembro_afectado', ['Izquierdo', 'Derecho', 'Ambos'])->default('Izquierdo');
            $table->decimal('peso', 8, 2)->default(0.00);
            $table->decimal('estatura', 8, 2)->default(0.00);
            $table->tinyInteger('a_estetica')->default(false);
            $table->tinyInteger('a_enfermedad')->default(false);
            $table->tinyInteger('b_muslo')->default(false);
            $table->tinyInteger('b_tobillo')->default(false);
            $table->tinyInteger('b_pantorrilla')->default(false);
            $table->tinyInteger('b_varicorragia')->default(false);
            $table->tinyInteger('b_inchazon')->default(false);
            $table->tinyInteger('b_ulceras_piel')->default(false);
            $table->tinyInteger('b_ardor')->default(false);
            $table->tinyInteger('b_comezon')->default(false);
            $table->tinyInteger('b_cansancio')->default(false);
            $table->tinyInteger('b_pesadez')->default(false);
            $table->tinyInteger('b_calambres')->default(false);
            $table->tinyInteger('c_caminar')->default(false);
            $table->tinyInteger('c_periodos_prolongados_pie')->default(false);
            $table->tinyInteger('c_calor')->default(false);
            $table->tinyInteger('c_menstruacion')->default(false);
            $table->tinyInteger('c_ejercicio')->default(false);
            $table->tinyInteger('c_elevar_piernas')->default(false);
            $table->tinyInteger('c_otros')->default(false);
            $table->string('c_cuales')->nullable();
            $table->tinyInteger('d_elevacion_piernas')->default(false);
            $table->tinyInteger('d_medias_elasticas')->default(false);
            $table->tinyInteger('d_ejercicio')->default(false);
            $table->tinyInteger('d_mediamientos')->default(false);
            $table->string('d_cuales')->nullable();
            $table->tinyInteger('e_varices')->default(false);
            $table->tinyInteger('e_flebitis')->default(false);
            $table->tinyInteger('e_ulceras_llagas_piernas')->default(false);
            $table->tinyInteger('e_trombosis')->default(false);
            $table->tinyInteger('f_tratamientos_venosos_previos')->default(false);
            $table->string('f_cuales')->nullable();
            $table->tinyInteger('g_alergico')->default(false);
            $table->string('g_cuales')->nullable();
            $table->string('h_cirugias')->nullable();
            $table->text('i_enfermedades')->nullable();
            $table->date('j_fecha_ultima_regla')->nullable();
            $table->tinyInteger('j_hormonas_anticonceptivos')->default(false);
            $table->string('j_cuales')->nullable();
            $table->tinyInteger('k_tiempo_pie')->default(false);
            $table->tinyInteger('k_tiempo_sentado')->default(false);
            $table->tinyInteger('k_expuesto_calor')->default(false);
            $table->tinyInteger('l_fumar')->default(false);
            $table->tinyInteger('l_alcohol')->default(false);
            $table->tinyInteger('l_otros')->default(false);
            $table->string('l_cuales')->nullable();
            $table->integer('m_embarazos')->default(0);
            $table->string('m_problemas')->nullable();
            $table->text('n_informacion_pertinente')->nullable();
            $table->string('o_circunferencia_mid')->nullable();
            $table->string('o_circunferencia_mii')->nullable();
            $table->tinyInteger('o_ulcera')->default(false);
            $table->tinyInteger('o_edema')->default(false);
            $table->tinyInteger('o_telangiectasias')->default(false);
            $table->tinyInteger('o_venas_pequeno')->default(false);
            $table->tinyInteger('o_venas_mediano')->default(false);
            $table->tinyInteger('o_venas_gran')->default(false);
            $table->tinyInteger('o_linfedema')->default(false);
            $table->tinyInteger('o_lipodermatoesclerosis')->default(false);
            $table->tinyInteger('o_hipersensibilidad')->default(false);
            $table->text('p_diagnostico')->nullable();
            $table->tinyInteger('q_arterial')->default(false);
            $table->tinyInteger('q_venoso')->default(false);
            $table->tinyInteger('q_mii')->default(false);
            $table->tinyInteger('q_mid')->default(false);
            $table->tinyInteger('q_bilateral')->default(false);
            $table->text('r_resultado_doppler')->nullable();
            $table->text('s_tratamiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historias');
    }
}
