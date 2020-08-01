<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class InventoryGlobalMovementsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stock' => 'required|min:1',
            'fk_id_branch' => 'required',
            'fk_id_branchDestination' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'stock.required'=> 'El stock es necesario',
            'stock.min'=> 'Debe ser mayor a cero la cantidad del ajuste',
            'fk_id_branchDestination.required'=> 'Debe elegir una sucursal de destino',
            'fk_id_branch.required' => 'Debe elegir una sucursal de origen'
        ];
    }
}
