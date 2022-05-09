<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:120|string',
            'email' => 'required|email|min:3|max:255|unique:users',
            'document' => 'required|min:3|numeric|unique:users',
            'address' => 'required|min:3|max:120|string',
            'phone' => 'required|min:3|numeric'
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
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre tiene caracteres no permitidos',
            'name.max' => 'El nombre supera el maximo permitido :max carácteres',
            'name.min' => 'El nombre no supera el minimo permitido :min carácteres',

            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo tiene caracteres no permitidos',
            'email.max' => 'El correo supera el maximo permitido :max',
            'email.min' => 'El correo no supera el minimo permitido :min',
            'email.unique' => 'El correo ya se encuentra registrado',

            'document.required' => 'El documento es requerido',
            'document.numeric' => 'El documento tiene caracteres no permitidos',
            'document.max' => 'El documento supera el maximo permitido :max',
            'document.min' => 'El documento no supera el minimo permitido :min',
            'document.unique' => 'El documento ya se encuentra registrado',

            'address.required' => 'La dirección es requerida',
            'address.string' => 'La dirección tiene caracteres no permitidos',
            'address.max' => 'La dirección supera el maximo permitido :max carácteres',
            'address.min' => 'La dirección no supera el minimo permitido :min carácteres',

            'phone.required' => 'El telefóno es requerido',
            'phone.numeric' => 'El telefóno tiene caracteres no permitidos',
            'phone.max' => 'El telefóno supera el maximo permitido :max carácteres',
            'phone.min' => 'El telefóno no supera el minimo permitido :min carácteres',
        ];
    }
}
