<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
            'fecha' => 'required|date',
            'paciente_id' => 'required|exists:pacientes,id',
            'tipo_comprobante' => 'nullable|string|max:255',
            'serie_comprobante' => 'nullable|string|max:255',
            'numero_comprobante' => 'nullable|string|max:255',

            'idarticulo' => 'required|exists:articulos,id',
            'cantidad' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'descuento' => 'required',

            'tipo_pago' => 'required|string',
        ];
    }
}
