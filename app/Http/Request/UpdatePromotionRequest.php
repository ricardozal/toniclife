<?php


namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdatePromotionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $promotionId = $this->route('promotionId');

        return [
            'name' => 'required',
            'description' => 'required',
            'min_amount' => 'required',
            'expiration_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre necesario',
            'description.required' => 'Descripción necesario',
            'min_amount.required' => 'Monto minímo necesario',
            'expiration_date.required' => 'Ingrese una fecha de expiración'
        ];
    }
}
