<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|index',
            'codigo' => 'nullable|unique:articulos,codigo',
            'imagen' => 'nullable|image|max:2048|default:default.jpg',
            'descripcion' => 'nullable|string',
            'precio_compra' => 'required|numeric|min:0|default:0.00',
            'precio_venta' => 'required|numeric|min:0|default:0.00',
            'stock' => 'required|integer|min:0|default:0',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'proveedor_id' => 'required|integer|exists:proveedores,id'
        ];
    }
}
