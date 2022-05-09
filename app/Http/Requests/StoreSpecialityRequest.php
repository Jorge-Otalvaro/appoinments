<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialityRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:specialities|min:3|max:120|string',
            'description' => 'max:240',
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
            'name.required' => 'La especialidad es requerida',
            'name.string' => 'La especialidad tiene caracteres no permitidos',
            'name.max' => 'El nombre de la especialidad supera el maximo permitido :max carácteres',
            'name.min' => 'El nombre de la especialidad no supera el minimo permitido :min carácteres',
            'name.unique' => 'El nombre de la especialidad ya se encuentra registrado',
            'description.max' => 'La descripción de la especialidad supera el maximo permitido :max carácteres'
        ];
    }
}
