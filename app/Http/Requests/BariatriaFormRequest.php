<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BariatriaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Puedes modificar esto según tus requisitos de autorización
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
            'fecha' => 'required|date',
            'peso' => 'nullable|numeric|between:0,500',
            'talla' => 'nullable|numeric|between:0,300',
            'cci' => 'nullable|numeric|between:0,300',
            'cca' => 'nullable|numeric|between:0,300',
            'ccu' => 'nullable|numeric|between:0,100',
            'imc' => 'nullable|numeric|between:0,100',
            'icc' => 'nullable|numeric|between:0,5',
            'ict' => 'nullable|numeric|between:0,5',
            'pdf_path' => 'nullable|mimes:pdf|max:10240', // Máximo 10MB
            'diagnostico' => 'nullable|string',
            'kilocalorias' => 'nullable|integer|min:0',
            'medicamentos' => 'nullable|string',
            'suplementacion' => 'nullable|string',
            'ejercicios' => 'nullable|string',
            'comentarios' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'paciente_id.required' => 'Debe seleccionar un paciente',
            'paciente_id.exists' => 'El paciente seleccionado no existe',
            'fecha.required' => 'La fecha es obligatoria',
            'fecha.date' => 'El formato de la fecha no es válido',
            'peso.numeric' => 'El peso debe ser un valor numérico',
            'talla.numeric' => 'La talla debe ser un valor numérico',
            'pdf_path.mimes' => 'El archivo debe ser un PDF',
            'pdf_path.max' => 'El archivo no debe superar los 10MB',
            'kilocalorias.integer' => 'Las kilocalorías deben ser un número entero',
            'kilocalorias.min' => 'Las kilocalorías no pueden ser negativas',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'paciente_id' => 'paciente',
            'cci' => 'circunferencia de cintura',
            'cca' => 'circunferencia de cadera',
            'ccu' => 'circunferencia de cuello',
            'imc' => 'índice de masa corporal',
            'icc' => 'índice cintura cadera',
            'ict' => 'índice cintura talla',
            'pdf_path' => 'archivo PDF',
        ];
    }
}
