<?php
namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function authorize()
    {
    return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'tax_percentage' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre necesario',
            'tax_percentage.required' => 'Porcentaje de impuesto necesario',
        ];
    }
}
