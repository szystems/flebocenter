<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Paciente;
use App\Models\Historia;
use App\Http\Requests\HistoriaFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use PDF;
use DB;

class HistoriaController extends Controller
{
    public function edit($id)
    {
        $historia = Historia::find($id);
        $paciente = Paciente::where('id', $historia->paciente_id)->first();
        return view('admin.paciente.historia.edithistoria', \compact('historia','paciente'));
    }

    public function update(HistoriaFormRequest $request, $id)
    {

        $fur = $request->get('j_fecha_ultima_regla');
        $fur = date("Y-m-d", strtotime($fur));

        $historia = Historia::find($id);

        $historia->medico = $request->filled('medico') ? $request->medico : null;
        $historia->miembro_afectado = $request->filled('miembro_afectado') ? $request->miembro_afectado : null;
        $historia->peso = $request->filled('peso') ? $request->peso : null;
        $historia->estatura = $request->filled('estatura') ? $request->estatura : null;
        $historia->a_estetica = boolval($request->filled('a_estetica'));
        $historia->a_enfermedad = boolval($request->filled('a_enfermedad'));
        $historia->b_muslo = boolval($request->filled('b_muslo'));
        $historia->b_pantorrilla = boolval($request->filled('b_pantorrilla'));
        $historia->b_tobillo = boolval($request->filled('b_tobillo'));
        $historia->b_varicorragia = boolval($request->filled('b_varicorragia'));
        $historia->b_inchazon = boolval($request->filled('b_inchazon'));
        $historia->b_ulceras_piel = boolval($request->filled('b_ulceras_piel'));
        $historia->b_ardor = boolval($request->filled('b_ardor'));
        $historia->b_comezon = boolval($request->filled('b_comezon'));
        $historia->b_cansancio = boolval($request->filled('b_cansancio'));
        $historia->b_pesadez = boolval($request->filled('b_pesadez'));
        $historia->b_calambres = boolval($request->filled('b_calambres'));
        $historia->c_caminar = boolval($request->filled('c_caminar'));
        $historia->c_periodos_prolongados_pie = boolval($request->filled('c_periodos_prolongados_pie'));
        $historia->c_calor = boolval($request->filled('c_calor'));
        $historia->c_menstruacion = boolval($request->filled('c_menstruacion'));
        $historia->c_ejercicio = boolval($request->filled('c_ejercicio'));
        $historia->c_elevar_piernas = boolval($request->filled('c_elevar_piernas'));
        $historia->c_otros = boolval($request->filled('c_otros'));
        $historia->c_cuales = $request->filled('c_cuales') ? $request->c_cuales : null;
        $historia->d_elevacion_piernas = boolval($request->filled('d_elevacion_piernas'));
        $historia->d_medias_elasticas = boolval($request->filled('d_medias_elasticas'));
        $historia->d_ejercicio = boolval($request->filled('d_ejercicio'));
        $historia->d_mediamientos = boolval($request->filled('d_mediamientos'));
        $historia->d_cuales = $request->filled('d_cuales') ? $request->d_cuales : null;
        $historia->e_varices = boolval($request->filled('e_varices'));
        $historia->e_flebitis = boolval($request->filled('e_flebitis'));
        $historia->e_ulceras_llagas_piernas = boolval($request->filled('e_ulceras_llagas_piernas'));
        $historia->e_trombosis = boolval($request->filled('e_trombosis'));
        $historia->f_tratamientos_venosos_previos = boolval($request->filled('f_tratamientos_venosos_previos'));
        $historia->f_cuales = $request->filled('f_cuales') ? $request->f_cuales : null;
        $historia->g_alergico = boolval($request->filled('g_alergico'));
        $historia->g_cuales = $request->filled('g_cuales') ? $request->g_cuales : null;
        $historia->h_cirugias = $request->filled('h_cirugias') ? $request->h_cirugias : null;
        $historia->i_enfermedades = $request->filled('i_enfermedades') ? $request->i_enfermedades : null;
        $historia->j_fecha_ultima_regla = $fur;
        $historia->j_hormonas_anticonceptivos = boolval($request->filled('j_hormonas_anticonceptivos'));
        $historia->j_cuales = $request->filled('j_cuales') ? $request->j_cuales : null;
        $historia->k_tiempo_pie = boolval($request->filled('k_tiempo_pie'));
        $historia->k_tiempo_sentado = boolval($request->filled('k_tiempo_sentado'));
        $historia->k_expuesto_calor = boolval($request->filled('k_expuesto_calor'));
        $historia->l_fumar = boolval($request->filled('l_fumar'));
        $historia->l_alcohol = boolval($request->filled('l_alcohol'));
        $historia->l_otros = boolval($request->filled('l_otros'));
        $historia->l_cuales = $request->filled('l_cuales') ? $request->l_cuales : null;
        $historia->m_embarazos = $request->filled('m_embarazos') ? $request->m_embarazos : 0;
        $historia->m_problemas = $request->filled('m_problemas') ? $request->m_problemas : null;
        $historia->n_informacion_pertinente = $request->filled('n_informacion_pertinente') ? $request->n_informacion_pertinente : null;
        $historia->o_circunferencia_mid = $request->filled('o_circunferencia_mid') ? $request->o_circunferencia_mid : null;
        $historia->o_circunferencia_mii = $request->filled('o_circunferencia_mii') ? $request->o_circunferencia_mii : null;
        $historia->o_ulcera = $request->filled('o_ulcera') ? $request->o_ulcera : null;
        $historia->o_edema = $request->filled('o_edema') ? $request->o_edema : null;
        $historia->o_telangiectasias = $request->filled('o_telangiectasias') ? $request->o_telangiectasias : null;
        $historia->o_venas_pequeno = $request->filled('o_venas_pequeno') ? $request->o_venas_pequeno : null;
        $historia->o_venas_mediano = $request->filled('o_venas_mediano') ? $request->o_venas_mediano : null;
        $historia->o_venas_gran = $request->filled('o_venas_gran') ? $request->o_venas_gran : null;
        $historia->o_linfedema = $request->filled('o_linfedema') ? $request->o_linfedema : null;
        $historia->o_lipodermatoesclerosis = $request->filled('o_lipodermatoesclerosis') ? $request->o_lipodermatoesclerosis : null;
        $historia->o_hipersensibilidad = $request->filled('o_hipersensibilidad') ? $request->o_hipersensibilidad : null;
        $historia->p_diagnostico = $request->filled('p_diagnostico') ? $request->p_diagnostico : null;
        $historia->q_arterial = boolval($request->filled('q_arterial'));
        $historia->q_venoso = boolval($request->filled('q_venoso'));
        $historia->q_mii = boolval($request->filled('q_mii'));
        $historia->q_mid = boolval($request->filled('q_mid'));
        $historia->q_bilateral = boolval($request->filled('q_bilateral'));
        $historia->r_resultado_doppler = $request->filled('r_resultado_doppler') ? $request->r_resultado_doppler : null;
        $historia->s_tratamiento = $request->filled('s_tratamiento') ? $request->s_tratamiento : null;
        $historia->save();

        $paciente = Paciente::find($historia->paciente_id);

        return redirect('show-paciente/'.$id)->with('status',__('Historia de Paciente actualizado correctamente!'));

    }

    public function uploadimagen(Request $request)
    {
        if ($request->hasFile('upload'))
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = \pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('assets/media'),$fileName);

            $url = asset('assets/media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
