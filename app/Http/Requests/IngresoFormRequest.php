<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
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
            'proveedor_id' => 'required|exists:proveedores,id',
            'tipo_comprobante' => 'string|max:255',
            'serie_comprobante' => 'string|max:255',
            'numero_comprobante' => 'string|max:255',
            'tipo_pago' => 'required'|'max:255',

            'articulo_id' => 'required|exists:articulos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
        ];
    }
}
