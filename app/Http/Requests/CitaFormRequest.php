<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitaFormRequest extends FormRequest
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
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:users,id',
            'clinica_id' => 'required|exists:clinicas,id',
            'fecha_cita' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'motivo' => 'required|string|max:1024',
            'estado' => 'required|in:Pendiente,Confirmada,Atendida',
        ];
    }
}
