<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateFormRequest extends FormRequest
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
            'email'=>'required|string|email|max:255|unique:users',
            'name'=>'required|max:191',
            'fotografia' => 'mimes:jpg,jpeg,bmp,png,gif|max:3000|nullable',
            'fecha_nacimiento'=>'required|date',
        ];
    }
}
