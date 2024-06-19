<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerapiaSesionIzquierdaFormRequest extends FormRequest
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
            'terapia_id' => 'required|exists:terapias,id',
            'antes1' => 'nullable|string',
            'antes2' => 'nullable|string',
            'antes3' => 'nullable|string',
            'antes4' => 'nullable|string',
            'despues1' => 'nullable|string',
            'despues2' => 'nullable|string',
            'despues3' => 'nullable|string',
            'despues4' => 'nullable|string',
        ];
    }
}
