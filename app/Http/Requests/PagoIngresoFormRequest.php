<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoIngresoFormRequest extends FormRequest
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
            'ingreso_id' => 'required|exists:ingresos,id',
            'tipo_pago' => 'required|string',
            'cantidad' => 'required|numeric|min:0.01',
            'imagen' => 'nullable|image|mimes:jpeg,png|max:3048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ingreso_id.required' => 'El ingreso es requerido',
            'ingreso_id.exists' => 'El ingreso no existe',
            'tipo_pago.required' => 'El tipo de pago es requerido',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.numeric' => 'La cantidad debe ser un número',
            'cantidad.min' => 'La cantidad debe ser mayor a 0.01',
        ];
    }
}
