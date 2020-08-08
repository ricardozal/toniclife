<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class OfficeParcelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre necesario',
        ];
    }
}
