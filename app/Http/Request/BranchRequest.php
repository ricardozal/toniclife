<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'street' => 'required',
            'zip_code' => 'required',
            'ext_num' => 'required',
            'colony' => 'required',
            'city' => 'required',
            'state' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre necesario',
            'street.required' => 'Calle necesario',
            'zip_code.required' => 'Código postal necesario',
            'ext_num.required' => 'Número exterior necesario',
            'colony.required' => 'Ingrese una colonia',
            'city.required' => 'Ingrese una ciudad',
            'state.required' => 'Ingresar un estado'
        ];
    }
}
