<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Clinica;
use App\Http\Requests\CitaFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use Carbon\Carbon;
use PDF;
use DB;

class CitaController extends Controller
{
    public function index(Request $request)
	{
        if ($request)
        {
            if ($request->input('ffecha') != "") {
                $fechaVista = date("d-m-Y", strtotime($request->input('ffecha')));
                $fecha = date("Y-m-d", strtotime($request->input('ffecha')));
            }else
            {
                $hoy = Carbon::now('America/Guatemala');
                $fechaVista = $hoy->format('d-m-Y');
                $fecha = date("Y-m-d", strtotime($fechaVista));
            }

            $citas = Cita::query()
            ->select('citas.*')
            ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
            ->when($request->fpaciente, function ($query, $paciente) {
                return $query->where(function($query) use ($paciente) {
                    $query->where('pacientes.nombre', 'like', "%{$paciente}%")
                        ->orWhere('pacientes.dpi', 'like', "%{$paciente}%");
                });
            })
            ->when($request->fdoctor, function ($query, $doctor_id) {
                return $query->where('citas.doctor_id', $doctor_id);
            })
            ->when($request->fclinica, function ($query, $clinica_id) {
                return $query->where('citas.clinica_id', $clinica_id);
            })
            ->when($fecha, function ($query, $fecha_cita) {
                return $query->whereDate('citas.fecha_cita', $fecha_cita);
            })
            ->when($request->festado, function ($query, $estado) {
                return $query->where('citas.estado', $estado);
            })
            ->orderBy('citas.hora_inicio', 'asc')
            ->orderBy('citas.clinica_id', 'asc')
            ->orderBy('citas.doctor_id', 'asc')
            ->get();


            $filtroClinicas = Clinica::where('estado', 1)->get();
            $filtroPacientes = Paciente::where('estado', 1)->get();
            $filtroDoctores = User::where('estado', 1)->where('role_as', 0)->get();
            $filtros = $request->all();

            // dd($fechaVista);

            return view('admin.cita.index',compact("citas","filtroDoctores","filtroPacientes","filtroClinicas","filtros","fechaVista"));
        }
    }

    public function add()
    {
        $filtroClinicas = Clinica::where('estado', 1)->get();
        $filtroPacientes = Paciente::where('estado', 1)->get();
        $filtroDoctores = User::where('estado', 1)->where('role_as', 0)->get();
        return view('admin.cita.add', compact('filtroDoctores','filtroPacientes','filtroClinicas'));
    }

    public function verificarTraslapeEnOtraClinica($clinica_id, $doctor_id, $fecha_cita, $hora_inicio, $hora_fin) {
        // Buscar citas existentes para el mismo doctor y fecha
        $citasExistentes = Cita::where('doctor_id', $doctor_id)
                               ->where('fecha_cita', $fecha_cita)
                               ->get();

        // Verificar si hay traslape con alguna cita existente en otra clínica
        foreach ($citasExistentes as $citaExistente) {
            // Convertir las horas a timestamps para la comparación
            $inicioExistente = strtotime($citaExistente->hora_inicio);
            $finExistente = strtotime($citaExistente->hora_fin);
            $inicioNuevo = strtotime($hora_inicio);
            $finNuevo = strtotime($hora_fin);

            // Verificar si hay traslape y si la clínica es diferente
            if ($inicioNuevo < $finExistente && $inicioExistente < $finNuevo
                && $citaExistente->clinica_id != $clinica_id) {
                // Hay traslape en otra clínica
                return true;
            }
        }

        // No hay traslape en otras clínicas
        return false;
    }


    public function insert(CitaFormRequest $request)
    {
        $fechaPHP = date("Y-m-d", strtotime($request->fecha_cita));
        $traslape = $this->verificarTraslapeEnOtraClinica(
            $request->clinica_id,
            $request->doctor_id,
            $fechaPHP,
            $request->hora_inicio,
            $request->hora_fin
        );

        if ($traslape) {
            // Manejar el caso de traslape, por ejemplo, enviando un mensaje de error
            return redirect()->back()->with('status', 'La cita se superpone con otra existente. Por favor, elige otro horario.');
        } else {
            // Crear la cita si no hay traslape
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

            // Enviar una respuesta de éxito
            return redirect('show-cita/'.$cita->id)->with('status',__('La cita se creo exitosamente.'));
        }

        $cita = new Cita();
        $cita->paciente_id = $request->input('paciente_id');
        $cita->doctor_id = $request->input('doctor_id');
        $cita->clinica_id = $request->input('clinica_id');
        $cita->fecha_cita = $request->input('fecha_cita');
        $cita->hora_inicio = $request->input('hora_inicio');
        $cita->hora_fin = $request->input('hora_fin');
        $cita->motivo = $request->input('motivo');
        $cita->estado = $request->input('estado');
        $cita->save();

        // return redirect('clinicas')->with('status', __('Clínica agregada exitosamente.'));
        return redirect('show-clinica/'.$clinica->id)->with('status',__('Clínica agregada exitosamente.'));
    }

    public function show($id)
    {
        $cita = cITA::find($id);
        return view('admin.cita.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::find($id);
        $filtroClinicas = Clinica::where('estado', 1)->get();
        $filtroPacientes = Paciente::where('estado', 1)->get();
        $filtroDoctores = User::where('estado', 1)->where('role_as', 0)->get();
        return view('admin.cita.edit', \compact('cita','filtroDoctores','filtroPacientes','filtroClinicas'));
    }

    public function update(CitaFormRequest $request, $id)
    {
        // Obtener la cita por ID
        $cita = Cita::find($id);

        // Convertir la fecha y hora a formato PHP
        $fechaPHP = date("Y-m-d", strtotime($request->fecha_cita));
        $horaInicioPHP = date("H:i:s", strtotime($request->hora_inicio));
        $horaFinPHP = date("H:i:s", strtotime($request->hora_fin));

        // Verificar si hay traslape con otras citas, excluyendo la cita actual
        $traslape = Cita::where('clinica_id', $request->clinica_id)
                        ->where('doctor_id', $request->doctor_id)
                        ->where('fecha_cita', $fechaPHP)
                        ->where('id', '!=', $id) // Excluir la cita actual
                        ->where(function ($query) use ($horaInicioPHP, $horaFinPHP) {
                            $query->where(function ($q) use ($horaInicioPHP, $horaFinPHP) {
                                $q->where('hora_inicio', '<', $horaFinPHP)
                                ->where('hora_fin', '>', $horaInicioPHP);
                            });
                        })
                        ->exists();

        if ($traslape) {
            // Manejar el caso de traslape
            return redirect()->back()->with('status', __('La cita se traslapa con otra existente, verifica para ver si hay un espacio disponible.'));
        } else {
            // Actualizar la cita si no hay traslape
            $cita->paciente_id = $request->input('paciente_id');
            $cita->doctor_id = $request->input('doctor_id');
            $cita->clinica_id = $request->input('clinica_id');
            $cita->fecha_cita = $fechaPHP;
            $cita->hora_inicio = $horaInicioPHP;
            $cita->hora_fin = $horaFinPHP;
            $cita->motivo = $request->input('motivo');
            $cita->estado = $request->input('estado');
            $cita->save();

            // Enviar una respuesta de éxito
            return redirect('show-cita/'.$cita->id)->with('status', __('La cita se actualizó exitosamente.'));
        }
    }

    public function destroy($id)
    {
        $cita = Cita::find($id);
        $cita->delete();
        return redirect('citas')->with('status',__('Cita eliminada correctamente.'));
    }

}
