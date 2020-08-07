<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class GuideNumberRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => 'required',
            'fk_id_office_parcel' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Debe ingresar un número de guía',
            'fk_id_office_parcel.required' => 'Debe eleguir una paquetería',
        ];
    }
}
