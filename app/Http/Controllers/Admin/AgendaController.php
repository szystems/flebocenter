<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Clinica;
use App\Http\Requests\CitaFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Muestra la vista principal del calendario
     */
    public function index(Request $request)
    {
        // Obtener mes y año de la solicitud o usar el actual
        $mes = $request->input('mes', Carbon::now()->month);
        $anio = $request->input('anio', Carbon::now()->year);

        // Crear fecha de referencia
        $fechaReferencia = Carbon::create($anio, $mes, 1);

        // Datos para navegación del calendario
        $nombreMes = $fechaReferencia->locale('es')->monthName;
        $mesAnterior = $fechaReferencia->copy()->subMonth();
        $mesSiguiente = $fechaReferencia->copy()->addMonth();

        // Obtener los días del mes
        $primerDia = $fechaReferencia->copy()->firstOfMonth();
        $ultimoDia = $fechaReferencia->copy()->lastOfMonth();

        // Ajustar para mostrar la semana completa
        $inicioCalendario = $primerDia->copy()->startOfWeek(Carbon::MONDAY);
        $finCalendario = $ultimoDia->copy()->endOfWeek(Carbon::SUNDAY);

        // Obtener todas las citas del período visible del calendario
        $citas = Cita::whereBetween('fecha_cita', [
            $inicioCalendario->format('Y-m-d'),
            $finCalendario->format('Y-m-d')
        ])->get();

        // Agrupar las citas por fecha y estado
        $citasPorDia = [];
        foreach ($citas as $cita) {
            $fecha = $cita->fecha_cita;
            if (!isset($citasPorDia[$fecha])) {
                $citasPorDia[$fecha] = [
                    'total' => 0,
                    'Pendiente' => 0,
                    'Confirmada' => 0,
                    'Atendida' => 0
                ];
            }
            $citasPorDia[$fecha]['total']++;
            $citasPorDia[$fecha][$cita->estado]++;
        }

        $filtroClinicas = Clinica::where('estado', 1)->get();
        $filtroPacientes = Paciente::where('estado', 1)->get();
        $filtroDoctores = User::where('estado', 1)->where('role_as', 0)->get();

        return view('admin.agenda.index', compact(
            'mes', 'anio', 'nombreMes', 'mesAnterior', 'mesSiguiente',
            'inicioCalendario', 'finCalendario', 'citasPorDia',
            'filtroDoctores', 'filtroPacientes', 'filtroClinicas'
        ));
    }

    /**
     * Muestra las citas de un día específico
     */
    public function verDia(Request $request, $fecha)
    {
        $fechaCarbon = Carbon::parse($fecha);

        // Obtener citas del día
        $citas = Cita::where('fecha_cita', $fecha)
            ->orderBy('hora_inicio', 'asc')
            ->orderBy('clinica_id', 'asc')
            ->orderBy('doctor_id', 'asc')
            ->get();

        $filtroClinicas = Clinica::where('estado', 1)->get();
        $filtroPacientes = Paciente::where('estado', 1)->get();
        $filtroDoctores = User::where('estado', 1)->where('role_as', 0)->get();

        return view('admin.agenda.dia', compact(
            'fecha', 'fechaCarbon', 'citas',
            'filtroDoctores', 'filtroPacientes', 'filtroClinicas'
        ));
    }

    /**
     * Obtiene las citas disponibles por clínica, doctor y fecha (para AJAX)
     */
    public function obtenerDisponibilidad(Request $request)
    {
        $clinicaId = $request->input('clinica_id');
        $doctorId = $request->input('doctor_id');
        $fecha = $request->input('fecha');
        $citaId = $request->input('cita_id'); // Si se está editando una cita existente

        // Consultar citas existentes para esa combinación de doctor/fecha
        $citas = Cita::where('doctor_id', $doctorId)
            ->where('fecha_cita', $fecha)
            ->when($citaId, function($query) use ($citaId) {
                return $query->where('id', '!=', $citaId); // Excluir la cita que se está editando
            })
            ->orderBy('hora_inicio')
            ->get(['hora_inicio', 'hora_fin', 'clinica_id']);

        return response()->json([
            'citas' => $citas
        ]);
    }

    /**
     * Guarda una nueva cita vía AJAX
     */
    public function guardarCita(CitaFormRequest $request)
    {
        $fechaPHP = date("Y-m-d", strtotime($request->fecha_cita));

        // Verificar traslape
        $traslape = Cita::where('clinica_id', $request->clinica_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('fecha_cita', $fechaPHP)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('hora_inicio', '<', $request->hora_fin)
                    ->where('hora_fin', '>', $request->hora_inicio);
                });
            })
            ->exists();

        if ($traslape) {
            return response()->json([
                'success' => false,
                'message' => 'La cita se traslapa con otra existente.'
            ], 422);
        }

        // Crear la cita
        $cita = new Cita();
        $cita->paciente_id = $request->input('paciente_id');
        $cita->doctor_id = $request->input('doctor_id');
        $cita->clinica_id = $request->input('clinica_id');
        $cita->fecha_cita = $fechaPHP;
        $cita->hora_inicio = $request->input('hora_inicio');
        $cita->hora_fin = $request->input('hora_fin');
        $cita->motivo = $request->input('motivo');
        $cita->estado = $request->input('estado');
        $cita->save();

        return response()->json([
            'success' => true,
            'message' => 'Cita guardada exitosamente',
            'cita' => $cita
        ]);
    }

    /**
     * Actualiza una cita existente vía AJAX
     */
    public function actualizarCita(CitaFormRequest $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $fechaPHP = date("Y-m-d", strtotime($request->fecha_cita));

        // Verificar traslape con otras citas, excluyendo la cita actual
        $traslape = Cita::where('clinica_id', $request->clinica_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('fecha_cita', $fechaPHP)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('hora_inicio', '<', $request->hora_fin)
                    ->where('hora_fin', '>', $request->hora_inicio);
                });
            })
            ->exists();

        if ($traslape) {
            return response()->json([
                'success' => false,
                'message' => 'La cita se traslapa con otra existente.'
            ], 422);
        }

        // Actualizar la cita
        $cita->paciente_id = $request->input('paciente_id');
        $cita->doctor_id = $request->input('doctor_id');
        $cita->clinica_id = $request->input('clinica_id');
        $cita->fecha_cita = $fechaPHP;
        $cita->hora_inicio = $request->input('hora_inicio');
        $cita->hora_fin = $request->input('hora_fin');
        $cita->motivo = $request->input('motivo');
        $cita->estado = $request->input('estado');
        $cita->save();

        return response()->json([
            'success' => true,
            'message' => 'Cita actualizada exitosamente',
            'cita' => $cita
        ]);
    }

    /**
     * Elimina una cita vía AJAX
     */
    public function eliminarCita($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cita eliminada exitosamente'
        ]);
    }
}
