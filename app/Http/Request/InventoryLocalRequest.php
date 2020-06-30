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
            'stock' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'stock.required'=> 'El stock es necesario',
        ];
    }
}
