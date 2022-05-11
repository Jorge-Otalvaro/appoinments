<?php

namespace App\Http\Requests\Schedule;

use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date'          => 'required|date_format:"Y-m-d"',
            'doctor_id'     => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'date.required'      => 'La fecha es requerida',
            'date.date_format'   => 'La fecha no tiene el formato valido',
            'doctor_id.required' => 'El medico es requerido',
            'doctor_id.exists'   => 'El medico no existe en nuestros registros',
        ];
    }
}