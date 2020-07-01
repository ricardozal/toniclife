<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class InventoryLocalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stock' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'stock.required'=> 'El stock es necesario',
            'name.required'=> 'Se debe de seleccionar un producto es necesario',
        ];
    }
}
