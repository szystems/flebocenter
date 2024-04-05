<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteFormRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'ocupacion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('pacientes')->ignore($this->route('id')),
            ],
            'dpi' => [
                'required',
                'string',
                'size:13',
                Rule::unique('pacientes')->ignore($this->route('id')),
            ],
            'nit' => 'nullable|string|max:17',
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estado' => 'boolean',
        ];
    }
}
