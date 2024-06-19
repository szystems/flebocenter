<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoFormRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|max:10240',
        ];
    }
}
